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
            $baseClass = 'w-9 h-9 text-white ease-in-out duration-150 rounded-xl p-2 text-sm flex items-center justify-center whitespace-nowrap font-semibold';
            $unselectedClass = 'bg-slate-400 hover:bg-slate-300';
            $disabledClass = 'bg-slate-200';
            $prevButtonEnabled = !$paginator->onFirstPage();
            $nextButtonEnabled = $paginator->hasMorePages();
            
            // Page item layout
            $sidePagesCount = intdiv($width, 2); // number of pages to each side the selected one
            $leftPagesCount = $current - $sidePagesCount; // number of pages to the left of the selected one
            $rightPagesCount = $sidePagesCount - min($sidePagesCount, $max - $current); // number of pages to the right of the selected one
            $start = max(1, $leftPagesCount - $rightPagesCount);
        @endphp

        {{-- Previous page button, invisible when at first page --}}
        @if ($prevButtonEnabled)
            <a title="{{ __('pagination.previous') }}" href="{{ $paginator->previousPageUrl() }}"
                class="{{ "$baseClass $unselectedClass" }}">&lt;</a>
        @else
            <button disabled title="{{ __('pagination.previous') }}"
                class="{{ "$baseClass $disabledClass" }}">&lt;</button>
        @endif

        {{-- Central page buttons --}}
        @for ($page = $start; $page <= min($max, $start + $width - 1); ++$page)
            @php
                $isSelected = $current == $page;
            @endphp
            <a title="{{ __('pagination.go_to', ['page' => $page]) }}" href="{{ $paginator->url($page) }}"
                @class([
                    $baseClass,
                    $unselectedClass => !$isSelected,
                    'bg-highlight hover:bg-highlight-light' => $isSelected,
                ])>
                {{ $page }}
            </a>
        @endfor

        {{-- Next page button, invisible when at last page --}}
        @if ($nextButtonEnabled)
            <a title="{{ __('pagination.next') }}" href="{{ $paginator->nextPageUrl() }}"
                class="{{ "$baseClass $unselectedClass" }}">&gt;</a>
        @else
            <button disabled title="{{ __('pagination.next') }}"
                class="{{ "$baseClass $disabledClass" }}">&gt;</button>
        @endif
    </nav>
    <p class="text-sm text-gray-700 leading-5">
        {!! __('pagination.showing') !!}
        @if ($paginator->firstItem())
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            {!! __('pagination.to') !!}
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
        @else
            {{ $paginator->count() }}
        @endif
        {!! __('pagination.of') !!}
        <span class="font-medium">{{ $paginator->total() }}</span>
        {!! __('pagination.results') !!}
    </p>
</div>
