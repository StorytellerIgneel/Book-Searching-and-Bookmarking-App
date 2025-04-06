@props(['href', 'isActive' => false])

<a 
    href="{{ $href }}"
    class="@if( $isActive )
        bg-blue-700 text-white border border-blue-700 shadow-sm cursor-default disabled
    @else
        bg-blue-500 hover:bg-blue-600 text-white hover:shadow-sm
    @endif
    font-medium px-4 py-2 text-sm rounded focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-1 transition-all duration-150 whitespace-nowrap"
>
    {{ $slot }}
</a>