{{-- Page button list --}}

@php
if (!isset($width)) {
    $width = 5;
}
if (!isset($class)) {
    $class = '';
}
@endphp

<div class="{{ "w-2/3 mx-auto flex flex-col items-center justify-center pt-2 $class gap-2" }}">
    <nav class="flex flex-row gap-2 items-center">
        @php
            $current = $paginator->currentPage();
            $max = $paginator->lastPage();
            
            // Styling
            $baseClasses = 'w-9 h-9 text-white ease-in-out duration-150 rounded-xl p-2 text-sm flex items-center justify-center whitespace-nowrap font-semibold';
            $unselectedClasses = 'bg-slate-400 hover:bg-slate-300';
            $prevButtonEnabled = !$paginator->onFirstPage();
            $backButtonEnabled = $paginator->hasMorePages();
            
            // Page item layout
            $sidePagesCount = intdiv($width, 2); // number of pages to each side the selected one
            $leftPagesCount = $current - $sidePagesCount; // number of pages to the left of the selected one
            $rightPagesCount = $sidePagesCount - min($sidePagesCount, $max - $current); // number of pages to the right of the selected one
            $start = max(1, $leftPagesCount - $rightPagesCount);
        @endphp

        {{-- Previous page button, invisible when at first page --}}
        <a title="{{ __('pagination.previous') }}" href="{{ $paginator->previousPageUrl() }}"
            @class([
                $baseClasses,
                $unselectedClasses => $prevButtonEnabled,
                'invisible' => !$prevButtonEnabled,
            ])>&lt;</a>

        {{-- Central page buttons --}}
        @for ($page = $start; $page <= min($max, $start + $width - 1); ++$page)
            @php
                $isSelected = $current == $page;
            @endphp
            <a title={{ __('pagination.go_to', ['page' => $page]) }} href="{{ $paginator->url($page) }}"
                @class([
                    $baseClasses,
                    $unselectedClasses => !$isSelected,
                    'bg-highlight hover:bg-highlight-light' => $isSelected,
                ])>
                {{ $page }}
            </a>
        @endfor

        {{-- Next page button, invisible when at last page --}}
        <a title="{{ __('pagination.next') }}" href="{{ $paginator->nextPageUrl() }}"
            @class([
                $baseClasses,
                $unselectedClasses => $backButtonEnabled,
                'invisible' => !$backButtonEnabled,
            ])>&gt;</a>
    </nav>
    <p class="text-sm text-gray-700 leading-5">
        {!! __('Showing') !!}
        @if ($paginator->firstItem())
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            {!! __('to') !!}
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
        @else
            {{ $paginator->count() }}
        @endif
        {!! __('of') !!}
        <span class="font-medium">{{ $paginator->total() }}</span>
        {!! __('results') !!}
    </p>
</div>
