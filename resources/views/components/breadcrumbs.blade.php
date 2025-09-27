{{-- resources/views/components/breadcrumbs.blade.php --}}

<div class="px-16 pb-3 max-w-7xl mx-auto" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-2 text-sm">
        @foreach ($breadcrumbs as $index => $breadcrumb)
            <li class="flex items-center">
                @if ($index > 0)
                    <svg class="w-4 h-4 text-gray-600 mx-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                @endif

                @if ($breadcrumb['active'])
                    <span class="text-red-600 font-medium">{{ $breadcrumb['name'] }}</span>
                @else
                    <a href="{{ $breadcrumb['url'] }}"
                        class="text-gray-800 hover:text-red-600 transition-colors duration-200">
                        {{ $breadcrumb['name'] }}
                    </a>
                @endif
            </li>
        @endforeach
    </ol>
</div>
