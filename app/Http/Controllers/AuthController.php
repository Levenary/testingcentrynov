<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }

        return redirect()->route('login')->with('error', 'Email atau password salah.');
    }

    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required|string|min:6|confirmed',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Handle image upload
    $imageName = null;
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('path/to/your/images/'), $imageName);
    }

    // Create user
    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
        'image' => $imageName,
    ]);

    // Log in the user
    Auth::login($user);

    return redirect()->route('login');
}


    public function showProfile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
    
    public function updateProfile(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:6|confirmed',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user->name = $request->input('name');
    $user->email = $request->input('email');

    if ($request->has('password')) {
        $user->password = Hash::make($request->input('password'));
    }
    $user->save();

    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('path/to/your/images/'), $imageName);
    
        if ($user->image) {
            unlink(public_path('path/to/your/images/' . $user->image));
        }
    
        $user->image = $imageName;
    
        // Store the image path in the session
        session(['user_image' => $imageName]);
    }
    
    $user->save();

    return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
}



    public function logout()
    {
         Auth::logout();
        return redirect()->route('login');
    }
}
