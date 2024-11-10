<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mentor;

class AdminMentorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all mentors along with their associated user (e.g., user profile)
        $mentors = Mentor::with(['user'])->paginate(10);

        // Return the view with the mentors data
        return view('admin.pages.mentors.all_mentors', compact('mentors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Display the form to create a new mentor (Optional)
        return view('admin.pages.mentors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'availability' => 'required|string',
            'video' => 'nullable|string',
            'status' => 'required|in:active,inactive', // Validate the status field
        ]);

        // Create a new mentor
        $mentor = Mentor::create($request->all());

        // Optionally, you can redirect with a success message
        return redirect()->route('admin.mentors.index')->with('success', 'Mentor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Retrieve the specific mentor by ID
        $mentor = Mentor::with(['user', 'courses', 'materials', 'tasks', 'lectures', 'ratings', 'students', 'meetings'])
            ->findOrFail($id);

        // Return a view to show the mentor details
        return view('admin.pages.mentors.show', compact('mentor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Retrieve the mentor by ID
        $mentor = Mentor::findOrFail($id);

        // Display the form for editing the mentor
        return view('admin.pages.mentors.edit', compact('mentor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'availability' => 'required|string',
            'video' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        // Find the mentor and update the data
        $mentor = Mentor::findOrFail($id);
        $mentor->update($request->all());

        // Optionally, you can redirect with a success message
        return redirect()->route('admin.mentors.index')->with('success', 'Mentor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the mentor and delete
        $mentor = Mentor::findOrFail($id);
        $mentor->delete();

        // Optionally, you can redirect with a success message
        return redirect()->route('admin.mentors.index')->with('success', 'Mentor deleted successfully.');
    }
}
