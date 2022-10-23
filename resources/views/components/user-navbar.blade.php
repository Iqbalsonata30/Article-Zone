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
                <li>
                    <a href="{{ route('home') }}" @if (request()->segment(1) === null) class="active" @endif>
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.list') }}" @if (request()->segment(1) === 'users') class="active" @endif>
                        Users List
                    </a>
                </li>
                <li><a href="{{ route('dashboard') }}"
                        @if (request()->segment(1) === 'dashboard') class="active" @endif>Dashboard</a>
                </li>
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
            <li>
                <a href="{{ route('users.list') }}" @if (request()->segment(1) === 'users') class="active" @endif>
                    Users List
                </a>
            </li>
            <li><a href="{{ route('dashboard') }}" @if (request()->segment(1) === 'dashboard') class="active" @endif>Dashboard</a>
            </li>
        </ul>
    </div>
    <div class="navbar-end">
        <div class="dropdown dropdown-end ">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                    <img src="/img/{{ $profile }}" id="btn" />
                </div>
            </label>
            <div tabindex="0" class="mt-3 card card-compact dropdown-content w-52 bg-base-100 shadow hidden "
                id="dropdown-btn">
                <div class="card-body selection:bg-gray-400">

                    <a href="{{ route('profile', ['user' => $user]) }}"
                        class="font-serif text-md hover:bg-sky-300 hover:rounded-xl hover:text-white p-2 hover:transition hover:duration-300 hover:ease-in-out ">Profile</a>
                    <form action="{{ route('logout.action') }}" method="POST"
                        class="font-serif text-md hover:bg-sky-300 cursor-pointer
                        hover:rounded-xl hover:text-white p-2 hover:transition hover:duration-300 hover:ease-in-out">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="token" value="{{ session('token') }}" />
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
