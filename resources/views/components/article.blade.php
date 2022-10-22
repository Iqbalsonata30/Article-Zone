<div
    class="md:w-2/3 px-8 py-4 mx-auto bg-white rounded-lg shadow-lg w-5/6 
            hover:scale-110 hover:transition hover:bg-blue-400 group hover:duration-300 selection:bg-blue-200 selection:hover:bg-gray-400">
    <div class="flex items-center justify-between">
        <span
            class="text-sm font-light text-slate-400 group-hover:font-normal group-hover:text-white group-hover:transition">
            @if (round((time() - strtotime($date)) / 3600) <= 24)
                @if (strtotime($date) > strtotime('-1 hours'))
                    @if (round((time() - strtotime($date)) / 60) <= 1)
                        Beberapa menit yang lalu.
                    @else
                        {{ round((time() - strtotime($date)) / 60) . ' Menit yang lalu' }}
                    @endif
                @else
                    @if (round((time() - strtotime($date)) / 3600) <= 1)
                        Beberapa jam yang lalu.
                    @else
                        {{ round((time() - strtotime($date)) / 3600) . ' Jam yang lalu' }}
                    @endif
                @endif
            @else
                {{ date('d M Y , G:i:s ', strtotime($date)) }}
            @endif
        </span>
        @if ($tag != null)
            <a href="{{ route('tags', ['tag' => $tag]) }}"
                class="px-3 py-1 text-sm font-bold text-gray-100 transition-colors duration-200 transform bg-gray-800 rounded cursor-pointer group-hover:bg-gray-500 group-hover:duration-700">{{ $tag }}</a>
        @endif
    </div>

    <div class="mt-2">
        <a href="{{ $route }}"
            class="text-2xl font-bold group-hover:text-white group-hover:text-3xl group-hover:transition-all group-hover:underline group-hover:underline-offset-2 ">{{ $title }}</a>
        <p class="mt-2 group-hover:font-serif group-hover:transition">{{ $description }}</p>
    </div>

    <div class="flex items-center justify-between mt-4">
        <p class="text-sm  text-gray-500 group-hover:text-slate-800">
            @if ($totalComments == 0)
                No Comment
            @else
                {{ $totalComments . ' Comment' }}
            @endif
        </p>
        <div class="flex items-center">
            <div class="flex items-center">
                <img class="hidden object-cover w-10 h-10 mx-4 rounded-full sm:block"
                    src="/img/profile/{{ $profile }}" alt="avatar">
                <a
                    href="{{ route('posts.user', ['email' => $email]) }}"class="font-bold text-gray-700 cursor-pointer text-sm md:text-lg ">{{ $name }}</a>
                <!-- lg -->
            </div>
        </div>
    </div>
</div>
