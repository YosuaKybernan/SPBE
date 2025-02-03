<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showSignupForm()
    {
        return view('admin.content.signup');
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|max:16|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/signup')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/admin/account-created?name=' . $user->name . '&username=' . $user->username);
    }

    public function checkEmail(Request $request)
    {
        $emailExists = User::where('email', $request->query('email'))->exists();
        return response()->json(['exists' => $emailExists]);
    }

    public function checkUsername(Request $request)
    {
        $usernameExists = User::where('username', $request->query('username'))->exists();
        return response()->json(['exists' => $usernameExists]);
    }

    public function accountCreated(Request $request)
    {
        return view('admin.content.account-created', ['name' => $request->query('name'), 'username' => $request->query('username')]);
    }

    public function showLoginForm()
    {
        return view('admin.content.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username_or_email' => 'required|string',
            'password' => 'required|string',
        ]);

        $usernameOrEmail = $request->input('username_or_email');
        $password = $request->input('password');

        // Check if the input is an email or username
        $user = User::where(function ($query) use ($usernameOrEmail) {
            $query->where('email', $usernameOrEmail)
                ->orWhere('username', $usernameOrEmail);
        })->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Email atau username tidak ditemukan.']);
        }

        if (!Hash::check($password, $user->password)) {
            return response()->json(['success' => false, 'message' => 'Password tidak sesuai.']);
        }

        Auth::login($user);

        // Redirect to profile page with user data
        return response()->json(['success' => true, 'redirect' => '/admin/profile']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}
