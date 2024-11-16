<?php


namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    // Display a listing of the experience records
    public function index()
    {
        $experiences = Experience::where('user_id', Auth::id())->get();
        return view('user.pages.profile.partials.Experiences.index_form_Experiences', compact('experiences'));
    }

    // Show the form for creating a new experience record
    public function create()
    {
        return view('experiences.create');
    }

    // Store a newly created experience record in storage
    public function store(Request $request)
    {
        $request->validate([
            'position' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_due' => 'required|date',
            'end_due' => 'nullable|date|after_or_equal:start_due',
        ]);

        Experience::create([
            'user_id' => Auth::id(),
            'position' => $request->position,
            'company_name' => $request->company_name,
            'description' => $request->description,
            'start_due' => $request->start_due,
            'end_due' => $request->end_due,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Experience created successfully.');
    }

    // Display the specified experience record
    public function show(Experience $experience)
    {
        return view('experiences.show', compact('experience'));
    }

    // Show the form for editing the specified experience record
    public function edit(Experience $experience)
    {
        return view('experiences.edit', compact('experience'));
    }

    // Update the specified experience record in storage
    public function update(Request $request, Experience $experience)
    {
        // Check if the user owns this experience
        if ($experience->user_id != Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
        }

        $request->validate([
            'position' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_due' => 'required|date',
            'end_due' => 'nullable|date|after_or_equal:start_due',
        ]);

        $experience->update([
            'position' => $request->position,
            'company_name' => $request->company_name,
            'description' => $request->description,
            'start_due' => $request->start_due,
            'end_due' => $request->end_due,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Experience created successfully.');
    }

    // Remove the specified experience record from storage
    public function destroy(Experience $experience)
    {
        // Check if the user owns this experience
        if ($experience->user_id != Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
        }

        // Delete the experience
        $experience->delete();

        return response()->json(['success' => true]);
    }
}
