<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
</head>
<body>
    <h1>Add Product</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" required>
        <br>
        <label>Description:</label>
        <textarea name="description"></textarea>
        <br>
        <label>Price:</label>
        <input type="number" name="price" required>
        <br>
        <button type="submit">Save</button>
    </form>
    <a href="{{ route('products.index') }}">Back</a>
</body>
</html>
