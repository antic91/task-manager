<x-app-layout>
    <x-reusable-components.table-top-actions text="Create Task" onClick="window.location='{{ route('tasks.create') }}'" />

    <livewire:tasks.tasks-table />

    @if (Route::currentRouteName() == 'tasks.create')
        <x-overlays.xModal id="task-create" title="Create New Task" note="Here you can create a new task."
            closeRoute="/tasks" drawerKey="create-tasks">
            @livewire('tasks.task-row-create')
        </x-overlays.xModal>
    @elseif (Route::currentRouteName() == 'tasks.edit')
        <x-overlays.xModal id="task-edit" title="Edit Task" note="Here you can edit a task." closeRoute="/tasks"
            drawerKey="edit-tasks">
            @livewire('tasks.task-row-edit', ['taskId' => $taskId])
        </x-overlays.xModal>
    @elseif (Route::currentRouteName() == 'tasks.delete')
        <x-overlays.xModal id="task-delete" title="Delete Task" note="Here you can delete a task." closeRoute="/tasks"
            drawerKey="delete-tasks">
            @livewire('tasks.task-row-delete', ['taskId' => $taskId])
        </x-overlays.xModal>
    @endif

</x-app-layout>
