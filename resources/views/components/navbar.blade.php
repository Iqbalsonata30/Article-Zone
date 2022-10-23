<div class="navbar bg-base-100 shadow-lg font-serif">
    <div class="navbar-start">
        <div class="dropdown">
            <label tabindex="0" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </label>
            <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('users.list') }}">Users List</a></li>
            </ul>
        </div>
        <a class="btn btn-ghost normal-case text-xl" href="{{ route('home') }}">Article-Zone</a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal p-0">
            <li>
                <a href="{{ route('home') }}" @if (request()->segment(1) === null) class="active" @endif>
                    Home
                </a>
            </li>
            <li><a href="{{ route('users.list') }}" @if (request()->segment(1) === 'users') class="active" @endif>Users
                    List</a></li>
        </ul>
    </div>
    <div class="navbar-end">
        <div class="dropdown dropdown-end ">
            <label tabindex="0" class="btn btn-ghost btn-circle" id="btn">
                <div class="indicator ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-door-open" viewBox="0 0 16 16">
                        <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z" />
                        <path
                            d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5zM4 1.934V15h6V1.077l-6 .857z" />
                    </svg>
                </div>
            </label>
            <div tabindex="0" class="mt-3 card card-compact dropdown-content w-52 bg-base-100 shadow hidden "
                id="dropdown-btn">
                <div class="card-body selection:bg-gray-400">
                    <a href="{{ route('login.form') }}"
                        class="font-serif text-md hover:bg-sky-300 hover:rounded-xl hover:text-white p-2 hover:transition hover:duration-300 hover:ease-in-out ">Login</a>
                    <a href="{{ route('register.form') }}"
                        class="font-serif text-md hover:bg-sky-300  hover:rounded-xl hover:text-white p-2 hover:transition hover:duration-300 hover:ease-in-out">Register</a>
                </div>
            </div>
        </div>
    </div>
</div>
