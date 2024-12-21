<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    function loginPost(Request $request)
    {
        // Validate the request inputs
        $request->validate([
            "email" => 'required|email',
            "password" => 'required',
        ]);

        // Attempt to authenticate the user
        $credentials = $request->only("email", "password");
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if the logged-in user is an admin
            if ($user->email === 'admin@example.com') {
                // Fetch the books for the admin dashboard
                $books = Book::all();
                return view('admin-dash', compact('books'));
            } else {
                // Redirect non-admin users to their profile page
                return redirect()->route('profile', ['email' => $user->email]);
            }
        }

        // If authentication fails, redirect back with an error message
        return redirect(route("login"))->with("error", "Login failed. Please check your credentials.");
    }

    function register()
    {

        return view('auth.register');
    }

    function registerPost(Request $request)
    {
        $request->validate([
            "fullname" => 'required',
            "email" => 'required',
            "password" => 'required',
        ]);

        $user = new User();
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($user->save()) {
            return redirect(route("login"))->with("success", "User created successfully");
        }
        return redirect(route("register"))->with("error", "Failed to create account");

    }

}
