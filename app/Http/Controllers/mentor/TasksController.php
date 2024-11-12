<?php

namespace App\Http\Controllers\mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseTask;
use App\Models\Task;
use App\Http\Controllers\mentor\CoursesController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    protected $coursesController;

    public function __construct(CoursesController $coursesController)
    {
        $this->coursesController = $coursesController;
    }

    // Display a listing of the resource
    public function index(Request $request, $id)
    {
        // Call the show method to populate session data
        $this->coursesController->show($id);

        // Retrieve course, students, and lectures from session
        $course = session('course');
        $students = session('students');
        $lectures = session('lectures');
        $mentor = session('mentor');

        // Fetch tasks associated with the course and mentor
        $tasks = Task::join('course_tasks', 'course_tasks.task_id', '=', 'tasks.id')
            ->where('course_tasks.course_id', $course->id)
            ->where('tasks.mentor_id', $mentor->id)
            ->select('tasks.*')
            ->get();

        // Return the view with the tasks
        return view('mentor.pages.course.tasks', compact('tasks', 'course', 'students', 'lectures'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        // Return view for creating a new task
        return view('mentor.pages.course.tasks.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',

            // Add other statuses as needed
        ]);

        $mentor_id = $request->input('mentor_id');
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check if there is a mentor in the session, otherwise use the provided mentor ID
        $mentorId = session()->has('mentor') ? session('mentor')->id : $mentor_id;

        // Create the task
        $task = Task::create([
            'mentor_id' => $mentorId,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => 'pending',
        ]);
        $course_id = $request->input('course_id');  // Note: changed input name to 'course_id'
        $courseId = session()->has('course') ? session('course')->id : $course_id;
        CourseTask::create([
            'course_id' =>  $courseId,
            'task_id' => $task->id,

        ]);

        if (session()->has('course') && session('course')->id) {
            // Redirect with success message
            return redirect()->route('tasks.index', ['id' => session('course')->id])
                ->with('success', 'Task created successfully.');
        } else {
            return back()->with('success', 'Task created successfully.');
        }
    }

    // Display the specified resource
    public function show(string $id)
    {
        // Show a specific task based on the ID
        $task = Task::findOrFail($id);
        return view('mentor.pages.course.tasks.show', compact('task'));
    }

    // Show the form for editing the specified resource
    public function edit(string $id)
    {
        // Find the task and return view for editing it
        $task = Task::findOrFail($id);
        return view('mentor.pages.course.tasks.edit', compact('task'));
    }

    // Update the specified resource in storage
    public function update(Request $request, string $id)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the task and update it
        $task = Task::findOrFail($id);
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => 'pending',
        ]);

        // Redirect with success message
        if (session()->has('course') && session('course')->id) {
            // Redirect with success message
            return redirect()->route('tasks.index', ['id' => session('course')->id])
                ->with('success', 'Task created successfully.');
        } else {
            return back()->with('success', 'Task created successfully.');
        }
    }

    // Remove the specified resource from storage
    public function destroy(string $id)
    {
        // Find the task and delete it
        $task = Task::findOrFail($id);
        $task->delete();

        // Redirect with success message
        if (session()->has('course') && session('course')->id) {
            // Redirect with success message
            return redirect()->route('tasks.index', ['id' => session('course')->id])
                ->with('success', 'Task created successfully.');
        } else {
            return response()->json(['success' => True]);
        }
    }

    public function AnswerTask($id)
    {
        // Call the show method to populate session data
        $this->coursesController->show($id);

        // Retrieve course, students, and lectures from session
        $course = session('course');
        $students = session('students');
        $lectures = session('lectures');
        $mentor = session('mentor');

        $tasks = DB::table('tasks')
            ->join('student_tasks', 'student_tasks.task_id', '=', 'tasks.id')
            ->join('course_tasks', 'course_tasks.task_id', '=', 'tasks.id')
            ->where('tasks.mentor_id', $mentor->id)
            ->where('course_tasks.course_id', $id)
            ->select('tasks.*', 'student_tasks.*', 'student_tasks.created_at AS completion_date')
            ->get();

        return view('mentor.pages.course.task_answer', compact('tasks', 'course'));
    }
}
