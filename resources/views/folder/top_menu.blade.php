    <!-- Spinner Start -->
    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">123 Street, New York</a></small>
                    <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">Email@Example.com</a></small>
                </div>
                <div class="top-link pe-2">
                    <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                    <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                    <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="index.html" class="navbar-brand">
                    <h1 class="text-primary display-6">Fruitables</h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="/home" class="nav-item nav-link {{ request()->is('home') ? 'active' : '' }}">Home</a>
                        <a href="/shop" class="nav-item nav-link {{ request()->is('shop') ? 'active' : '' }}">Shop</a>
                        <!-- <a href="/productDet" class="nav-item nav-link">Product Detail</a> -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                @if (!empty(Auth::id() && Auth::user()->usertype == 'User'))
                                <a href="{{route('cart')}}" class="dropdown-item">Cart</a>
                                <a href="{{route('user_profile')}}" class="dropdown-item">User Profile</a>
                                <a href="{{route('user_order_details')}}" class="dropdown-item">Order Details</a>
                                @else
                                <a href="{{route('user_profile')}}" class="dropdown-item">User Profile</a>
                                <a href="{{route('login')}}" class="dropdown-item">Login</a>
                                @endif  
                            </div>
                        </div>
                        @if (!empty(Auth::id() && Auth::user()->usertype == 'User'))
                        <a href="/logout" class="nav-item nav-link">Logout</a>
                        @endif
                    </div>
                    <div class="d-flex m-3 me-0">
                        <!-- <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div> -->
                        @if (!empty(Auth::id() && Auth::user()->usertype == 'User'))
                        <a href="/cart" class="position-relative me-4 my-auto">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" 
                                style="top: -5px; left: 15px; height: 20px; min-width: 20px;" id="cart_val">{{$cart_count}}</span>
                        </a>
                        @else
                        <a href="#" class="position-relative me-4 my-auto">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" 
                                style="top: -5px; left: 15px; height: 20px; min-width: 20px;">0</span>
                        </a>
                        @endif
                        
                        <a href="#" class="my-auto">
                            <i class="fas fa-user fa-2x"></i>
                            @if (!empty(Auth::id() && Auth::user()->usertype == 'User'))
                            <h6 class="mb-2">Hello, {{(Auth::user()->name)}}!</h6>
                            @else
                            <h6 class="mb-2">Hi, New User</h6>
                            @endif
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>