<nav class="navbar navbar-expand-md navbar-light bg-red">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            Online Florist
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
            @auth
                <li>
                    <a class="nav-link" href="{{ route('home') }}">Catalog</a>
                </li>
                <li>
                    <a class="nav-link" href="/profile">Profile</a>
                </li>

                <!-- admin menu only accessible if user's role is admin -->
                @if (Auth::user()->role == 'admin')
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Admin Menu<span class="caret"></span>
                    </a>

                    <!-- dropdown menu -->
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/manage-flowers">Manage Flowers</a>
                        <a class="dropdown-item" href="/manage-flower-types">Manage Flower Types</a>
                        <a class="dropdown-item" href="/manage-couriers">Manage Couriers</a>
                        <a class="dropdown-item" href="/manage-users">Manage Users</a>
                        <a class="dropdown-item" href="/transaction-history">Transaction History</a>
                    </div>
                </li>
                @endif
            @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <!-- if user not logged in yet aka a guest -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                @else
                    <li>
                        <a class="nav-link" href="/cart">Cart</a>
                    </li>
                    <li>
                        <!-- display current time -->
                        <!-- does not tick in real time and uses default timezone -->
                        <a class="nav-link">{{ Carbon\Carbon::now()->toDayDateTimeString() }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>