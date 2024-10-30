<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Support\Facades\Auth;

use App\Models\Mentor;
use App\Models\Task;
use App\Models\Material;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\CourseLecture;
use App\Models\StudentTask;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserCoursesController extends Controller
{
    /**
     * Retrieve courses by mentor ID.
     *
     * @param int $mentorId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function materials($mentorId, $id)
    {
        $course = Course::where('mentor_id', $mentorId)
            ->with('courseStudents') // Assuming this relation is defined in Course
            ->findOrFail($id);

        $materials = DB::table('course_materials')
            ->join('materials', 'materials.id', '=', 'course_materials.material_id')
            ->join('courses', 'courses.id', '=', 'course_materials.course_id')
            ->select('materials.*')
            ->where('courses.id', $id)           // Filter by course ID
            ->where('courses.mentor_id', $mentorId) // Filter by mentor ID
            ->get();
        $courseId = $id;
        return view('user.m-user.pages.materials', compact('materials', 'mentorId', 'courseId', 'course'));
    }

    public function tasks($mentorId, $id)
    {
        // Get the course by ID and mentor ID
        $course = Course::where('mentor_id', $mentorId)
            ->with('courseStudents') // Assuming this relation is defined in Course
            ->findOrFail($id);


        // Get tasks associated with the course and mentor
        $tasks = Task::where('mentor_id', $mentorId)
            ->join('course_tasks', 'tasks.id', '=', 'course_tasks.task_id')
            ->where('course_tasks.course_id', $id)
            ->select(
                'tasks.id',
                'tasks.mentor_id',
                'tasks.title',
                'tasks.description',
                'tasks.due_date',
                'tasks.created_at',
                'tasks.updated_at'
            )
            ->get();


        $tasks1 = Task::where('mentor_id', $mentorId)->get();
        $courseId = $id;

        // Fetch submissions by the authenticated student
        // Fetch the submissions directly as a collection
        $submissions = StudentTask::where('student_id', auth()->id())->pluck('submission', 'task_id');
        // dd($submissions);
        // Optionally, get students enrolled in the course if needed
        // $students = $course->courseStudents;

        return view('user.m-user.pages.tasks', compact('course', 'tasks', 'tasks1', 'mentorId', 'id', 'submissions', 'courseId'));
    }

    public function submit_task(Request $request, $mentorId)
    {
        // Validate the request
        $validated = $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'submission' => 'required|file|max:1000', // Change to 'file' for file uploads
        ]);

        // Find the task using the validated task_id
        $task = Task::findOrFail($validated['task_id']);

        // Check if the user is logged in
        $user_id = auth()->id();
        if (!$user_id) {
            return redirect()->route('login')->with('warning', 'You must be logged in to submit a task.');
        }

        // Handle file upload
        if ($request->hasFile('submission')) {
            // Store the file in the public storage and get the path
            $filePath = $request->file('submission')->store('submissions', 'public');

            // Create a new StudentTask
            $create_task = new StudentTask();
            $create_task->task_id = $validated['task_id'];
            $create_task->student_id = $user_id; // Assign the authenticated user's ID
            $create_task->submission = $filePath; // Store the file path

            // Update the task status to completed
            $task->update(['status' => 'completed']);

            // Save the new StudentTask
            $create_task->save();

            // Optionally, redirect with a success message
            return redirect()->back()->with('success', 'Task submitted successfully.');
        }

        // Redirect to a specific route using mentorId if no file is uploaded
        return redirect()->route('courses.tasks')->with('warning', 'No submission was uploaded. Please try again.');
    }







    public static function getCoursesByMentor($mentorId)
    {

        $course = Course::where('mentor_id', $mentorId)
            ->with('courseStudents')
            ->whereHas('courseStudents', function ($query) {
                $query->where('student_id', Auth::user()->id);
            })
            ->get();


        return $course;
    }


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

        $courseId = $id;

        session([
            'course' => $course,
            'duration' => $duration,
            'courseId' => $courseId,
            'mentorId' => $mentorId,
        ]);

        // Check if the course belongs to the mentor
        if (!$course) {
            return redirect()->route('courses.index', $mentorId)->with('error', 'Course not found.');
        }





        return view('user.m-user.pages.courses_detials', compact('course', 'duration', 'courseId', 'mentorId'));
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
