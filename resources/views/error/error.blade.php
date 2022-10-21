<x-users-layout>
    <x-slot name="title">
        Page Error
    </x-slot>
    @if (session('token'))
        <x-user-navbar title="Error Page" user="Error" profile="{{ $user->profile }}" />
    @else
        <x-navbar title="Error Page" />
    @endif
    <div class="flex justify-center items-center min-h-screen">
        <h2 class="text-4xl">404 |</h2>
        <p class="font-thin text-xl">Maaf,Data <span class="underline decoration-wavy">{{ $data }}</span> tidak
            dapat kami
            temukan</p>
    </div>
</x-users-layout>
