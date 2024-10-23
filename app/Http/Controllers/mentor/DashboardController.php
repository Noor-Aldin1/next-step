<?php

namespace App\Http\Controllers\mentor;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\CourseStudent;
use App\Models\CourseLecture;
use App\Models\StudentTask;
use App\Models\UserMentor;
use App\Models\Course;
use App\Models\Mentor;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a Information  Dashboard for mentors.
     */

    public function index()
    {
        // Get the mentor based on the authenticated user
        $mentor = Mentor::where('user_id', auth()->id())->first();

        // Get all courses assigned to the mentor
        $courses = Course::where('mentor_id', $mentor->id)->get();
        $coursesCount = $courses->count();

        // Get all students assigned to the mentor
        $students = UserMentor::where('mentor_id', $mentor->id)->get();
        $studentsCount = $students->count();

        // Get new students assigned in the last 7 days
        $newStudents = UserMentor::where('mentor_id', $mentor->id)
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->get();
        $newStudentsCount = $newStudents->count();

        // Get completed tasks
        $taskCompleted = Task::where('mentor_id', $mentor->id)
            ->where('status', '=', 'completed')
            ->get();
        $taskCompletedCount = $taskCompleted->count();

        // Define and populate totalStudentsData for the last 30 days
        $totalStudentsData = UserMentor::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('mentor_id', $mentor->id)
            ->where('created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count')
            ->toArray(); // Convert the collection to an array

        // Define and populate newStudentsData for the last 7 days
        $newStudentsData = UserMentor::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('mentor_id', $mentor->id)
            ->where('created_at', '>=', Carbon::now()->subDays(7)) // Last 7 days
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count')
            ->toArray(); // Convert the collection to an array

        // Define and populate coursesCountData for the last 30 days
        $coursesCountData = Course::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('mentor_id', $mentor->id)
            ->where('created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count')
            ->toArray(); // Convert the collection to an array

        // Define and populate completedTasksData for the last 30 days
        $completedTasksData = Task::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('mentor_id', $mentor->id)
            ->where('status', 'completed')
            ->where('created_at', '>=', Carbon::now()->subDays(30)) // Last 30 days
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count')
            ->toArray(); // Convert the collection to an array

        // Prepare data for the view
        $data = compact(
            'mentor',
            'courses',
            'coursesCount',
            'students',
            'taskCompleted',
            'coursesCount',
            'studentsCount',
            'newStudentsCount',
            'taskCompletedCount',
            'totalStudentsData', // Include this
            'newStudentsData',   // Include this
            'coursesCountData',  // Include this
            'completedTasksData' // Include this
        );

        // Return the view with the data
        return view('mentor.pages.overview', $data);
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
