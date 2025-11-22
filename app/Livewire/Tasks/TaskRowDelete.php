<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;

class TaskRowDelete extends Component
{
    /**
     * @var string
     */
    public string $taskId;

    public function mount(string $taskId)
    {
        $this->taskId = $taskId;
    }


    public function render()
    {
        return view('components.tasks.task-row-delete');
    }

    public function delete()
    {
        try {
            Task::where('id', $this->taskId)->delete();
        } catch (\Exception $e) {
            // Do something here 
        } finally {
            $this->redirect('/tasks');
        }
    }
}
