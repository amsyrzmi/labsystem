@props(['paginator'])

@if ($paginator->hasPages())
<nav aria-label="Pagination">
  <ul class="inline-flex items-center space-x-2">
    {{-- Prev --}}
    @if ($paginator->onFirstPage())
      <li><span class="px-3 py-1 rounded opacity-50">Prev</span></li>
    @else
      <li><a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 rounded hover:bg-gray-100">Prev</a></li>
    @endif

    {{-- Page numbers (small subset) --}}
    @foreach ($elements as $element)
      @if (is_array($element))
        @foreach ($element as $page => $url)
          <li>
            @if ($page == $paginator->currentPage())
              <span class="px-3 py-1 rounded bg-[#1947AE] text-white">{{ $page }}</span>
            @else
              <a href="{{ $url }}" class="px-3 py-1 rounded hover:bg-gray-100">{{ $page }}</a>
            @endif
          </li>
        @endforeach
      @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
      <li><a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 rounded hover:bg-gray-100">Next</a></li>
    @else
      <li><span class="px-3 py-1 rounded opacity-50">Next</span></li>
    @endif
  </ul>
</nav>
@endif
