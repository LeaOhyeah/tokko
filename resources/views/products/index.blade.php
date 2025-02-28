<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <style>
        .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            /* Dua kolom dengan lebar sama */
            gap: 20px;
        }

        .item {
            padding: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="item">
            <h1>Product List</h1>
            <a href="{{ route('products.create') }}">Add Product</a>

            <form action="{{ route('products.search') }}" method="GET">
                <input type="text" style="width: 300px" name="q" placeholder="Find product..." value="{{ request('q') }}">
                
                <select name="mode">
                    <option value="name" {{ request('mode') == 'name' ? 'selected' : '' }}>Product Name</option>
                    <option value="description" {{ request('mode') == 'description' ? 'selected' : '' }}>Describe your product</option>
                </select>
            
                <button type="submit">Find</button>
            </form>
            

            @if ($productsAll->isEmpty())
                <p>Tidak ada hasil ditemukan.</p>
            @else
                <ul>
                    @foreach ($productsAll as $p)
                        <li>{{ $p->name }} - {{ $p->price }} |
                            <a href="{{ route('products.edit', $p->id) }}">Edit</a>
                            <form action="{{ route('products.destroy', $p->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="item">
            <h1>Find Result</h1>
            @if (!$products)
                <p>Tidak ada hasil ditemukan.</p>
            @else
                <ul>
                    @foreach ($products as $product)
                        <li>{{ $product['name'] }} - {{ $product['price'] }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

    </div>


</body>

</html>
