<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        $activeMenu = "change-password";
        return view('admin.profile.change-password', compact('activeMenu'));
    }


    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'The current password does not match our records.']);
        }

        $validatedNewPassword = $request->validate([
            'new_password' => 'required|string|min:8|confirmed',
            'new_password_confirmation' => 'required|string|min:8',
        ], [
            'new_password.confirmed' => 'The new password and confirmation password must match.',
        ]);


        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();


        notyf()->success('Password changed successfully.');
        return back();
    }


    public function manageProfile(Request $request)
    {

        $activeMenu = "manage-profile";
        return view('admin.profile.manage-profile', compact('activeMenu'));
    }


    public function updateProfile(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);


        $user = auth()->user();

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('', $filename, 'local');
            $user->profile_picture = $filename;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        notyf()->success('Profile updated successfully.');
        return redirect()->route('profile.manage-profile');
    }


}
