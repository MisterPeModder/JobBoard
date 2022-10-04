{{-- Page button list --}}

<nav class="w-2/3 mx-auto flex flex-row items-center justify-center gap-2 pt-2">
    @php
        // Styling
        $baseClasses = 'w-9 h-9 text-white ease-in-out duration-150 rounded-xl p-2 text-sm flex items-center justify-center whitespace-nowrap font-semibold';
        $unselectedClasses = 'bg-slate-400 hover:bg-slate-300';
        $prevButtonEnabled = $current > 1;
        $backButtonEnabled = $current < $max;
        
        // Page item layout
        $sidePagesCount = intdiv($width, 2); // number of pages to each side the selected one
        $leftPagesCount = $current - $sidePagesCount; // number of pages to the left of the selected one
        $rightPagesCount = $sidePagesCount - min($sidePagesCount, $max - $current); // number of pages to the right of the selected one
        $start = max(1, $leftPagesCount - $rightPagesCount);
    @endphp

    {{-- Previous page button, invisible when at first page --}}
    <a title="Previous page"
        {{ $attributes->merge(['href' => '?page=' . max(0, $current - 1)])->class([$baseClasses, $unselectedClasses => $prevButtonEnabled, 'invisible' => !$prevButtonEnabled]) }}>&lt;</a>

    {{-- Central page buttons --}}
    @for ($page = $start; $page <= min($max, $start + $width - 1); ++$page)
        @php
            $isSelected = $current == $page;
        @endphp
        <a
            {{ $attributes->merge(['href' => "?page=$page", 'title' => "Go to page $page"])->class([$baseClasses, $unselectedClasses => !$isSelected, 'bg-highlight hover:bg-highlight-light' => $isSelected]) }}>
            {{ $page }}
        </a>
    @endfor

    {{-- Previous page button, invisible when at last page --}}
    <a title="Next page"
        {{ $attributes->merge(['href' => '?page=' . min($max, $current + 1)])->class([$baseClasses, $unselectedClasses => $backButtonEnabled, 'invisible' => !$backButtonEnabled]) }}>&gt;</a>
</nav>
