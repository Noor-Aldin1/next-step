<?php

namespace App\Http\Controllers;

use App\Models\Mentor; // Import the Mentor model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import the Storage facade for file management

class MentorController extends Controller
{
    /**
     * Display a listing of the mentors.
     */
    public function index()
    {
        $mentors = Mentor::all(); // Retrieve all mentors
        return view('user.pages.profile.video_mentor', compact('mentors')); // Pass the mentors to the view
    }

    /**
     * Show the form for creating a new mentor.
     */
    public function create()
    {
        return view('mentor.create'); // Return the view to create a new mentor
    }

    /**
     * Store a newly created mentor in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'user_id' => 'required|integer|exists:users,id', // Ensure user exists
            'availability' => 'required|string|in:available,unavailable',
            'video' => 'required|file|mimes:mp4,mov,avi,wmv|max:10240', // Validate video file
            'status' => 'required|string|in:active,inactive',
        ]);

        // Store the uploaded video file
        $path = $request->file('video')->store('videos', 'public');

        // Create a new mentor record with the video path
        Mentor::create($request->only('user_id', 'availability', 'status') + ['video' => $path]);

        return redirect()->route('mentors.index')->with('success', 'Mentor created successfully.'); // Redirect to index with success message
    }

    /**
     * Display the specified mentor.
     */
    public function show(string $id)
    {
        $mentorid = Mentor::where('user_id', auth()->id())->first();
        $mentor = Mentor::findOrFail($mentorid->id); // Find the mentor or fail
        return view('user.pages.profile.video_mentor', compact('mentor')); // Return the view for showing the mentor
    }

    /**
     * Show the form for editing the specified mentor.
     */
    public function edit(string $id)
    {
        $mentor = Mentor::findOrFail($id); // Find the mentor or fail
        return view('user.pages.profile.video_mentor', compact('mentor')); // Return the view for editing the mentor
    }

    /**
     * Update the specified mentor in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming request
        $request->validate([
            'user_id' => 'required|integer|exists:users,id', // Ensure user exists
            'availability' => 'required|string|in:available,unavailable',
            'video' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:10240', // Validate video file, nullable for updates
            'status' => 'required|string|in:active,inactive',
        ]);

        $mentor = Mentor::findOrFail($id); // Find the mentor or fail

        // Update mentor data
        $data = $request->only('user_id', 'availability', 'status');

        // If a new video file is uploaded, store it and update the path
        if ($request->hasFile('video')) {
            // Delete the old video file if necessary
            Storage::disk('public')->delete($mentor->video);
            $data['video'] = $request->file('video')->store('videos', 'public');
        }

        $mentor->update($data); // Update the mentor record

        return redirect()->route('mentors.index')->with('success', 'Mentor updated successfully.'); // Redirect to index with success message
    }

    /**
     * Remove the specified mentor from storage.
     */
    public function destroy(string $id)
    {
        $mentor = Mentor::findOrFail($id); // Find the mentor or fail
        Storage::disk('public')->delete($mentor->video); // Delete the video file
        $mentor->delete(); // Delete the mentor record

        return redirect()->route('mentors.index')->with('success', 'Mentor deleted successfully.'); // Redirect to index with success message
    }
}
