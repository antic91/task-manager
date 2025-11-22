<x-app-layout>

    <x-reusable-components.table-top-actions text="Create User" onClick="window.location='{{ route('users.create') }}'" />

    <livewire:users.users-table />


    @if (Route::currentRouteName() == 'users.create')
        <x-overlays.xModal id="user-create" title="Create New User" note="Here you can create a new user." closeRoute="/"
            drawerKey="create-users">
            @livewire('users.user-row-create')
        </x-overlays.xModal>
    @elseif (Route::currentRouteName() == 'users.edit')
        <x-overlays.xModal id="user-edit" title="Edit User" note="Here you can edit a user." closeRoute="/"
            drawerKey="edit-users">
            @livewire('users.user-row-edit', ['userId' => $userId])
        </x-overlays.xModal>
    @elseif (Route::currentRouteName() == 'users.delete')
        <x-overlays.xModal id="user-delete" title="Delete User" note="Here you can delete a user." closeRoute="/"
            drawerKey="delete-users">
            @livewire('users.user-row-delete', ['userId' => $userId])
        </x-overlays.xModal>
    @endif

</x-app-layout>
