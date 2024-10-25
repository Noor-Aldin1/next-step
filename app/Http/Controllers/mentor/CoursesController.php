<?php

namespace App\Http\Controllers\mentor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\UserMentor;
use App\Models\CourseStudent;
use App\Models\Mentor;
use App\Models\UserSubscription;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Add this line

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Display all courses for the logged-in mentor
        $mentor = Mentor::where('user_id', auth()->id())->first();

        // Initialize the query for courses
        $query = Course::where('mentor_id', $mentor->id);

        // Get the IDs of the students associated with the logged-in mentor
        $userIds = UserMentor::where('mentor_id', auth()->id())->pluck('student_id')->toArray();

        // Retrieve active subscriptions for each user in the list
        $subscriptions = UserSubscription::whereIn('user_id', $userIds)
            ->where('end_date', '>', now()) // Check for active subscriptions
            ->pluck('user_id')
            ->toArray();

        // Initialize an empty array for usernames
        $usernames = [];

        if (!empty($subscriptions)) {
            // Retrieve usernames for students with active subscriptions
            $activeUsernames = User::whereIn('id', $subscriptions)->pluck('username')->toArray();

            // Get student IDs from CourseStudent that are in the active user IDs
            $filter = CourseStudent::whereIn('student_id', $subscriptions)->pluck('student_id')->toArray();

            // Retrieve usernames for the filtered students
            $usernames = User::whereIn('id', $filter)->pluck('username')->toArray();

            // Check if a username is selected for filtering
            if ($request->filled('username') && in_array($request->username, $usernames)) {
                $selectedUsername = $request->username;

                // Get the student ID for the selected username
                $studentId = User::where('username', $selectedUsername)->value('id');

                // Filter courses based on the selected student's ID
                $query->whereHas('students', function ($query) use ($studentId) {
                    $query->where('student_id', $studentId);
                });
            }
        }

        // Get the filtered courses with pagination
        $courses = $query->paginate(10);

        // Prepare data for the view
        return view('mentor.pages.all_courses', compact('courses', 'usernames'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $userIds = UserMentor::where('mentor_id', auth()->id())->pluck('student_id')->toArray();

        // Retrieve active subscriptions for each user in the list
        $subscriptions = UserSubscription::whereIn('user_id', $userIds)
            ->where('end_date', '>', now()) // Check for active subscriptions
            ->pluck('user_id')
            ->toArray();

        if (!empty($subscriptions)) {
            // Retrieve usernames for users with active subscriptions
            $usernames = User::whereIn('id', $subscriptions)->get();


            $data = compact('usernames');
        }







        // Return the view with the data
        return view('mentor.pages.create_courses', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',

            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Set mentor_id to the authenticated user's ID
        // = auth()->id();
        $mentor = Mentor::where('user_id', auth()->id())->first();
        $validatedData['mentor_id'] = $mentor->id;

        // Handle file upload if a photo is provided
        if ($request->hasFile('photo')) {
            $fileName = time() . '_' . $request->photo->getClientOriginalName();
            $filePath = $request->file('photo')->storeAs('mentors/photos', $fileName, 'public');
            $validatedData['photo'] = $filePath;
        }

        // Create the course record
        $course = Course::create($validatedData);
        $cursesStudent = new CourseStudent();
        $cursesStudent->course_id = $course->id;
        $cursesStudent->student_id = $request->input('student');
        $cursesStudent->save();

        // Return a response or redirect
        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the course by ID
        $course = Course::findOrFail($id);

        // Ensure the authenticated user is the mentor of this course
        if ($course->mentor_id !== auth()->id()) {
            return redirect()->route('courses.index')->with('error', 'Unauthorized access!');
        }

        // Get usernames of students with active subscriptions
        $userIds = UserMentor::where('mentor_id', auth()->id())->pluck('student_id')->toArray();
        $subscriptions = UserSubscription::whereIn('user_id', $userIds)
            ->where('end_date', '>', now())
            ->pluck('user_id')
            ->toArray();

        if (!empty($subscriptions)) {
            $usernames = User::whereIn('id', $subscriptions)->get();
        } else {
            $usernames = collect(); // Empty collection if no users found
        }

        $data = compact('course', 'usernames');

        // Return the edit view with the course data
        return view('mentor.pages.update_course', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Make photo optional
        ]);

        // Find the course by ID
        $course = Course::findOrFail($id);

        // Ensure the authenticated user is the mentor of this course
        if ($course->mentor_id !== auth()->id()) {
            return redirect()->route('courses.index')->with('error', 'Unauthorized access!');
        }

        // Update the course with validated data
        $course->title = $validatedData['title'];
        $course->description = $validatedData['description'];

        // Handle file upload if a photo is provided
        if ($request->hasFile('photo')) {
            // Delete old photo if it exists
            if ($course->photo) {
                Storage::disk('public')->delete($course->photo);
            }

            $fileName = time() . '_' . $request->photo->getClientOriginalName();
            $filePath = $request->file('photo')->storeAs('mentors/photos', $fileName, 'public');
            $course->photo = $filePath;
        }

        // Save the updated course
        $course->save();

        // Return a response or redirect
        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}