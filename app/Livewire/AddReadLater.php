<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;
use Masmerise\Toaster\Toaster;
use Illuminate\Support\Facades\Auth;

class AddReadLater extends Component
{
    public $bookId;
    public $isReadLater = false;

    public function mount($bookId)
    {
        $this->bookId = $bookId;
        $this->checkReadLater();
    }

    public function checkReadLater()
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user) {
            $this->isReadLater = $user->readLaters()->where('book_id', $this->bookId)->exists();
        }
    }

    public function addToReadLater()
    {
        /** @var User $user */

        $user = Auth::user();
        if ($user) {
            $user->readLaters()->attach($this->bookId);
            $this->isReadLater = true;

            Toaster::info(__('account.page.read_later.actions.added', ['title' => Book::find($this->bookId)->title]));
        }
    }

    public function removeFromReadLater()
    {
        $user = Auth::user();
        /** @var User $user */
        if ($user) {
            $user->readLaters()->detach($this->bookId);
            $this->isReadLater = false;

            Toaster::info(__('account.page.read_later.actions.removed', ['title' => Book::find($this->bookId)->title]));
        }
    }


    public function render()
    {
        return view('livewire.add-read-later');
    }
}
