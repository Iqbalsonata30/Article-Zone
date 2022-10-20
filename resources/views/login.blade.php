<x-users-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>
    @if (session('message'))
        <x-toast message="{{ session()->get('message') }}" class="alert alert-success shadow-xl animate-bounce"/>
    @endif
    <x-login-form />
</x-users-layout>
