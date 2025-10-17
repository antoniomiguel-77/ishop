@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between mt-4">
        {{-- Previous Page --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 text-sm text-gray-400 bg-gray-100 rounded cursor-not-allowed">
                &larr; Anterior
            </span>
        @else
            <a wire:click="previousPage" class="px-4 py-2 text-sm text-white bg-gray-600 rounded hover:bg-gray-700 cursor-pointer">
                &larr; Anterior
            </a>
        @endif

        {{-- Page Numbers --}}
        <div class="hidden md:flex items-center space-x-2 mx-4">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="text-gray-500">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-1 bg-gray-500 text-white rounded font-semibold">{{ $page }}</span>
                        @else
                            <button wire:click="gotoPage({{ $page }})" class="px-3 py-1 text-gray-700 bg-gray-100 rounded hover:bg-gray-200">
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page --}}
        @if ($paginator->hasMorePages())
            <a wire:click="nextPage" class="px-4 py-2 text-sm text-white bg-gray-600 rounded hover:bg-gray-700 cursor-pointer">
                Próximo &rarr;
            </a>
        @else
            <span class="px-4 py-2 text-sm text-gray-400 bg-gray-100 rounded cursor-not-allowed">
                Próximo &rarr;
            </span>
        @endif
    </nav>
@endif
