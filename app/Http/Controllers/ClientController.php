<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Book;
use App\Models\PageSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $books = null;
            $trending = Book::trending(30)->take(10)->get();
            $collections = Collection::paginate(5);

            if ($trending->count() > 0) {
                $books = $trending;
            } else {
                $books = Book::inRandomOrder()->take(10)->get();
            }

            return view('pages/home', compact('books', 'collections'));
        } else {
            return view('pages/landing-page/index');
        }
    }

    public function subject()
    {
        return view('pages/browse/subject');
    }

    public function random()
    {
        return view('pages/browse/random');
    }

    public function trending()
    {
        return view('pages/browse/trending');
    }

    public function genre()
    {
        return view('pages/browse/genre');
    }
}
