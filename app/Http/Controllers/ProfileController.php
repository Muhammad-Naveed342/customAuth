<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        // Retrieve the authenticated user
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        // Retrieve the authenticated user for editing
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            // Add other fields as needed
        ]);

        // Retrieve the authenticated user
        $user = Auth::user();

        // Update user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            // Add other fields as needed
        ]);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}

