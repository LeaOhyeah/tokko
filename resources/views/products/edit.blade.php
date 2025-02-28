<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Name:</label>
        <input type="text" name="name" value="{{ $product->name }}" required>
        <br>
        <label>Description:</label>
        <textarea name="description">{{ $product->description }}</textarea>
        <br>
        <label>Price:</label>
        <input type="number" name="price" value="{{ $product->price }}" required>
        <br>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('products.index') }}">Back</a>
</body>
</html>
