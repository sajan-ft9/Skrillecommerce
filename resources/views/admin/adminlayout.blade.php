<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <style>
        <style>body {
            background-color: whitesmoke;
        }

        .inforide {
            box-shadow: 1px 2px 8px 0px #f1f1f1;
            background-color: white;
            border-radius: 8px;
            height: 125px;
        }


        .rideone {
            background-color: #6CC785;
            padding-top: 25px;
            border-radius: 8px 0px 0px 8px;
            text-align: center;
            height: 125px;
            margin-left: 15px;
        }

        .ridetwo {
            background-color: #9A75FE;
            padding-top: 30px;
            border-radius: 8px 0px 0px 8px;
            text-align: center;
            height: 125px;
            margin-left: 15px;
        }

        .ridethree {
            background-color: #4EBCE5;
            padding-top: 35px;
            border-radius: 8px 0px 0px 8px;
            text-align: center;
            height: 125px;
            margin-left: 15px;
        }

        .fontsty {
            margin-right: -15px;
        }

        .fontsty h2 {
            color: #6E6E6E;
            font-size: 35px;
            margin-top: 15px;
            text-align: right;
            margin-right: 30px;
        }

        .fontsty h4 {
            color: #6E6E6E;
            font-size: 25px;
            margin-top: 20px;
            text-align: right;
            margin-right: 30px;
        }
    </style>
    </style>
    <title>Document</title>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/admin/dashboard">Ecommerce</a>
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
                    <a href="/admin/dashboard" class="nav-link border-bottom">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="/admin/dashboard" class="nav-link border-bottom">Dashboard</a>
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