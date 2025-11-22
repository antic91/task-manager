{{-- resources/views/components/form/select-field.blade.php --}}
@props([
    'options' => [],
    'model' => null,
    'changeMethod' => null,
    'id',
    'emptyLabel' => null,
    'key' => '',
    'value_key' => '',
    'required' => false,
    'wrapperClass' => '',
    'selectClass' => '',
    'ignoreEmptyOptions' => false,
    'disabled' => false,
    'placeholder' => null,
    'placeholderValue' => '',
    'label' => null,
    'labelClass' => '',
    'wireKey' => null,
    'isOptionsArray' => true,
    'noSelectLabel' => null,
])

@php
    $defaultLabelClass = 'block text-sm font-medium text-pg-primary-700 dark:text-pg-primary-300';
    $defaultWrapper = 'relative flex flex-wrap flex-row justify-start items-start w-full gap-2';
    $wireKey = '';

    $normalizedOptions = collect($options)
        ->map(function ($opt) use ($isOptionsArray, $key, $value_key, &$wireKey) {
            if (!$value_key && !$key) {
                $value = is_array($opt) ? (string) ($opt[0] ?? '') : (string) $opt;
                $label = is_array($opt) ? (string) ($opt[0] ?? '') : (string) $opt;
            } else {
                if ($isOptionsArray) {
                    $value = (string) data_get($opt, $value_key);
                    $label = (string) data_get($opt, $key);
                } else {
                    $value = (string) data_get($opt, $value_key);
                    $label = (string) data_get($opt, $key);
                }
            }
            $wireKey .= $value . ',';
            return ['value' => $value, 'label' => $label];
        })
        ->values();
    $wireKey = crc32($wireKey);
@endphp

<div class="{{ $defaultWrapper }} {{ $wrapperClass }}" x-data="{
    open: false,
    search: '',
    options: @js($normalizedOptions),
    selected: $wire.entangle(@js($model)).live,
    disabled: @js($disabled),
    norm(s) { return (s || '').toLowerCase().normalize('NFD').replace(/\p{Diacritic}/gu, ''); },
    get filteredOptions() {
        const q = this.norm(this.search).trim();
        if (!q) return this.options;
        return this.options.filter(o => this.norm(o.label).includes(q));
    },
    currentLabel() {
        const v = String(this.selected ?? '');
        if (!v) return '';
        const found = this.options.find(o => String(o.value) === v);
        return found ? found.label : '';
    },
    choose(val) {
        this.selected = String(val);
        this.$nextTick(() => {
            if (this.$refs.native) {
                this.$refs.native.value = String(val);
                this.$refs.native.dispatchEvent(new Event('change', { bubbles: true }));
            }
        });
        this.open = false;
        this.search = '';
    },
    toggle() {
        if (this.disabled) return;
        this.open = !this.open;
        if (this.open) this.$nextTick(() => this.$refs.search?.focus());
    },
    clearIfPlaceholder() {
        const pv = @js($placeholderValue);
        if (pv && String(this.selected ?? '') === String(pv)) return '';
        return this.currentLabel();
    }
}" wire:key="{{ $wireKey }}"
    x-on:keydown.escape.prevent="open=false">
    @if ($label)
        <label for="{{ $id }}" class="{{ $defaultLabelClass }} {{ $labelClass }}">{{ $label }}</label>
    @endif

    @if (empty($options) && !$ignoreEmptyOptions)
        @if ($noSelectLabel)
            <label for="{{ $id }}"
                class="{{ $defaultLabelClass }} {{ $labelClass }}">{{ $noSelectLabel }}</label>
        @endif
        <p
            class="bg-bg-color-primary border border-border-color-primary text-text-color-primary text-sm rounded block w-full p-2.5">
            {{ $emptyLabel }}
        </p>
    @else
        <div class="relative w-full">
            <input type="text" readonly @click="toggle()" :value="clearIfPlaceholder()"
                placeholder="{{ $placeholder ?? '' }}"
                class="px-3 py-2 pr-9 bg-bg-color-primary border border-border-color-primary text-text-color-primary text-sm rounded-lg w-full focus:outline-none {{ $selectClass }}"
                aria-label="{{ $emptyLabel }}" />

            <svg class="pointer-events-none absolute right-2 top-1/2 -translate-y-1/2 w-6 h-6 text-gray-400"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>

        {{-- Dropdown --}}
        <div x-show="open" x-transition @click.outside="open = false" x-trap.noscroll="open"
            class="absolute w-full bg-white mt-1 border border-gray-300 rounded-md"
            style="max-height: 400px; overflow-y: hidden; z-index: 1000; @if ($label) top:65px; @else top:40px; @endif">
            <div class="p-2 pb-0" style="display:flex; flex-flow:row wrap;">
                <input type="text" x-ref="search" x-model.debounce.200ms="search" placeholder="Search..."
                    class="w-full text-sm ring-1 ring-gray-300 rounded-md px-2 py-1 focus:outline-none" />
            </div>

            <template x-if="filteredOptions.length > 0">
                <ul class="py-2" style="max-height: 350px; overflow-y: auto; padding-bottom: 0.5rem;">
                    <template x-for="opt in filteredOptions" :key="opt.value">
                        <li class="px-3 py-2 hover:bg-gray-100 cursor-pointer"
                            :class="{ 'font-semibold': String(selected ?? '') === String(opt.value) }"
                            @click="choose(opt.value)">
                            <span class="text-sm text-gray-700" x-text="opt.label"></span>
                        </li>
                    </template>
                </ul>
            </template>

            <template x-if="filteredOptions.length === 0">
                <div class="px-3 py-2 text-sm text-gray-600 w-full text-center">
                    {{ 'records/records-data.no_data' }}
                </div>
            </template>
        </div>

        {{-- Hidden native <select> --}}
        <select x-ref="native" @if ($disabled) disabled @endif
            @if ($required) required @endif
            @if ($model) wire:model.live="{{ $model }}" @endif
            @if ($wireKey) wire:key="{{ $wireKey }}" @endif
            @if ($changeMethod) wire:change="{{ $changeMethod }}" @endif id="{{ $id }}"
            class="sr-only" tabindex="-1" aria-hidden="true">
            @if (!$ignoreEmptyOptions)
                <option @if ($placeholderValue) value="{{ $placeholderValue }}" @else value="" @endif
                    @selected(old($model) === ($placeholderValue ?: ''))>
                    {{ $placeholder ?? '' }}
                </option>
            @endif

            @foreach ($options as $option)
                @if (!$value_key && !$key)
                    @php
                        $val = is_array($option) ? $option[0] ?? '' : $option;
                        $lab = is_array($option) ? $option[0] ?? '' : $option;
                    @endphp
                    <option value="{{ $val }}">{{ $lab }}</option>
                @else
                    @php
                        if ($isOptionsArray) {
                            $val = data_get($option, $value_key);
                            $lab = data_get($option, $key);
                        } else {
                            $val = data_get($option, $value_key);
                            $lab = data_get($option, $key);
                        }
                    @endphp
                    <option value="{{ $val }}">{{ $lab }}</option>
                @endif
            @endforeach
        </select>
    @endif

    @error($model)
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
</div>
