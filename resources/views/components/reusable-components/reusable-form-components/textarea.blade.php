@props([
    'label' => null,
    'for',
    'model' => null,
    'type' => 'text',
    'required' => false,
    'placeholder' => null,
    'labelClass' => '',
    'inputClass' => '',
    'wrapperClass' => '',
    'disabled' => false,
    'wireKey' => null,
    'value' => null,
    'rows' => 2,
    'title' => null,
])

@php
    $defaultLabel = 'block mb-2 text-sm font-bold text-gray-900';
    $defaultInput =
        'bg-bg-color-primary border-1 border-border-color-primary text-text-color-primary text-sm rounded block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-border-color-primary';
    $defaultWrapper = 'relative w-full';
@endphp

<div class= "{{ $defaultWrapper }} {{ $wrapperClass }}"
    @if ($wireKey) wire:key="{{ $wireKey }}" @endif>
    @if ($label)
        <label for="{{ $for }}" class="{{ $defaultLabel }} {{ $labelClass }}">
            {{ $label }}
        </label>
    @endif
    <textarea rows="{{ $rows }}" @if ($required) required @endif
        wire:model.live="{{ $model }}" @if ($value) value="{{ $value }}" @endif
        @if ($disabled) disabled @endif type="{{ $type }}" id="{{ $for }}"
        placeholder="{{ $placeholder ?? $label }}" class="{{ $defaultInput }} {{ $inputClass }}"
        @if ($title) title="{{ $title }}" @endif>
        </textarea>

    @error($model)
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
</div>
