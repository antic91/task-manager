<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\{PowerGrid, PowerGridFields, Column, PowerGridComponent};
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid as FacadesPowerGrid;

final class TasksTable extends PowerGridComponent
{
    public string $tableName = 'tasks_table';
    public bool $showFilters = false;

    public function datasource(): Builder
    {
        return Task::query()->with('user');
    }

    public function fields(): PowerGridFields
    {
        return FacadesPowerGrid::fields()
            ->add('id')
            ->add('title')
            ->add('description')
            ->add('status')
            ->add('deadline_at')
            ->add('user_name', fn($task) => $task->user?->name);
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')->hidden()->sortable()->searchable(),
            Column::make('Title', 'title')->sortable()->searchable(),
            Column::make('Description', 'description'),
            Column::make('Status', 'status')->sortable(),
            Column::make('Deadline', 'deadline_at')->sortable(),
            Column::make('User', 'user_name'),
            Column::action('Actions'),
        ];
    }

    public function actionsFromView($row): \Illuminate\Contracts\View\View
    {
        return view('components.actions.tasks-actions', [
            'task' => $row,
        ]);
    }
}
