<!DOCTYPE html>
<html>
<head>
    <title>Laravel Crud Application</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
</head>
<body>
    @php
    $products = App\Models\Product::all();
@endphp
<div class="container">
    @yield('content')
</div>
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>
</body>
</html>