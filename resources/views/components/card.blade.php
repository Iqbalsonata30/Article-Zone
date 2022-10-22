<div {{ $attributes->class(['card w-96', 'bg-base-100', ' shadow-xl']) }}>
    <div class="card-body">
        <div class="card-actions justify-end">
            @if ($tag != null)
                <div class="badge badge-inline">{{ $tag }}</div>
            @endif
        </div>
        <h2 class="card-title">{{ $title }}</h2>
        <p>{{ $description }}</p>
        {{ $slot }}
    </div>
</div>
