<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid as FacadesPowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class UsersTable extends PowerGridComponent
{
    public string $tableName = 'users_table';
    public bool $showFilters = false;

    public function datasource(): Builder
    {
        return User::query();
    }


    public function fields(): PowerGridFields
    {
        return FacadesPowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('email');
    }



    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->hidden()
                ->sortable()
                ->searchable(),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),
            Column::action("Actions"),
        ];
    }

    public function actionsFromView($row): \Illuminate\Contracts\View\View
    {
        return view('components.actions.users-actions', [
            'user' => $row,
        ]);
    }
}
