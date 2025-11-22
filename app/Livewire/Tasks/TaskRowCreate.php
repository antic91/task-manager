<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

class TaskRowCreate extends Component
{


    /**
     * @var array
     */
    public array $task = [
        'title' => '',
        'description' => '',
        'status' => null,
        'deadline_at' => null,
    ];

    public Collection $users;

    public function mount()
    {
        //select name and id from users table
        $this->users = User::all(['id', 'name']);
    }

    protected function rules(): array
    {
        return [
            'task.title' => 'required|string|max:255',
            'task.description' => 'required|string|min:10',
            'task.status' => 'required|in:todo,doing,done',
            'task.deadline_at' => 'nullable|date',
            'task.user_id' => 'required|exists:users,id',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function render()
    {
        return view('components.tasks.task-row-create');
    }

    public function store()
    {
        $this->validate($this->rules());

        try {
            Task::create($this->task);
        } catch (\Exception $e) {
            // Do something here 
        } finally {
            $this->redirect('/tasks');
        }
    }
}
