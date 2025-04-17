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
        'class' => 'block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 border' . 
            ($errors->has($name) ? ' border-red-500' : ''),
        'value' => old($name),
    ]
@endphp

<label for={{ $name }} class="block text-sm font-medium text-gray-700">{{ $label }}</label>
<div class="mt-1">
    <input {{ $attributes($defaults) }} {{ $required ? 'required' : '' }} 
        oninput="clearInputError(this)"
    >
    <x-forms.error :$name />
</div>

<script>
    function clearInputError(input) {
        input.classList.remove('border-red-500');

        const error = input.parentElement.querySelector('p.text-red-600');
        if (error) {
            error.style.display = 'none';
        }
    }
</script>

