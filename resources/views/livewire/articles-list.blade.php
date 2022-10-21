<x-slot name="title">
    {{ $title }}
</x-slot>
<div>
    @if (session('token'))
        <x-user-navbar title="{{ $title }}" user="{{ $user->email }}" profile="{{ $user->profile }}" />
    @else
        <x-navbar title=" {{ $title }}" />
    @endif
    <div class="flex justify-center items-center flex-col flex-wrap gap-5 md:gap-4 mt-5 ">
        @foreach ($articles as $article)
            <x-article title="{{ $article->title }}" description="{{ $article->description }}"
                date="{{ $article->updated_at }}" tag="{{ $article->tag }}"
                route="{{ route('article.show', ['slug' => $article->slug]) }}" name="{{ $article->users->name }}"
                total-comments="{{ $article->comments->count() }}" profile="{{ $article->users->profile }}" />
        @endforeach
    </div>
    <div class="
        @if ($loadAmount >= $totalRecords) hidden  @else 'flex flex-col flex-wrap justify-center items-center text-xl text-center pt-3 mt-2' @endif"
        wire:loading.class=" animate-bounce ">
        Loading...
    </div>
    <div class="text-center py-5" id="last_records"></div>
    <script>
        const lastRecords = document.getElementById('last_records');
        const options = {
            root: null,
            threshold: 1,
            rootMargin: '0px'
        }
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    @this.loadMore()
                }
            })
        })
        observer.observe(lastRecords);
    </script>
</div>
