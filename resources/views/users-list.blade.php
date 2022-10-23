<x-users-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>
    @if (session('token'))
        <x-user-navbar user="{{ $user->email }}" profile="{{ $user->profile }}" />
    @else
        <x-navbar />
    @endif
    <div class="md:w-4/5 p-3  md:mx-auto mt-4 w-full">
        <x-sm-table>
            @foreach ($users as $user)
                <tbody>
                    <tr class="border border-b-4">
                        <td>
                            <div class="flex items-center flex-col justify-center text-center space-x-3 gap-2">
                                <div class="avatar">
                                    <div class="mask mask-squircle w-12 h-12">
                                        <img src="/img/{{ $user->profile }}" />
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold hover:underline"><a
                                            href="{{ route('profile', ['user' => $user->email]) }}">{{ $user->name }}<a />
                                    </div>
                                    <div class="text-sm opacity-50">{{ $user->email }}</div>
                                </div>
                                @if ($user->articles->count() === 0)
                                    <span class="badge badge-ghost badge-lg text-md">
                                        No Post
                                    </span>
                                @else
                                    <div
                                        class="badge badge-ghost badge-lg text-md hover:bg-purple-500 hover:rotate-12 hover:text-white">
                                        @if ($user->articles->count() === 1)
                                            <a href="{{ route('posts.user', ['email' => $user->email]) }}">1
                                                Post</a>
                                        @else
                                            <a href="{{ route('posts.user', ['email' => $user->email]) }}">{{ $user->articles->count() }}
                                                Posts</a>
                                        @endif
                                    </div>
                                @endif
                                <span class="badge badge-primary badge-md">
                                    @if ($user->comments->count() === 0)
                                        No Comment
                                    @else
                                        @if ($user->comments->count() === 1)
                                            1 Comment
                                        @else
                                            {{ $user->comments->count() }} Comments
                                        @endif
                                    @endif
                                </span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </x-sm-table>

        <x-table>
            @foreach ($users as $user)
                <tbody>
                    <tr>
                        <td>
                            <div class="flex items-center space-x-3">
                                <div class="avatar">
                                    <div class="mask mask-squircle w-12 h-12">
                                        <img src="/img/{{ $user->profile }}" />
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold hover:underline">
                                        <a
                                            href="{{ route('profile', ['user' => $user->email]) }}">{{ $user->name }}</a>
                                    </div>
                                    <div class="text-sm opacity-50">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>

                            @if ($user->articles->count() === 0)
                                <span class="badge badge-ghost badge-lg text-md">
                                    No Post
                                </span>
                            @else
                                <div
                                    class="badge badge-ghost badge-lg text-md hover:bg-purple-500 hover:rotate-12 hover:text-white">
                                    @if ($user->articles->count() === 1)
                                        <a href="{{ route('posts.user', ['email' => $user->email]) }}">1 Post</a>
                                    @else
                                        <a href="{{ route('posts.user', ['email' => $user->email]) }}">{{ $user->articles->count() }}
                                            Posts</a>
                                    @endif
                                </div>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-primary badge-md">
                                @if ($user->comments->count() === 0)
                                    No Comment
                                @else
                                    @if ($user->comments->count() === 1)
                                        1 Comment
                                    @else
                                        {{ $user->comments->count() }} Comments
                                    @endif
                                @endif
                            </span>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </x-table>
        <div class="flex justify-center items-center mt-3">
            <x-pagination prev-page="{{ $meta['prevPage'] }}" next-page="{{ $meta['nextPage'] }}">
                <a href="#"
                    class="items-center hidden px-4 py-2 mx-1 transition-colors duration-200 transform  rounded-md sm:flex  bg-blue-600  text-white ">
                    {{ $meta['currentPage'] }}
                </a>
            </x-pagination>
        </div>
    </div>
</x-users-layout>
