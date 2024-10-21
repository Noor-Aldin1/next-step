<?php

namespace App\Http\Controllers\Customer;

use App\Models\Mentor;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\CourseLecture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserCoursesController extends Controller
{
    /**
     * Retrieve courses by mentor ID.
     *
     * @param int $mentorId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getCoursesByMentor($mentorId)
    {
        return Course::where('mentor_id', $mentorId)->with('courseStudents')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $mentorId
     * @return \Illuminate\View\View
     */
    public function index($mentorId)
    {
        // Get courses associated with the specified mentor ID
        $courses = $this->getCoursesByMentor($mentorId);

        return view('user.m-user.pages.courses', compact('courses', 'mentorId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($mentorId, $id)
    {
        // Get the course by ID and mentor ID
        $course = Course::where('mentor_id', $mentorId)->with('courseStudents')->findOrFail($id);
        $duration = CourseLecture::join('lectures', 'course_lectures.lecture_id', '=', 'lectures.id')
            ->where('course_lectures.course_id', $id) // Ensure the reference to course_id is from the correct table
            ->where('lectures.mentor_id', $mentorId) // Ensure the reference to mentor_id is from the correct table
            ->select('lectures.*')
            ->get();



        // Check if the course belongs to the mentor
        if (!$course) {
            return redirect()->route('courses.index', $mentorId)->with('error', 'Course not found.');
        }

        return view('user.m-user.pages.courses_detials', compact('course', 'duration'));
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
