<x-users-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>
    @if (session('token'))
        <x-user-navbar user="{{ $user->email }}" profile="{{ $user->profile }}" />
    @else
        <x-navbar />
    @endif
    <div class="md:w-2/3 w-full mx-auto my-2 py-3 px-6 ">
        <div class="mockup-code flex flex-col justify-center items-center p-3 bg-white">
            <div class="stats stats-vertical  m-1 bg-transparent ">
                <div class="stat ">
                    <div class="stat-figure text-secondary">
                        <div class="avatar ">
                            <div class="w-40 rounded-full  ring ring-primary ring-offset-base-100 ring-offset-2">
                                <img src="/img/{{ $user->profile }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" text-slate-900 text-center">
                <div class="max-w-md">
                    <h1 class="text-4xl font-bold font-mono capitalize">{{ $user->name }}</h1>
                    <h3 class="text-gray-500 font-sans">{{ $user->email }}</h3>
                </div>
            </div>
            <div class="divider"></div>
            <div class="stats stats-vertical lg:stats-horizontal bg-white text-black  p-8">
                <div class="stat">
                    <div class="stat-figure text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="inline-block w-8 h-8 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                            </path>
                        </svg>
                    </div>
                    <div class="stat-title">Total Posts </div>
                    <div class="stat-value text-primary">{{ $user->articles()->count() }} </div>
                </div>

                <div class="stat">
                    <div class="stat-figure text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="inline-block w-8 h-8 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="stat-title">Total Comments</div>
                    <div class="stat-value text-secondary">{{ $user->comments()->count() }} </div>
                </div>
            </div>
        </div>

    </div>
</x-users-layout>
