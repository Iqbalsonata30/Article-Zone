<x-guest-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>
    @if (session('token'))
        <x-user-navbar title="{{ $title }}" user="{{ $user }}" />
    @else
        <x-navbar title="{{ $title }}" />
    @endif
    <div class="md:w-2/3 max-w-full mx-auto  p-3 m-2  ">
        <div class="collapse border border-base-300 bg-base-100 rounded-box  ">
            <input type="checkbox" />
            <div class="collapse-title text-xl font-medium text-center border-b-2">
                Daftar Article Tag : {{ $tag }}
            </div>
            <div class="collapse-content py-1">
                @foreach ($item as $article)
                    <div
                        class="flex justify-start flex-col px-4 py-2 rounded-xl text-lg text-gray-600  transition-colors duration-300 transform  hover:bg-gray-200   hover:text-slate-800 hover:underline hover:transition  ">
                        <a href="{{ route('article.show', ['slug' => $article->slug]) }}">
                            {{ $article->title }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-guest-layout>
