<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Pgvector\Laravel\Distance;

class ProductController extends Controller
{
    public function index()
    {
        $productsAll = Product::all();
        $products = null;
        return view('products.index', compact('productsAll', 'products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        // Kirim ke FastAPI untuk mendapatkan embedding
        $response = Http::post('http://127.0.0.1:8000/embed', [
            'text' => $validated['name'] . ' ' . ($validated['description'] ?? '')
        ]);

        // Pastikan mengambil `embedding` dengan format API standar kita
        if ($response->successful()) {
            $embedding = $response->json()['data']['embedding'];
        } else {
            dd($response);
            return back()->with('error', 'Gagal mendapatkan embedding');
        }

        // Konversi ke format yang benar untuk `pgvector`
        $embedding = '[' . implode(',', $embedding) . ']';

        // Simpan produk ke database dengan embedding
        Product::create(array_merge($validated, ['embedding' => $embedding]));

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }


    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        // Update embedding jika ada perubahan
        $response = Http::post('http://127.0.0.1:8000/embed', [
            'text' => $validated['name'] . ' ' . ($validated['description'] ?? '')
        ]);


        // Pastikan mengambil `embedding` dengan format API standar kita
        if ($response->successful()) {
            $embedding = $response->json()['data']['embedding'];
        } else {
            return back()->with('error', 'Gagal mendapatkan embedding');
        }

        $embedding = '{' . implode(',', $embedding) . '}'; // Format untuk pgvector

        // Update produk
        $product->update(array_merge($validated, ['embedding' => $embedding]));

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    public function search(Request $request)
    {
        $keyword = $request->query('q');
        $mode = $request->query('mode', 'name'); // Default cari berdasarkan nama
        $productsAll = Product::all();

        if (!$keyword) {
            return redirect()->route('products.index');
        }

        // Mode 1: Search Nama Produk (Dengan Typo Tolerance)
        if ($mode === 'name') {
            $products = Product::search($keyword)->get();

            if ($products->isNotEmpty()) {
                return view('products.index', compact('products', 'keyword', 'productsAll'));
            } else {
                $response = Http::post('http://127.0.0.1:8000/embed', [
                    'text' => $keyword
                ]);
                if ($response->successful()) {
                    $embedding = $response->json()['data']['embedding'];
                    $products = Product::query()->nearestNeighbors('embedding', $embedding, Distance::L2)->take(1)->get();
                } else {
                    return $response;
                }
            }
        }

        // Mode 2: Search Deskripsi Produk (Semantic Search)
        if ($mode === 'description') {
            $response = Http::post('http://127.0.0.1:8000/search', [
                'query' => $keyword
            ]);

            if ($response->successful()) {
                $searchResults = $response->json()['data'];
                $products = collect($searchResults);
                return view('products.index', [
                    'products' => $products,
                    'keyword' => $keyword,
                    'productsAll' => $productsAll
                ]);
            } else {
                return $response;
            }
        }

        return view('products.index', compact('products', 'keyword', 'productsAll'));
    }
}
