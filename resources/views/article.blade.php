<x-guest-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>
    @if (session('token'))
        <x-user-navbar  user="{{ $user->email }}" profile="{{ $user->profile }}" />
    @else
        <x-navbar  />
    @endif
    @if (session('message'))
        <x-toast message="{{ session()->get('message') }}"
            class="alert alert-error shadow-xl animate-bounce text-white" />
    @endif
    <div class="md:w-2/3 mx-auto border  mt-4 max-w-full p-3  ">
        <x-mockup>
            <div
                class="flex justify-start  px-5 
            py-5 bg-base-200 font-serif text-md md:text-lg flex-col flex-wrap">
                <span class="text-sm font-light text-slate-600 ">
                    @if (round((time() - strtotime($article->updated_at)) / 3600) <= 24)
                        @if (strtotime($article->updated_at) > strtotime('-1 hours'))
                            @if (round((time() - strtotime($article->updated_at)) / 60) < 2)
                                Diposting sejak beberapa menit yang lalu.
                            @else
                                {{ 'Diposting sejak ' . round((time() - strtotime($article->updated_at)) / 60) . ' menit yang lalu.' }}
                            @endif
                        @else
                            @if (round((time() - strtotime($article->updated_at)) / 3600) <= 1)
                                Diposting sejak beberapa jam yang lalu.
                            @else
                                {{ 'Diposting sejak ' . round((time() - strtotime($article->updated_at)) / 3600) . ' jam yang lalu.' }}
                            @endif
                        @endif
                    @else
                        {{ date('d M Y , G:i:s ', strtotime($article->updated_at)) }}
                    @endif
                </span>
                {{ $article->description }}
            </div>
            <div class="flex items-center justify-end px-5 py-4 bg-base-200">
                <div class="flex items-center">
                    <img class="object-cover w-10 h-10 mx-4 rounded-full" src="/img/{{ $article->users->profile }}"
                        alt="avatar">
                    <a href="{{ route('posts.user', ['email' => $article->users->email]) }}"
                        class="font-bold text-gray-700 cursor-pointer text-sm md:text-lg ">{{ $article->users->name }}</a>

                </div>
            </div>
            <div class="divider text-lg font-mono font-semibold">Comment</div>

            @foreach ($comments as $item)
                <div class="flex flex-col flex-wrap  justify-start  p-3 max-w-full ">
                    <div
                        class="w-full min-h-fit bg-slate-300 p-3 rounded-xl  shadow-xl border-b-4 break-all border-zinc-600">

                        @if (session('token'))
                            <div class="flex justify-end items-end">
                                @if ($item->users->name === $author)
                                    <form action="{{ route('comment.destroy', ['id' => $item->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn-ghost hover:bg-slate-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endif
                        <div class="flex   justify-start items-center font-mono text-lg text-slate-900 p-2 ">
                            {{ $item->comment }}
                        </div>
                        <div class="flex justify-end items-center text-sm font-sans font-semibold text-gray-600">
                            @if (round((time() - strtotime($item->updated_at)) / 3600) <= 24)
                                @if (strtotime($item->updated_at) > strtotime('-1 hours'))
                                    @if (round((time() - strtotime($item->updated_at)) / 60) < 2)
                                        beberapa menit yang lalu
                                    @else
                                        {{ 'Comment sejak ' . round((time() - strtotime($item->updated_at)) / 60) . ' menit yang lalu' }}
                                    @endif
                                @else
                                    @if (round((time() - strtotime($item->updated_at)) / 3600) <= 1)
                                        beberapa jam yang lalu.
                                    @else
                                        {{ 'Comment sejak ' . round((time() - strtotime($item->updated_at)) / 3600) . ' jam yang lalu' }}
                                    @endif
                                @endif
                            @else
                                {{ date('d M Y , G:i:s ', strtotime($item->updated_at)) }}
                            @endif By {{ $item->users->name }}
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="flex flex-col flex-wrap justify-center  max-w-full p-2 mx-4 ">
                <form action="{{ route('comment.create', ['slug' => $article->slug]) }}" method="POST">
                    @csrf
                    @if (session('token'))
                        <div class="form-control">
                            <input type="text " placeholder="Berikan komentar"
                                class="input w-full max-w-4xl  focus:ring-blue-200" name="comment" />
                            @error('comment')
                                <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    @else
                        <div class="form-control">
                            <input type="text " placeholder="Login untuk  komentar"
                                class="input w-full max-w-4xl  focus:ring-blue-200" name="comment" disabled />
                        </div>
                    @endif
                    <div class="mt-3">
                        <button type="submit"
                            class="btn btn-block bg-blue-200 hover:bg-blue-400 border-none  text-slate-700 hover:text-white font-bold"
                            @if (!session('token')) disabled @endif>
                            Komentar</button>
                    </div>
                </form>
            </div>
        </x-mockup>
    </div>
</x-guest-layout>
