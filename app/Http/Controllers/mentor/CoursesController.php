<?php

namespace App\Http\Controllers\mentor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\UserMentor;
use App\Models\CourseStudent;
use App\Models\Mentor;
use App\Models\UserSubscription;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mentor = Mentor::where('user_id', auth()->id())->first();

        $courses = Course::where('mentor_id', $mentor->id)
            ->with('courseStudents')
            ->get();
        $data = compact('courses');

        // Return the view with the data
        return view('mentor.pages.all_courses', $data);
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
            // Active subscriptions exist for the mentor's students
            // Additional logic here if needed

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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Set mentor_id to the authenticated user's ID
        $validatedData['mentor_id'] = auth()->id();

        // Handle file upload if a photo is provided
        if ($request->hasFile('photo')) {
            $fileName = time() . '_' . $request->photo->getClientOriginalName();
            $filePath = $request->file('photo')->storeAs('uploads/photos', $fileName, 'public');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
