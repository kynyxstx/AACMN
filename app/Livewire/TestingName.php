<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TestingName extends Component
{
    use WithPagination;

    public $name = '';
    public $email = '';
    public $password = '';
    public $isEditModalOpen = false;
    public $isDeleteModalOpen = false;
    public $editUserId = null; // User ID for editing
    public $deleteUserId = null; // User ID for deletion

    protected $rules = [
        'name' => 'required|min:2',
        'email' => 'required|email|unique:users,email',
        'password' => 'nullable|min:8', // Password is required only for registration
    ];

    public function register()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $this->reset(['name', 'email', 'password']);
        session()->flash('message', 'User Registration Successful');
    }

    public function openEditModal($id)
    {
        $user = User::findOrFail($id);

        $this->editUserId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = ''; // Don't show the current password
        $this->isEditModalOpen = true;
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email,' . $this->editUserId, // Ignore the current user's email
            'password' => 'nullable|min:8', // Password is optional for edit
        ]);

        $user = User::findOrFail($this->editUserId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? bcrypt($this->password) : $user->password, // Only update password if provided
        ]);

        $this->reset(['name', 'email', 'password', 'editUserId']);
        $this->isEditModalOpen = false;
        session()->flash('message', 'User updated successfully!');
    }


    public function openDeleteModal($id)
    {
        $this->deleteUserId = $id;
        $this->isDeleteModalOpen = true;
    }

    public function deleteUser()
    {
        $user = User::findOrFail($this->deleteUserId);
        $user->delete();

        $this->reset(['deleteUserId']);
        $this->isDeleteModalOpen = false;
        session()->flash('message', 'User deleted successfully!');
    }

    public function closeModal()
    {
        $this->reset(['isEditModalOpen', 'isDeleteModalOpen', 'name', 'email', 'password', 'editUserId', 'deleteUserId']);
    }

    public function render()
    {
        return view('livewire.testing-name', [
            'users' => User::paginate(3),
        ]);
    }
}
