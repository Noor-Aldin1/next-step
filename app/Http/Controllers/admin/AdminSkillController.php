<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Skill;
use App\Models\UserSkill;

class AdminSkillController extends Controller
{
    // Store a new skill for the user
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|string|max:255',
            'skill_id' => 'required|integer',
            'rate' => 'required|numeric|min:1|max:10',
        ]);

        UserSkill::create([
            'user_id' => $validatedData['user_id'],
            'skill_id' => $validatedData['skill_id'],
            'rate' => $validatedData['rate'],
        ]);

        return back()->with('success', 'Skill assigned successfully.');
    }

    // Update an existing skill for the user
    public function update(Request $request, $id)
    {
        // Find the UserSkill by its ID
        $userSkill = UserSkill::find($id);

        // If the UserSkill is not found, redirect with an error message
        if (!$userSkill) {
            return back()->with('error', 'Skill not found.');
        }

        // Validate the incoming request
        $validatedData = $request->validate([
            'user_id' => 'required|string|max:255',
            'skill_id' => 'required|integer',
            'rate' => 'required|numeric|min:1|max:10',
        ]);

        // Update the UserSkill record with new values
        $userSkill->update([
            'user_id' => $validatedData['user_id'],
            'skill_id' => $validatedData['skill_id'],
            'rate' => $validatedData['rate'],
        ]);

        return back()->with('success', 'Skill updated successfully.');
    }
    public function destroy($id)
    {
        $userSkill = UserSkill::findOrFail($id);
        $userSkill->delete();

        return response()->json(['success' => true]);
    }
}
