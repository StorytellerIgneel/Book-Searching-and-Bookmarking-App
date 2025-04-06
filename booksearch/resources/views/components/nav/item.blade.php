@props(['href', 'isActive', 'icon'])

<li class="px-4 cursor-pointer {{ $isActive ? 'bg-gray-700 hover:bg-gray-600' : 'hover:bg-gray-700' }}">
    <a class="py-3 flex items-center" href="{{ $href }}">
        {{ $icon }}
        {{ $slot }}
    </a>
</li>