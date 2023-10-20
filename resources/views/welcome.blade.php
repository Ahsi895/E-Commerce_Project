@php
    $products = App\Models\Product::all();
@endphp
@extends('products.layout')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-image: url('https://images.unsplash.com/photo-1635405074683-96d6921a2a68?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1738&q=80');
            background-size: cover;
            background-repeat: no-repeat;
        }
        .trending-img{
            height: 100px;
        }
    </style>
</head>

<body class="antialiased position-relative">
    <div class="relative h-full flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                @foreach($products as $index => $item)
                    <li data-bs-target="#myCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                @foreach($products as $index => $item)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <a href="{{ route('CustomerPanel.viewProduct', ['id' => $item->pro_id]) }}"><img style="width: 3000px; height: 600px;" src="{{ asset($item->image) }}" alt="Image"></a>
                        <div class="carousel-caption d-none d-md-block">
                            <h3>{{ $item->pro_name }}</h3>
                            <p>Price: ${{ $item->price }}</p>
                            <p>Stock: {{ $item->stock }}</p>
                            <p>Details: {{ $item->details }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div><br>
        <div class="d-flex justify-content-center flex-lg-wrap gap-4">
        @foreach($products as $index => $item)
        <div class="card" style="width: 18rem; padding: 25px">
            <img style = "width:200px; height: 150px;" src=" {{ asset($item->image) }}" class="card-img-top" alt="No image">
            <div class="card-body">
              <h5 class="card-title">{{ $item->pro_name }}</h5>
              <p>Price: ${{ $item->price }}</p>
              <a href="{{ route('CustomerPanel.viewProduct', ['id' => $item->pro_id]) }}" class="btn btn-primary" >View more</a>
            </div>
        </div>
        @endforeach
    </div>

    </div>
</body>
</html>
