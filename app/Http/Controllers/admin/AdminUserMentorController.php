<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use App\Models\UserMentor;
use App\Models\User; // Assuming this is the User model (mentors and students)
use Illuminate\Http\Request;
use Carbon\Carbon;


class AdminUserMentorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch all active users with a valid subscription
        $usersactive = User::whereHas('subscriptions', function ($query) {
            $query->where('end_date', '>', now());
        })->get();

        // Initialize the query for UserMentor
        $query = UserMentor::query();

        // Filter by student name if it's provided in the request
        if ($request->has('student_name') && $request->student_name) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('username', 'like', '%' . $request->student_name . '%');
            });
        }

        // Fetch the filtered user-mentor relationships
        $userMentorsfilter = $query->get();

        // Fetch mentors
        $mentors = Mentor::with('user')->get();

        // Fetch all user-mentor relationships with pagination
        $userMentors = UserMentor::with(['mentor', 'student'])->paginate(10);

        // Return the view with both filtered and unfiltered userMentor data
        return view('admin.pages.user.user_mentors', compact('userMentors', 'usersactive', 'mentors', 'userMentorsfilter'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get lists of all users to select mentors and students
        $users = User::all(); // Adjust this if you want to filter only mentors or students
        return view('admin.user_mentors.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'mentor_id' => 'required|exists:users,id',
            'student_id' => 'required|exists:users,id',
        ]);

        // Store the new mentor-student relationship
        UserMentor::create($validated);

        // Redirect to the user mentor index page with a success message
        return redirect()->route('admin.user_mentors.index')->with('success', 'User mentor relationship created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Show a specific user-mentor relationship
        $userMentor = UserMentor::with(['mentor', 'student'])->findOrFail($id);
        return view('admin.user_mentors.show', compact('userMentor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Get the user mentor relationship
        $userMentor = UserMentor::findOrFail($id);

        // Get the list of users to edit the mentor and student
        $users = User::all();

        return view('admin.user_mentors.edit', compact('userMentor', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'mentor_id' => 'required|exists:users,id',
            'student_id' => 'required|exists:users,id',
        ]);

        // Find and update the user mentor relationship
        $userMentor = UserMentor::findOrFail($id);
        $userMentor->update($validated);

        // Redirect back with a success message
        return redirect()->route('admin.user_mentors.index')->with('success', 'User mentor relationship updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find and delete the user mentor relationship
        $userMentor = UserMentor::findOrFail($id);
        $userMentor->delete();

        // Redirect back with a success message
        return response()->json(['success' => true]);
    }
}
