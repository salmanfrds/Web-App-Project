<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function profile()
    {
        return view('profile');
    }

    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // Hash the password
        ]);

        return redirect()->route('profile')->with('success', 'Account registered successfully!');
    }

    public function edit()
    {
        $user = Auth::user();
        $kulliyahList = ['ICT', 'ENGIN', 'EDUC', 'LAWS', 'ENMS', 'ARCHI'];

        return view('profile.edit', [
            'user' => $user,
            'kulliyahList' => $kulliyahList
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'matric_no' => 'required|string|max:20|unique:users,matric_no,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
            'kulliyah' => 'nullable|string|max:100',
            'program' => 'nullable|string|max:100'
        ]);

        $user->update($validatedData);

        return redirect()->route('profile.show')
                         ->with('success', 'Profile updated successfully!');
    }
}

