<!DOCTYPE html>
<html>
<head>
    <title>View Abandoned Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <a href="{{ route('showabandonedCart') }}" class="btn btn-primary mt-4">Back</a>
        <h1 class="mt-4">View Abandoned Cart</h1>

        <div class="mt-4">
            <h2>User Information</h2>
            <p><strong>User ID:</strong> {{ $user->user_id }}</p>
            <p><strong>User Name:</strong> {{ $user->name }}</p>
            <p><strong>User Address:</strong> {{ $user->address }}</p>
            <p><strong>User Email:</strong> {{ $user->email }}</p>

        </div>

        <div class="mt-4">
            <h2>Product Information</h2>
            <p><strong>Product ID:</strong> {{ $product->pro_id }}</p>
            <p><strong>Product Name:</strong> {{ $product->pro_name }}</p>
            <p><strong>Product Price:</strong> ${{ $product->price }}</p>
            <p><strong>Product Details:</strong> {{ $product->details }}</p>
            <p><strong>Product Quantity:</strong> {{ $abandonedCart->quantity }}</p>
            <img src="{{ asset($product->image) }}" alt="{{ $product->pro_name }}" class="img-thumbnail" style="width: 200px; height: 200px;">
        </div>

        
    </div>
</body>
</html>
