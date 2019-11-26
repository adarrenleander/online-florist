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
                    <a class="nav-link" href="{{ route('home') }}">{{ __('Catalog') }}</a>
                </li>
                <li>
                    <a class="nav-link" href="/profile">{{ __('Profile') }}</a>
                </li>

                @if (Auth::user()->role == 'admin')
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Admin Menu<span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/manage-flowers">
                            {{ __('Manage Flowers') }}
                        </a>
                        <a class="dropdown-item" href="/manage-flower-types">
                            {{ __('Manage Flower Types') }}
                        </a>
                        <a class="dropdown-item" href="/manage-couriers">
                            {{ __('Manage Couriers') }}
                        </a>
                        <a class="dropdown-item" href="/manage-users">
                            {{ __('Manage Users') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('login') }}">
                            {{ __('Transaction History') }}
                        </a>
                    </div>
                </li>
                @endif
            @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li>
                        <a class="nav-link">{{ __('DateTime') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
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