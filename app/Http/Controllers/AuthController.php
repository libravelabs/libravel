<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.login');
    }

    public function profile($username)
    {
        /** @var User $user */

        $user = Auth::user();
        if ($user && $user->username === $username) {
            return view('pages.account.profile');
        } else {
            $otheruser = User::where('username', $username)->first();
            if ($otheruser) {
                return view('pages.social.social', compact('otheruser'));
            } else {
                abort(404);
            }
        }
    }

    public function readlater($username)
    {
        /** @var User $user */

        $user = Auth::user();

        $books = $user->readLaters()->paginate(10);

        return view('pages.account.read-later', compact('books'));
    }
}
