<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class UserRowEdit extends Component
{
    /**
     * @var array
     */
    public array $user;

    public function mount(string $userId)
    {
        $this->user = User::findOrFail($userId)->toArray();
    }

    protected function rules(): array
    {
        return [
            'user.name' => 'required|string|max:255',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function render()
    {
        return view('components.users.user-row-edit');
    }

    public function store()
    {
        $this->validate($this->rules());

        try {
            User::where('id', $this->user['id'])->update([
                'name' => $this->user['name'],
            ]);
        } catch (\Exception $e) {
            // Do something here 
        } finally {
            $this->redirect('/');
        }
    }
}
