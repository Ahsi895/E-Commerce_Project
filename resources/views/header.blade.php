@php
    $category = App\Models\Category::all();
@endphp
<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width,
    initial-scale=1.0"> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
<a href="/"><title>E-Commerce Store</title> </a>
<style> body { font-family: 'Nunito', sans-serif;
                display: inline; } 

    </style> </head> <body
    style="background-color: black;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container"> <a class="navbar-brand" href="/">E-Commerce Store</a> <button class="navbar-toggler"
            type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"
            aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarNav"> <ul class="navbar-nav"> <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            
                    @foreach($category as $item)
                            <a class="dropdown-item" href="/category/{{ $item->cat_id }}">{{ $item->name }}</a>
                    @endforeach
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('CustomerPanel.history') }}">Orders</a>
                </li>
                </ul>
                <form action="{{ route('CustomerProduct.search') }}" class="d-flex" method="GET">
                    <input class="form-control me-2 search-box"name="query" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search </button>
                </form>

            </div>
            
            @if (session('user'))
            <div class="mt-2" style="color: green">
                <a href="/CartList">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                  </svg>
                </a>
            </div>
            @endif
        </div>
        <div style="padding-top: 40px">
        @include('layouts.app')
    </div>

    </nav>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    </body>

    </html>