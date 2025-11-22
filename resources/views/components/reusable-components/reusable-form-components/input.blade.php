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
    'isDebounce' => false,
    'min' => null,
    'step' => null,
    'max' => null,
])

@php
    $defaultLabel = 'block mb-2 text-sm font-bold text-gray-900';
    $defaultInput =
        'bg-bg-color-primary border-1 border-border-color-primary text-text-color-primary text-sm rounded block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-border-color-primary';
    $defaultWrapper = 'relative z-0 w-full';
    if ($disabled) {
        $defaultInput =
            'bg-grey-100 border-1 border-border-color-primary text-text-color-primary-200 text-sm rounded block w-full p-2.5 focus:outline-none focus:ring-0 focus:border-border-color-primary';
    }

    $mods = $isDebounce ? ['live', 'debounce.500ms'] : ['live'];
    if ($type === 'number') {
        $mods[] = 'number';
    }

@endphp


<div class= "{{ $defaultWrapper }} {{ $wrapperClass }}"
    @if ($wireKey) wire:key="{{ $wireKey }}" @endif>
    @if ($label)
        <label for="{{ $for }}" class="{{ $defaultLabel }} {{ $labelClass }}">
            {{ $label }}
        </label>
    @endif
    <input @if ($required) required @endif
        @if ($model) wire:model.{{ implode('.', $mods) }}="{{ $model }}" @endif
        @if (!is_null($min)) min="{{ $min }}" @endif
        @if (!is_null($max)) max="{{ $max }}" @endif
        @if (!is_null($step)) step="{{ $step }}" @endif
        @if (!is_null($value)) value="{{ $value }}" @endif
        @if ($disabled) disabled @endif type="{{ $type }}" id="{{ $for }}"
        placeholder="{{ $placeholder ?? $label }}" class="{{ $defaultInput }} {{ $inputClass }}" />

    @error($model)
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
</div>
