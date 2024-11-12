<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Add this line
class AdminCoursesController extends Controller
{
    /**
     * Display a listing of the courses.
     */
    public function index()
    {
        $courses = Course::with(['mentor', 'materials', 'tasks.task', 'lectures', 'students'])->paginate(10);
        return view('admin.pages.mentors.all_courses', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store a newly created course in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'mentor_id' => 'required|exists:mentors,id',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        Course::create($data);

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified course.
     */
    public function show(string $id)
    {
        // Load the course with necessary relationships
        $course = Course::with(['mentor', 'materials.material', 'tasks.task', 'lectures.lecture', 'students'])
            ->findOrFail($id);

        // Paginate the lectures for the specific course
        $lectures = $course->lectures()->paginate(6);

        // If you want to debug the tasks or the task relationship, you can do so like this:
        // If 'task' is a nested relationship inside each 'task' in the 'tasks' collection
        // dd($course->tasks->map(function ($task) {
        //     return $task->task; // Assuming 'task' is a relationship on the Task model
        // }));

        // Return the view with the course and lectures
        return view('admin.pages.mentors.courses.course_ditails', compact('course', 'lectures'));
    }

    /**
     * Show the form for editing the specified course.
     */
    public function edit(string $id)
    {
        $course = Course::findOrFail($id);
        return view('admin.courses.edit', compact('course'));
    }

    /**
     * Update the specified course in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'mentor_id' => 'required|exists:mentors,id',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($course->photo) {
                Storage::disk('public')->delete($course->photo);
            }
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $course->update($data);

        return redirect()->back()->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified course from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);

        if ($course->photo) {
            Storage::disk('public')->delete($course->photo);
        }

        $course->delete();

        return response()->json(['success' => true]);
    }
}
