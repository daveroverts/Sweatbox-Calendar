@php($carbon = new \Carbon\Carbon())
<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Sweatbox Calendar') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
        @if(Auth::check())
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ Request::is('calendar*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('calendar.index') }}">Calendar</a></li>
                    <li class="nav-item {{ Request::is('student*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('student.index') }}">Students</a></li>
                    <li class="nav-item {{ Request::is('mentor*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('mentor.index') }}">Mentors</a></li>
                </ul>
        @endif
            
            <!-- Middle Side of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li>Current date/time: <?php echo $carbon::now('UTC')->format('l d-m-Y Hi').'z' ?></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <a class="dropdown-item" href="{{ route('changePassword') }}">
                                Change Password
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