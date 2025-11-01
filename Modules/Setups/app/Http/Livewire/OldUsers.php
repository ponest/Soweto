<?php

namespace Modules\Setups\Http\Livewire;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Modules\Auth\Models\User;


class OldUsers extends Component
{
    public $users;
    public $first_name;
    public $last_name;
    public $email;
    public $phone_number;


    public function mount(): void
    {
        // Fetch users from the database
        $this->users = User::latest('id')->get(); // You can add conditions or pagination here if needed
    }

    public function render()
    {
        return view('setups::livewire.users_old', [
            'items' => $this->users
        ])->layout('layouts.livewire_master');
    }

    public function store(): void
    {
        $this->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|max:20',
        ]);

        User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'password' => Hash::make('12345'),
        ]);

        $this->reset(['first_name', 'last_name', 'email', 'phone_number']);
        $this->users = User::latest('id')->get(); // Refresh the table
        // Emit event to trigger Toastr
        $this->dispatch('show-toast', [
            'type' => 'success',             // info, success, warning, error
            'message' => 'User created successfully!',
            'title' => 'Success',           // Optional
            'modalId' => 'create_modal'        // Optional: ID of modal to close
        ]);
    }
}
