@props([
    'text' => 'Create',
    'onClick' => null,
    'class' => 'bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded',
])

<div class="w-full p-2 flex flex-row justify-end mb-2">
    <button class="{{ $class }}" @if ($onClick) onclick="{{ $onClick }}" @endif>
        {{ $text }}
    </button>
</div>
