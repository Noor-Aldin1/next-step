<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\UserSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    // Display the listing of the user's skills
    public function index()
    {
        // Fetch user's skills along with skill details
        $userSkills = UserSkill::with('skill')
            ->where('user_id', Auth::id()) // Filter by authenticated user
            ->get();

        // Return the view with user skills
        return view('user.pages.profile.partials.skills.index_form_skills', compact('userSkills'));
    }

    // Show the form for creating a new skill
    public function create()
    {
        // Fetch all available skills
        $skills = Skill::all();

        return view('user.pages.profile.partials.skills.Create_form_skills', compact('skills'));
    }

    // Store a newly created skill
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'rate' => 'required|numeric|min:1|max:10', // Rating must be between 1-10
            'name' => 'required|string|max:255', // Skill name is required
        ]);

        // Check if the skill with the given name already exists
        $skill = Skill::where('name', $validatedData['name'])->first();

        // If the skill does not exist, create a new skill
        if (!$skill) {
            $skill = Skill::create(['name' => $validatedData['name']]);
        }

        // Create a new UserSkill instance and associate it with the user
        $userSkill = new UserSkill();
        $userSkill->user_id = Auth::id(); // Get the authenticated user's ID
        $userSkill->skill_id = $skill->id; // Use the found or newly created skill's ID
        $userSkill->rate = $validatedData['rate']; // Set the rate from the request

        // Attempt to save the UserSkill instance
        if (!$userSkill->save()) {
            \Log::error('UserSkill could not be saved: ', ['userSkill' => $userSkill->toArray()]);

            // Redirect back with an error message
            return redirect()->back()->withErrors('There was a problem saving the user skill.');
        }

        // Redirect with a success message
        return redirect()->route('profile.edit')->with('success', 'Skill added successfully!');
    }



    // Show the form for editing the user's skill
    public function edit(UserSkill $userSkill)
    {
        $skills = Skill::all(); // Fetch all available skills
        return view('user.pages.profile.partials.skills.Edit_form_skills', compact('userSkill', 'skills'));
    }

    // Update a specific skill
    public function update(Request $request, $id)
    {
        // Validate input fields
        $request->validate([
            'rate' => 'required|numeric|min:1|max:10', // Validate skill rating
            'skill_id' => 'required|exists:skills,id', // Validate skill_id exists in the skills table
        ]);

        // Fetch the UserSkill record by ID, ensuring it's for the logged-in user
        $userSkill = UserSkill::where('user_id', Auth::id())->where('id', $id)->firstOrFail();

        // Update the rate and skill_id for the UserSkill model
        $userSkill->rate = $request->rate;
        $userSkill->skill_id = $request->skill_id;

        // Attempt to save the UserSkill
        if (!$userSkill->save()) {
            \Log::error('UserSkill could not be updated:', $userSkill->toArray());
            return redirect()->route('user.skills.index')->with('error', 'Skill update failed!');
        }

        // Redirect with a success message
        return redirect()->route('profile.edit')->with('success', 'Skill updated successfully!');
    }





    // Remove the specified skill from storage
    public function destroy(UserSkill $userSkill)
    {
        // Check if the user owns this user skill
        if ($userSkill->user_id != Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
        }

        // Delete the user skill
        $userSkill->delete();

        // Return a JSON response
        return response()->json(['success' => true]);
    }
}
