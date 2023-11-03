<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Orders</title>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    #ordersTable {
        width: 100%;
        padding: 5px;
    }

    #ordersTable thead th {
        background-color: #3498db;
        color: #fff;
        padding: 10px;
    }

    #ordersTable tbody td {
        padding: 10px;
    }
</style>
<body>
    <div class="container">
        <h1>Orders</h1>
        <table id="ordersTable" class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Delivery Address</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->user_id }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->amount }}</td>
                    <form action="{{ route('orderStatus') }}" method="POST">
                        @csrf
                        <input type="hidden" name="orderID" value="{{ $order->order_id }}">
                        <td>
                            <select class="form-select" name="status">
                                <option value="Pending" {{ $order->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Processing" {{ $order->status === 'Processing' ? 'selected' : '' }}>Processing</option>
                                <option value="Shipped" {{ $order->status === 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="Delivered" {{ $order->status === 'Delivered' ? 'selected' : '' }}>Delivered</option>
                            </select><br>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </td>
                    </form>
                </tr>
                
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script>
        jQuery(document).ready(function ($) {
            $('#ordersTable').DataTable();
        });
    </script>
</body>
</html>
