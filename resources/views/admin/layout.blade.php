<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.svg') }}">
    @yield('css')
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('clientProducts') }}" class="btn btn-primary" style="height: 40px;">
                            <i class="bi bi-arrow-left"></i>
                        </a>
                        <div class="logo shadow rounded">
                            <a href="{{ route('home') }}">
                                <img src='{{ asset("shop/".Auth::user()->shop->path."") }}' alt="Logo" srcset="" style="height:100px;" class="rounded">
                            </a>
                        </div>
                        <div class="toggler">
                            <a href="{{ route('home') }}" class="sidebar-hide d-xl-none d-block">
                                <i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-item {{ request()->routeIs('home') ? 'active' : '' }}">
                            <a href="{{ route('home') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dasbor</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('category') || request()->routeIs('categoryCreate') ? 'active' : '' }}">
                            <a href="{{route('category')}}" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Kategori</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('products') || request()->routeIs('productCreate') || request()->routeIs('productAddImages') || request()->routeIs('productEdit') ? 'active' : '' }}">
                            <a href="{{route('products')}}" class='sidebar-link'>
                                <i class="bi bi-box"></i>
                                <span>Produk</span>
                            </a>

                        </li>

                        <li class="sidebar-item {{ request()->routeIs('orders') || request()->routeIs('orderDetail') ? 'active' : '' }}">
                            <a href="{{route('orders')}}" class='sidebar-link'>
                                <i class="bi bi-bag"></i>
                                <span>Pesanan</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('users') || request()->routeIs('userCreate') || request()->routeIs('userEdit') ? 'active' : '' }}">
                            <a href="{{route('users')}}" class='sidebar-link'>
                                <i class="bi bi-people"></i>
                                <span>Manajemen User</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('shippings.*') ? 'active' : '' }}">
                            <a href="{{ route('shippings.index') }}" class='sidebar-link'>
                                <i class="bi bi-truck"></i>
                                <span>Pengiriman</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class=" card">
                <div class="card-body d-flex justify-content-between align-items-center">
                <h3>{{ $title }}</h3>
                @yield('button')
                </div>
            </div>
            <div class="page-content">
                <section class="row">
                    @yield('content')
                </section>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/mazer.js') }}"></script>
    <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>
    @yield('js')
    @if(session('success'))
        <script>
            Toastify({
                text: "{{session('success')}}",
                duration: 3000,
                close:true,
                gravity:"top",
                position: "right",
                backgroundColor: "#4fbe87",
            }).showToast();
        </script>
    @endif

    @if(session('failed'))
        <script>
            Toastify({
                text: "{{session('failed')}}",
                duration: 3000,
                close:true,
                gravity:"top",
                position: "right",
                backgroundColor: "#f3616d",
            }).showToast();
        </script>
    @endif
</body>

</html>
