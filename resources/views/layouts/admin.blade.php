<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>F&L Admin - @yield('title', 'Dashboard')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg" style="background-color:orange">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="{{ route('home') }}">F&L Admin</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.products.index') }}">Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">Users</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.news.index') }}">News</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.reviews.index') }}">Reviews</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.messages.index') }}">Messages</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.orders.index') }}">Orders</a></li>
                    </ul>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-sm btn-outline-dark">Log Out</button>
                </form>
            </div>
        </nav>
        @if (session('success'))
            <div class="alert alert-success m-3">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger m-3">{{ session('error') }}</div>
        @endif
        <div class="container mt-4">
            @yield('content')
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        @stack('scripts')
    </body>
</html>
