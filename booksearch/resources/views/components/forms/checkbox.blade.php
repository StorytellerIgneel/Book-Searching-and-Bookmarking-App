@props([
    'name',
    'label',
    'checked' => false,
    'id' => null,
    'inputClass' => 'h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500',
    'labelClass' => 'ml-2 block text-sm text-gray-700'
])

<div class='flex items-center mt-1'>
    <input
        type="checkbox"
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        @checked($checked)
        {{ $attributes->merge(['class' => $inputClass]) }}
    >
    <label for="{{ $id ?? $name }}" class="{{ $labelClass }}">
        {{ $label }}
    </label>
</div>