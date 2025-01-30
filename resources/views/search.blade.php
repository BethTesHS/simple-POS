<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item List</title>
</head>
<body>

<h1>Item List</h1>

<!-- Search Form -->
<form method="GET" action="{{ route('test.search') }}">
    <input type="text" name="search" value="{{ $query }}" placeholder="Search for an item...">
    <button type="submit">Search</button>
</form>

<!-- Display the filtered list -->
<ul>
    @foreach ($products as $product)
        <li>{{ $product->productName }}</li>
    @endforeach
</ul>

</body>
</html>
