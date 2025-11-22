<form wire:submit="store" class="relative overflow-y-auto flex flex-wrap flex-row justify-start h-full gap-8"
    style="align-content: flex-start;">

    <x-reusable-components.reusable-form-components.input for="user-create-name-input" label="Name" model="user.name"
        :required="false" wrapperClass="relative z-0 w-full pl-0" labelClass="" inputClass="" />


    <x-reusable-components.reusable-form-components.input for="user-create-email-input" label="Email" model="user.email"
        :required="false" wrapperClass="relative z-0 w-full pl-0" labelClass="" inputClass="" />


    <button type="submit" @if ($errors->any()) disabled @endif
        class="btn w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
        Save
    </button>
</form>
