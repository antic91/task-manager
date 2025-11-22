<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class UserRowCreate extends Component
{


    /**
     * @var array
     */
    public array $user = [
        'name' => '',
        'email' => '',
    ];


    protected function rules(): array
    {
        return [
            'user.name' => 'required|string|max:255',
            'user.email' => 'required|email|max:255|unique:users,email',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function render()
    {
        return view('components.users.user-row-create');
    }

    public function store()
    {
        $this->validate($this->rules());

        try {
            User::create([
                'name' => $this->user['name'],
                'email' => $this->user['email'],
                'password' => bcrypt('defaultpassword'), //For example purposes, set a default password
            ]);

            $this->reset('user');
            //notify user of success and send him email with password reset link
        } catch (\Exception $e) {
            // Do something here 
        } finally {
            $this->redirect('/');
        }
    }
}
