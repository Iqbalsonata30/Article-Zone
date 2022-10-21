<x-users-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>
    <x-user-navbar title="{{ $title }}" user="{{ $user->email }}" profile="{{ $user->profile }}" />
    <div class="md:w-2/3 mx-auto border mt-4 w-full p-3">
        <x-mockup>
            <form action="{{ route('article.update', ['id' => $article->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="flex p-5  bg-base-200 font-sans justify-start flex-col flex-wrap">
                    <div class="form-control max-w-full ">
                        <label class="input-group input-group-vertical m-1 p-2 ">
                            <span class="bg-blue-200 p-1 text-md font-medium px-3">Title</span>
                            <input type="text" placeholder="Title Article" value="{{ $article->title }}"
                                class="input input-bordered" name="title" />
                            @error('title')
                                <small class="text-red-600 ml-1">{{ $message }}</small>
                            @enderror
                        </label>
                        <label class="input-group input-group-vertical m-1 p-2 ">
                            <span class="bg-blue-200 p-1 text-md font-medium px-3">Description</span>
                            <textarea class="textarea textarea-bordered h-24" placeholder="Isi Description" name="description">{{ $article->description }}</textarea>
                            @error('description')
                                <small class="text-red-600 ml-1">{{ $message }}</small>
                            @enderror
                        </label>
                        <label class="input-group input-group-vertical m-1 p-2 ">
                            <span class="bg-blue-200 p-1 text-md font-medium px-3">Tag</span>
                            <input type="text" placeholder="Tag Article" class="input input-bordered" name="tag"
                                value="{{ $article->tag }}" />
                            @error('tag')
                                <small class="text-red-600 ml-1">{{ $message }}</small>
                            @enderror
                        </label>
                        <div class="px-3">
                            <button
                                class="btn btn-block btn-info font-bold font-serif hover:btn-accent hover:text-slate-900">Edit
                                Article</button>
                        </div>
                    </div>
                </div>
            </form>
        </x-mockup>
    </div>
</x-users-layout>
