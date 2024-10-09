<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Add this line

use App\Models\Profile;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use App\Models\UserSkill;

class C_ProfileController extends Controller
{
    // Function to display the profile edit page
    public function edit(UserSkill $userSkill)
    {
        // Retrieve the authenticated user profile
        $profile = Auth::user()->profile;

        // Get the projects related to the authenticated user
        $projects = Auth::user()->projects;

        // Get all skills related to the authenticated user
        $allSkills = Auth::user()->skill;

        // Fetch all available skills
        $skills = Skill::all();

        // Return the view with the necessary data
        return view('user.pages.profile.profile', compact('profile', 'projects', 'allSkills', 'skills', 'userSkill'));
    }

    // Function to update user details (excluding the image)
    public function update(Request $request)
    {  // Update the projects details
        $this->updateProjects($request);
        // ----------main information --------//
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'job_title' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:18|max:100', // Optional age validation
            'language' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'about_me' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255|url', // Optional URL validation
            'github' => 'nullable|string|max:255|url', // Optional URL validation
            'major' => 'nullable|string|max:255', // Adding major field
            'university' => 'nullable|string|max:255', // Adding university field
            'gap' => 'nullable|string|max:255', // Adding gap field
        ]);

        $profile = Auth::user()->profile; // Get the authenticated user's profile

        // Update the profile details
        $profile->update($request->only([
            'full_name',
            'phone',
            'email',
            'job_title',
            'country',
            'email',
            'job_title',
            'country',
            'city',
            'age',
            'language',
            'major',
            'gender',
            'about_me',
            'linkedin', // Including major field
            'university', // Including university field
            'gap' // Including gap field
        ]));



        return redirect()->back()->with('success', 'Profile updated successfully.');
    }






    // Function to handle image upload separately
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image input
        ]);

        $user = Auth::user(); // Get the authenticated user

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Store the uploaded image
            $imagePath = $request->file('image')->store('images', 'public');

            // Update the 'photo' field in the users table
            $user->photo = $imagePath;
            $user->save(); // Save the updated user details
        }

        return redirect()->back()->with('success', 'Profile image updated successfully.');
    }
}