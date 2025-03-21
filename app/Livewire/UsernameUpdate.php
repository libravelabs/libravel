<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class UsernameUpdate extends Component
{
    public $username;

    protected function rules()
    {
        return [
            'username' => [
                'required',
                'string',
                'max:32',
                'regex:/^[a-zA-Z0-9_-]+$/',
                'unique:users,username,' . Auth::id(),
            ],
        ];
    }

    public function mount()
    {
        $this->username = Auth::user()->username;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();
        /** @var User $user */
        $user = Auth::user();

        $existingUser = \App\Models\User::where('username', $this->username)
            ->where('id', '!=', $user->id)
            ->first();

        if ($existingUser) {
            Toaster::error(__('profile.username_exists'));
            return;
        }

        $user->update([
            'username' => $this->username
        ]);

        Toaster::success(__('profile.saved_successfully'));
    }

    public function render()
    {
        return view('livewire.username-update');
    }
}
