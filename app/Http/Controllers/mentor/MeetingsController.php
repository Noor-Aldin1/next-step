<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\MentorMeeting;
use App\Models\Mentor;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\mentor\EventManagementController;

class MeetingsController extends Controller
{
    protected $eventController;

    public function __construct(EventManagementController $eventController)
    {
        $this->eventController = $eventController;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Call the eventController's index method if needed
        $this->eventController->index(); // Uncomment if necessary

        $usernames = session('usernames'); // Fetch usernames from the session

        // Get the currently authenticated mentor
        $mentor = Mentor::where('user_id', auth()->id())->first();

        // Fetch all meetings for the logged-in mentor
        $meetings = MentorMeeting::with(['user', 'mentor']) // Eager load user and mentor relationships
            ->where('mentor_id', $mentor->id) // Filter by the current mentor's ID
            ->paginate(15); // Paginate the results to 15 per page

        // Fetch unique students associated with the meetings
        $students = $meetings->pluck('user')->unique('id'); // Get unique students based on user ID

        // Return the view with meetings, students, and usernames
        return view('mentor.pages.Meetings', compact('meetings', 'students', 'usernames'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show the form for creating a new meeting
        return view('mentor.meetings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'start_session' => 'required|date',
            'end_session' => 'required|date|after:start_session',
            'meeting_link' => 'required|url',
            'notes' => 'nullable|string',
            'status' => 'required|string',
        ]);

        // Create a new meeting record
        MentorMeeting::create(array_merge($validatedData, ['mentor_id' => auth()->id()]));

        return redirect()->route('meetings.index')->with('success', 'Meeting created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the meeting by ID
        $meeting = MentorMeeting::with(['user', 'mentor'])->findOrFail($id);

        return view('mentor.meetings.show', compact('meeting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Fetch the meeting for editing
        $meeting = MentorMeeting::findOrFail($id);

        return view('mentor.meetings.edit', compact('meeting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'start_session' => 'required|date',
            'end_session' => 'required|date|after:start_session',
            'meeting_link' => 'required|url',
            'notes' => 'nullable|string',
            'status' => 'required|string',
        ]);

        // Find the meeting and update it
        $meeting = MentorMeeting::findOrFail($id);
        $meeting->update($validatedData);

        return redirect()->route('meetings.index')->with('success', 'Meeting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $meeting_id)
    {
        // Find the meeting by meeting_id and delete it
        $meeting = MentorMeeting::where('meeting_id', $meeting_id)->firstOrFail();
        $meeting->delete();

        return back()->with('success', 'Meeting deleted successfully.');
    }
}
