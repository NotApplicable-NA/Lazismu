@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center space-x-2 mt-4">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 text-gray-500 bg-gray-100 rounded-lg cursor-not-allowed no-underline">Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 text-gray-500 bg-white rounded-lg hover:bg-gray-100 no-underline">
                Previous
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-4 py-2 text-gray-500 bg-gray-100 rounded-lg no-underline">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-4 py-2 text-white bg-blue-500 rounded-lg no-underline">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-4 py-2 text-gray-500 bg-white rounded-lg hover:bg-gray-100 no-underline">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 text-gray-500 bg-white rounded-lg hover:bg-gray-100 no-underline">
                Next
            </a>
        @else
            <span class="px-4 py-2 text-gray-500 bg-gray-100 rounded-lg cursor-not-allowed no-underline">Next</span>
        @endif
    </nav>
@endif
