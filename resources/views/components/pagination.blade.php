<a @if ($prevPage) href="{{ $prevPage }}" @endif
    class="px-4 py-2 mx-1 capitalize text-slate-900 bg-white rounded-md 
    <?= $prevPage ? 'hover:bg-blue-500 hover:text-white ' : 'cursor-not-allowed  text-gray-500' ?>  ">
    <div class="flex items-center -mx-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-1" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
        </svg>

        <span class="mx-1">
            previous
        </span>
    </div>
</a>

{{ $slot }}


<a @if ($nextPage) href="{{ $nextPage }}" @endif
    class="px-4 py-2 mx-1 text-slate-900 transition-colors duration-200 
    transform bg-white rounded-md  
     <?= $nextPage ? 'hover:bg-blue-500  hover:text-white' : 'cursor-not-allowed text-gray-500' ?> ">

    <div class="flex items-center -mx-1">
        <span class="mx-1">
            Next
        </span>

        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-1" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
        </svg>
    </div>
</a>
