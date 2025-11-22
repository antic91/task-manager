<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;

class TaskRowEdit extends Component
{
    /**
     * @var array
     */
    public array $task;

    public Collection $users;

    public function mount(string $taskId)
    {
        $task = Task::findOrFail($taskId);

        $this->task = $task->toArray();
        $this->task['deadline_at'] = $task->deadline_at
            ? Carbon::parse($task->deadline_at)->format('Y-m-d')
            : null;
        $this->users = User::all();
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
        return view('components.tasks.task-row-edit');
    }

    public function store()
    {
        $this->validate($this->rules());

        try {
            Task::where('id', $this->task['id'])->update([
                'title' => $this->task['title'],
                'description' => $this->task['description'],
                'status' => $this->task['status'],
                'deadline_at' => $this->task['deadline_at']
                    ? \Carbon\Carbon::parse($this->task['deadline_at'])
                    : null,
                'user_id' => $this->task['user_id'],
            ]);
        } catch (\Exception $e) {
            // Do something here 
        } finally {
            $this->redirect('/tasks');
        }
    }
}
