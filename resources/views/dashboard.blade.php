@extends('products.layout')

<!DOCTYPE html>
<html> <head> <title>Dashboard</title>
    <style> body { font-family: 'Nunito' , sans-serif; } </style> </head>

        <body class="d-flex flex-column justify-content-between position-relative">
            @section('content')
            <div class="container">
                @include('header')
            
                
                
                @include('welcome')
            </div>
            @include('footer')
            @endsection
        </body>

        </html>