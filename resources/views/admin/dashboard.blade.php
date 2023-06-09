@extends('admin.adminlayout')

@section('content')

<section>
    <h1>Dashboard</h1>
    <div class="container-fluid  text-white ">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
            <div class="col-sm-6">
                <div class="bg-success text-center rounded p-2">
                    <h2>
                        <i class="bi bi-cash-coin"></i>
                        <span>Revenue</span>
                    </h2>
                    <h5>Rs. {{ number_format($total_revenue) }}</h5>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="bg-primary  text-center rounded p-2">
                    <h2>
                        <i class="bi bi-people"></i>
                        <span>Users</span>
                    </h2>
                    <h5>{{ $total_users }}</h5>
                </div>
            </div>
            <div class="col-sm-6">
                <div class=" text-center rounded p-2 bg-warning">
                    <a href="/admin/orders" class="text-decoration-none text-white">
                    <h2>
                        <i class="bi bi-bag-plus"></i>
                        <span>Orders</span>
                    </h2>
                    <h5>{{ $total_orders }}</h5>
                    </a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class=" text-center rounded p-2 bg-danger">
                    <a href="/admin/lowstocks" class="text-decoration-none text-white">
                        <h2>
                            <i class="bi bi-exclamation-diamond"></i>
                            <span>Low Stocks</span>
                        </h2>
                        <h5>{{ $low_stocks }}</h5>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection