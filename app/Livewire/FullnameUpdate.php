<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class FullnameUpdate extends Component
{
    public $fullname;

    protected $rules = [
        'fullname' => 'string|max:48'
    ];

    public function mount()
    {
        /** @var User $user */

        $user = Auth::user();

        $this->fullname = $user->fullname;
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
            'fullname' => $this->fullname
        ]);

        Toaster::success(__('profile.saved_successfully'));
        return redirect()->route('profile.index', $user->username);
    }

    public function render()
    {
        return view('livewire.fullname-update');
    }
}
