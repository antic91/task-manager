<form wire:submit="store" class="relative overflow-y-auto flex flex-wrap flex-row justify-start h-full gap-8"
    style="align-content: flex-start;">

    <x-reusable-components.reusable-form-components.select :options="$users->map(fn($user) => ['value' => $user->id, 'label' => $user->name])->toArray()" model="task.user_id" id="user_id"
        emptyLabel="No Users to choose from" placeholder="Assign User" label="Assign User" key="label" value_key="value"
        :optionsTranslated="false" />

    <x-reusable-components.reusable-form-components.input for="task-create-title-input" label="Title"
        model="task.title" :required="false" wrapperClass="relative z-0 w-full pl-0" labelClass="" inputClass="" />

    <x-reusable-components.reusable-form-components.textarea for="description" label="Task description"
        model="task.description" :required="false" wrapperClass="" labelClass="" inputClass="" />

    <x-reusable-components.reusable-form-components.select :options="[
        ['value' => 'todo', 'label' => 'Todo'],
        ['value' => 'doing', 'label' => 'Doing'],
        ['value' => 'done', 'label' => 'Completed'],
    ]" model="task.status" id="status"
        emptyLabel="No Task Status to choose from" placeholder="Task Status" label="Task Status" key="label"
        value_key="value" :optionsTranslated="true" />

    <div class="w-full">
        <label for="deadline_at" class="block mb-2 text-sm font-bold text-gray-900">
            Deadline
        </label>

        <input type="date" id="deadline_at" wire:model="task.deadline_at"
            class="block w-full p-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body" />
        @error('task.deadline_at')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" @if ($errors->any()) disabled @endif
        class="btn w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
        Save
    </button>
</form>
