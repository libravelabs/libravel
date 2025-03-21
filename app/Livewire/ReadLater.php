<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ReadLater extends Component
{
    use WithPagination;

    public function render()
    {
        /** @var User $user */
        $user = Auth::user();
        $books = $user->readLaters()->paginate(5);

        return view('livewire.read-later', compact('books'));
    }
}
