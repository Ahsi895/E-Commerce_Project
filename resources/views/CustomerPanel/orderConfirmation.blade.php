<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        p {
            color: #555;
            margin-top: 10px;
        }
        h2 {
            color: #333;
            margin-top: 20px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px 0;
            background-color: #fff;
            border-radius: 5px;
        }
        li:hover {
            background-color: #f3f3f3;
        }
        .product-name {
            font-weight: bold;
        }
        .product-price {
            font-weight: bold;
            color: #FF5733; /* Change the color to your preference */
        }
    </style>
</head>
<body>
    <div class="container">
        @foreach ($order as $order)
        <h1>Order Details</h1>
        <div class="order-details">
            <p>Total Amount: ${{ $order->amount }}</p>
            <p>Delivery Address: {{ $order->address }}</p>
            <h2>Status: {{ $order->status }} </h2>
            <h2>Order Items</h2>
            <ul>
                @foreach($order->orderItems as $item)
                    <li>
                        <span class="product-name">{{ optional($item->product)->pro_name }}</span><br>
                        <strong>Quantity:</strong> {{ $item->quantity }}<br>
                        <span class="product-price">Price: ${{ optional($item->product)->price }}</span>
                    </li>
                @endforeach
                
            </ul>
        </div>
        @endforeach
    </div>
</body>
</html>
