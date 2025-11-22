<div class="flex gap-2">
    {{-- Edit --}}
    <a href="{{ route('tasks.edit', $task->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>

    <a href="{{ route('tasks.delete', $task->id) }}" class="px-2 py-1 bg-red-600 text-white rounded">Delete</a>

</div>
