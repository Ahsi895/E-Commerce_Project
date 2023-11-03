<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Abandoned Cart Products</title>


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>
<style>
    #abandonedCartTable {
        width: 100%;
        padding: 5px;
    }

    #abandonedCartTable thead th {
        background-color: #3498db;
        color: #fff;
        padding: 10px;
    }

    #abandonedCartTable tbody td {
        padding: 10px;
    }
</style>
<body>
    <div class="container">
        <div class="text-left"><br>
            <a href="/admin/login" class="btn btn-primary">Back</a><br><br>
        </div>
        <h1>Abandoned Cart Products</h1>
        <table id="abandonedCartTable" class="display">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>User ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Details</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($abandonedCarts as $cart)
    <tr>
        <td>{{ $cart->product_id }}</td>
        <td>{{ $cart->user_id }}</td>
        <td>{{ optional($cart->product)->pro_name }}</td>
        <td>${{ optional($cart->product)->price }}</td>
        <td>{{ optional($cart->product)->details }}</td>
        <td>{{ $cart->quantity }}</td>
        <td>
            <img src="{{ asset(optional($cart->product)->image) }}" alt="{{ optional($cart->product)->pro_name }}" style="width: 100px; height: 100px;">
        </td>
        <td>
            <form action=" {{ route('viewAbandonedCart') }}" method="get">
                @csrf
                <input type="hidden" name="user_id" value="{{ $cart->user_id }}">
                <input type="hidden" name="product_id" value="{{ $cart->product_id }}">
                <button type="submit" class="btn btn-primary">View</button>
            </form>
        </td>
    </tr>
@endforeach

            </tbody>
        </table>
    </div>  

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script>
        jQuery(document).ready(function ($) {
            $('#abandonedCartTable').DataTable();
        });
    </script>
</body>
</html>
