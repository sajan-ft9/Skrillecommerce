<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> 
    <!-- Bootstrap CSS -->
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Bootstrap Bundle with Popper -->
    <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>


    <title>Document</title>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/">Ecommerce</a>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="offcanvas offcanvas-start" style="width:250px" tabindex="-1" id="sidebar"
        aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarLabel">Sidebar</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/admin/dashboard" class="nav-link border-bottom">Dashboard</a>
                </li>
                {{-- <li class="nav-item dropdown border-bottom">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Products
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/products/all">Show all</a></li>
                        <li><a class="dropdown-item" href="">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li> --}}
                <li class="nav-item">
                    <a href="/admin/products" class="nav-link border-bottom">Products</a>
                </li>
                <li class="nav-item">
                    <a href="/admin/orders" class="nav-link border-bottom">Orders</a>
                </li>
                <li class="nav-item">
                    <form class="dropdown-item" action="/logout" method="POST">
                        @csrf
                        <label for="">Logout</label>
                        <button class="w -25 mx-2 btn btn-danger" type="submit"><i class="bi bi-box-arrow-in-right"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        @yield('content')
    </div>

</body>

</html>