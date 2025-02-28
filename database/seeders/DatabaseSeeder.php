<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $products = [
            ['name' => 'Nike Air Force 1', 'description' => '', 'price' => 1500000],
            ['name' => 'Adidas Ultraboost', 'description' => '', 'price' => 2000000],
            ['name' => 'Uniqlo Oversized T-Shirt', 'description' => '', 'price' => 199000],
            ['name' => 'Levi’s 501 Jeans', 'description' => '', 'price' => 899000],
            ['name' => 'Apple MacBook Air M2', 'description' => '', 'price' => 18000000],
            ['name' => 'Samsung Galaxy S24 Ultra', 'description' => '', 'price' => 22000000],
            ['name' => 'Sony WH-1000XM5', 'description' => '', 'price' => 5000000],
            ['name' => 'Logitech MX Master 3S', 'description' => '', 'price' => 1500000],
            ['name' => 'Dyson Airwrap', 'description' => '', 'price' => 8500000],
        ];

        foreach ($products as $product) {
            // Panggil API untuk generate embedding
            $response = Http::post('http://127.0.0.1:8000/embed', [
                'text' => "{$product['name']}"
            ]);
            $response700 = Http::post('http://127.0.0.1:8000/embed700', [
                'text' => "{$product['name']} {$product['description']}"
            ]);

            $embedding1 = $response->successful()
                ? $response->json()['data']['embedding']
                : array_fill(0, 384, 0); // Dummy jika gagal (384 dimensi)

            $embedding2 = $response700->successful()
                ? $response700->json()['data']['embedding_700']
                : array_fill(0, 700, 0); // Dummy jika gagal (700 dimensi)

            $embeddingStr1 = '[' . implode(',', $embedding1) . ']';
            $embeddingStr2 = '[' . implode(',', $embedding2) . ']';

            Product::create(array_merge($product, [
                'embedding' => $embeddingStr1,
                'embedding_700' => $embeddingStr2
            ]));
        }
    }
}
