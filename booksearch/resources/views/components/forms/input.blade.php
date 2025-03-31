@props([
    'name',
    'label' => 'No Label',
    'required' => true,
])    

@php
    $defaults = [
        'type' => 'text',
        'id' => $name,
        'name' => $name,
        'class' => 'block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 border',
        'value' => old($name),
    ]
@endphp

<label for={{ $name }} class="block text-sm font-medium text-gray-700">{{ $label }}</label>
<div class="mt-1">
    <input {{ $attributes($defaults) }} {{ $required ? 'required' : '' }}>
    <x-forms.error :$name />
</div>
