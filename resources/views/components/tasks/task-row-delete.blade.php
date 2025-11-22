<form wire:submit="delete" class="relative overflow-y-auto flex flex-wrap flex-row justify-start h-full gap-8"
    style="align-content: flex-start;">


    <h3 class="w-full font-bold text-center">
        Do you really want to delete this task?
    </h3>

    <div class="flex justify-end mt-6 relative bottom-0 right-0 w-full bg-white dark:bg-gray-800">
        <button @if ($errors->any()) disabled @endif type="submit"
            class="btn px-3 py-2 text-sm w-full text-white transition-colors duration-200 transform rounded-md focus:outline-none focus:ring focus:ring-opacity-50 bg-pg-color-primary">
            Delete
        </button>
    </div>
</form>
