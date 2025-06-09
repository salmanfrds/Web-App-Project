<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Make sure you have a User model

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $kulliyahList = ['ICT', 'ENGIN', 'EDUC', 'LAWS', 'ENMS', 'ARCHI'];
        
        return view('profile.show', [
            'user' => $user,
            'kulliyahList' => $kulliyahList
        ]);
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
