<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class UserRowDelete extends Component
{
    /**
     * @var string
     */
    public string $userId;

    public function mount(string $userId)
    {
        $this->userId = $userId;
    }


    public function render()
    {
        return view('components.users.user-row-delete');
    }

    public function delete()
    {
        try {
            User::where('id', $this->userId)->delete();
        } catch (\Exception $e) {
            // Do something here 
        } finally {
            $this->redirect('/');
        }
    }
}
