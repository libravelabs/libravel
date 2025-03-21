<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Bio extends Component
{
    public $bio;

    protected $rules = [
        'bio' => 'nullable|max:500'
    ];

    public function mount()
    {
        /** @var User $user */

        $user = Auth::user();
        $this->bio = $user->bio;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        /** @var User $user */

        $user = Auth::user();
        $this->validate();

        $user->update([
            'bio' => $this->bio
        ]);

        Toaster::success(__('profile.bio.success'));
        return redirect()->route('profile.index', $user->username);
    }

    public function render()
    {
        return view('livewire.bio');
    }
}
