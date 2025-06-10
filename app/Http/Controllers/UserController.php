<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $genderOptions = ['Male', 'Female'];

        return view('edit', [
            'user' => $user,
            'kulliyahList' => $kulliyahList,
            'genderOptions' => $genderOptions,
            'name' => $user->name,
            'matric_number' => $user->matric_number,
            'kulliyah' => $user->kulliyah,
            'gender' => $user->gender,
            'dob' => $user->dob,
            'bio' => $user->bio,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'matric_number' => 'nullable|string|max:20',
            'kulliyah' => 'nullable|string|in:ICT,ENGIN,EDUC,LAWS,ENMS,ARCHI', // Validate against allowed values
            'gender' => 'nullable|string|in:Male,Female', // Restrict to valid options
            'dob' => 'nullable|date|before:today', // Ensure date is in the past
            'bio' => 'nullable|string|max:500', // Allow optional bio with max 500 characters
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $filename = $uploadedFile->hashName(); // Generate a unique filename

            if ($user->profile_picture) { // Check if the user already has a profile picture
                // Remove 'images/' if it's part of the stored path
                $oldImagePath = str_replace('images/', '', $user->profile_picture);
                $oldImagePath = 'public/images/'. $oldImagePath;

                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }

            $path = $uploadedFile->storeAs('public/images', $filename);
            $validatedData['profile_picture'] = $filename;
        }

        try {
            $user->update($validatedData);
            return redirect()->route('profile')->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Failed to update profile.']);
        }
    }
}

