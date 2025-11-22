<!-- Modal overlay -->
<div id="{{ $id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <!-- Modal container -->
    <div class="relative bg-white rounded-lg shadow-lg w-full max-w-lg mx-4 overflow-y-auto p-4"
        style="max-height: 90vh;">
        <!-- Modal header -->
        <div class="flex justify-center items-center p-4 pt-0 border-b border-gray-700">
            <h5 class="text-lg font-semibold text-gray-900 text-center w-full">
                {!! $title !!}
            </h5>
        </div>
        <button type="button" onclick="window.location.href='{{ $closeRoute }}'"
            class="absolute top-0 right-0 text-gray-600 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-4 inline-flex items-center">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
        <!-- Modal body -->
        <div class="p-5">
            @if ($note)
                <p class="mb-4 text-sm text-gray-500 w-full">
                    {{ $note ?? '' }}
                </p>
            @endif
            {{ $slot }}
        </div>
    </div>
</div>
