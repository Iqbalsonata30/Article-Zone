<x-users-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>
    <x-user-navbar title="{{ $title }}" user="{{ $user->email }}" profile="{{ $user->profile }}" />
    @if (session('message'))
        <x-toast message="{{ session()->get('message') }}" class="alert alert-info shadow-xl animate-bounce" />
    @endif
    <div class="md:w-2/3 mx-auto border mt-4 w-full p-3 ">
        <x-mockup>
            <form action="{{ route('article.create') }}" method="POST">
                @csrf
                <div class="flex p-5  bg-base-200 font-sans justify-start flex-col flex-wrap">
                    <div class="form-control max-w-full ">
                        <label class="input-group input-group-vertical m-1 p-2 ">
                            <span class="bg-blue-200 p-1 text-md font-medium px-3">Title</span>
                            <input type="text" placeholder="Title Article" value="{{ old('title') }}"
                                class="input input-bordered" name="title" />
                            @error('title')
                                <small class="text-red-600 ml-1">{{ $message }}</small>
                            @enderror
                        </label>
                        <label class="input-group input-group-vertical m-1 p-2 ">
                            <span class="bg-blue-200 p-1 text-md font-medium px-3">Description</span>
                            <textarea class="textarea textarea-bordered h-24" placeholder="Isi Description" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="text-red-600 ml-1">{{ $message }}</small>
                            @enderror
                        </label>
                        <label class="input-group input-group-vertical m-1 p-2 ">
                            <span class="bg-blue-200 p-1 text-md font-medium px-3">Tag</span>
                            <input type="text" placeholder="Tag Article" class="input input-bordered" name="tag"
                                value="{{ old('tag') }}" />
                            @error('tag')
                                <small class="text-red-600 ml-1">{{ $message }}</small>
                            @enderror
                        </label>
                        <div class="px-3">
                            <button
                                class="btn btn-block btn-info font-bold font-serif hover:btn-accent hover:text-slate-900">Add
                                Article</button>
                        </div>
                    </div>
                </div>
            </form>
        </x-mockup>
    </div>
    <div class="divider text-lg font-semibold font-serif ">Daftar Article User</div>
    <div class="flex justify-center items-stretch flex-row flex-wrap gap-4 md:w-2/3 mx-auto w-full p-3">
        @foreach ($articles as $article)
            <x-card title="{{ $article->title }}" description="{{ $article->description }}"
                tag="{{ $article->tag }}">
                <div class="card-actions justify-end">
                    <form action="{{ route('article.destroy', ['id' => $article->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-error">Delete</button>
                    </form>
                    <a href="{{ route('article.edit', ['slug' => $article->slug]) }}" class="btn btn-warning">Edit</a>
                </div>
            </x-card>
        @endforeach
    </div>
    <div class="flex justify-center items-center  p-5">
        <x-pagination prev-page="{{ $meta['prevPage'] }}" next-page="{{ $meta['nextPage'] }}">
            <a href="#"
                class="items-center hidden px-4 py-2 mx-1 transition-colors duration-200 transform  rounded-md sm:flex  bg-blue-600  text-white ">
                {{ $meta['currentPage'] }}
            </a>
        </x-pagination>
    </div>
</x-users-layout>
