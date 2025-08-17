<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    /**
     * Show the registration form
     */
    public function showRegister()
    {
        return view('register');
    }

    /**
     * Handle registration form submit
     */
    public function register(Request $request)
    {
        // Validate form data
        $request->validate([
            'first_last_name' => 'required|max:100',
            'email'           => 'required|email|unique:users',
            'password'        => 'required|min:8',
            'country'         => 'required',
            'gender'          => 'required',
            'pic'             => 'required|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        // Create a new user (hashed password)
        $user = User::create([
            'name'     => $request->first_last_name,
            'email'    => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // Store profile picture in storage/app/public/profile_pics
        $path = $request->file('pic')->store('profile_pics', 'public');

        // Create profile record linked to user
        Profile::create([
            'user_id'         => $user->id,
            'first_last_name' => $request->first_last_name,
            'country'         => $request->country,
            'gender'          => $request->gender,
            'pic'             => $path
        ]);

        //login page after registration
        return redirect('login')->with('success', 'Registration successful! Please log in.');

    }

    /**
     * Show login form
     */
    public function showLogin()
    {
        return view('login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        // Validate login input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Attempt login
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate(); // prevent session fixation
            return redirect('users');
        }

        // If login fails, go back with error
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('login');
    }

    /**
     * Show users list with search and pagination
     */
    public function users(Request $request)
    {
        $users = User::with('profile')
            ->when($request->email, fn($q) => $q->where('email', 'like', "%{$request->email}%"))
            ->when($request->name, fn($q) => $q->whereHas('profile', fn($p) => $p->where('first_last_name', 'like', "%{$request->name}%")))
            ->paginate(5);

        return view('users', compact('users'));
    }
}
