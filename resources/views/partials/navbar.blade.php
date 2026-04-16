<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto me-lg-0">
            <h1>F&L<span>.</span></h1>
        </a>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="{{ route('home') }}#hero">Home</a></li>
                <li><a href="{{ route('home') }}#menu">Products</a></li>
                <li><a href="{{ route('home') }}#testimonials">Reviews</a></li>
                <li><a href="{{ route('home') }}#events">News</a></li>
                @auth
                <li class="dropdown">
                    <a href="#"><span>{{ auth()->user()->full_name }}</span>
                        <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        @if(auth()->user()->isLoyalCustomer())
                        <li class="dropdown">
                            <a href="#"><span>Messages</span>
                                <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                            <ul>
                                @forelse(auth()->user()->sharedMessages as $sm)
                                <li><a href="#">{{ $sm->message->message }}</a></li>
                                @empty
                                <li><a href="#">No messages</a></li>
                                @endforelse
                            </ul>
                        </li>
                        @endif
                        <li><a href="{{ route('review.create') }}">Leave a Review</a></li>
                        <li><a href="{{ route('orders.index') }}">My Orders</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                                @csrf
                                <button type="submit" style="background:none;border:none;padding:0">Log Out</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li><a href="{{ route('login') }}">Log In</a></li>
                @endauth
            </ul>
        </nav>
    </div>
</header>
