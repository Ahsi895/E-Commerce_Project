@extends('products.layout')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: red;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        header h1 {
            margin: 0;
        }

        .product-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(255, 217, 0, 0.1);
            text-align: left;
            background-color: #fff
        }

        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .product-title {
            font-size: 24px;
            margin-top: 20px;
        }

        .product-description {
            font-size: 16px;
            margin-top: 10px;
        }

        .product-price {
            font-size: 24px;
            margin-top: 20px;
        }

        .product-button {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            margin-top: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body style="background-color: #fff">
    @include('header');
    <header>
        <h1>Product Details</h1>
    </header><br>

    <div class="product-container">
        <div class="text-left">
            <a href="/" class="btn btn-primary">Back</a><br><br>
        </div>
        <img class="product-image" style="width:300px; height: 200px;" src="{{ asset($product->image) }}" alt="Product Image">
        <h2 class="product-title">Product Name: {{ $product->pro_name }} </h2>
        <p class="product-description">{{ $product->details }}</p>
        <p class="product-price">${{ $product->price }}</p>
        <div class="input-group" width="3px">
            <span class="input-group-btn">
                
            </span>
            
            <span class="input-group-btn">
            </span>
        </div>
        
        <form id="addToCartForm" action="{{ route('addToCart') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->pro_id }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
            <input style="width: 55px" type="number" class="form-control text-center" name="quantity" placeholder="Quantity" value="1" id="quantity">
            <br>
            <button class="btn btn-success">Add to Cart</button>
        </form>
        <br><br>
        <button class="btn btn-primary">Buy Now</button>
    </div>
    <br>
    <script>
        document.getElementById('addToCartForm').addEventListener('submit', function (e) {
            e.preventDefault();
            
            // Submit the form data via AJAX
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (response) {
                    alert(response.message); 
                },
            });
        });
    </script>
    
    @include('footer');
</body>
</html>
