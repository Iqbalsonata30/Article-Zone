<x-users-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>
    @if (session('token'))
        <x-user-navbar title="{{ $title }}" user="{{ $user->email }}" profile="{{ $user->profile }}" />
    @else
        <x-navbar title="{{ $title }}" />
    @endif
    <h1 class="text-3xl font-semibold font-serif text-center p-2 py-3">Posts by {{ $userarticles->name }} : </h1>
    <div class="flex justify-center items-stretch flex-row flex-wrap gap-2 md:gap-4 md:w-2/3 mx-auto w-full">
        @foreach ($articles as $post)
            <a href="{{ route('article.show', ['slug' => $post->slug]) }}"
                class="hover:scale-110 hover:transition group hover:duration-300 ">
                <x-card class="group-hover:bg-blue-400" tag="{{ $post->tag }}" title="{{ $post->title }}"
                    description="{{ $post->description }}">
                    <div class="flex items-center justify-between">
                        <p class="text-sm  text-gray-500 group-hover:text-slate-800">
                            @if ($post->comments->count() == 0)
                                No Comment
                            @else
                                {{ $post->comments->count() . ' Comment' }}
                            @endif
                        </p>
                        <span
                            class="text-sm font-light text-slate-400 group-hover:font-normal group-hover:text-white group-hover:transition">
                            @if (round((time() - strtotime($post->updated_at)) / 3600) <= 24)
                                @if (strtotime($post->updated_at) > strtotime('-1 hours'))
                                    @if (round((time() - strtotime($post->updated_at)) / 60) <= 1)
                                        Beberapa menit yang lalu.
                                    @else
                                        {{ round((time() - strtotime($post->updated_at)) / 60) . ' Menit yang lalu' }}
                                    @endif
                                @else
                                    @if (round((time() - strtotime($post->updated_at)) / 3600) <= 1)
                                        Beberapa jam yang lalu.
                                    @else
                                        {{ round((time() - strtotime($post->updated_at)) / 3600) . ' Jam yang lalu' }}
                                    @endif
                                @endif
                            @else
                                {{ date('d M Y , G:i:s ', strtotime($post->updated_at)) }}
                            @endif
                        </span>
                    </div>
                </x-card>
                <a />
        @endforeach

    </div>
    <div class="flex  justify-center items-center  p-5 ">
        <x-pagination prev-page="{{ $meta['prevPage'] }}" next-page="{{ $meta['nextPage'] }}">
            <a href="#"
                class="items-center hidden px-4 py-2 mx-1 transition-colors duration-200 transform  rounded-md sm:flex  bg-blue-600  text-white ">
                {{ $meta['currentPage'] }}
            </a>
        </x-pagination>
    </div>
</x-users-layout>
