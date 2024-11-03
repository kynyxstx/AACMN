<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TestingName extends Component

{
    use WithPagination;
    public  $name='';
    public  $email='';
    public  $password='';

    public function register(){
        sleep(1);
        $this->validate([
            'name'=>'required|min:2',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8'
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        $this->reset(['name', 'email', 'password']);
        session()->flash('message', 'User Registration Successful');
    }

    public function render()
    {
        return view('livewire.testing-name',
        [
            'users'=> User::paginate(3),
        ]);
    }
}