<?php

namespace App\Http\Controllers\Customer;

use App\Models\Mentor;
use App\Models\Course;
use App\Models\CourseStudent;
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

        return view('user.m-user.pages.courses', compact('courses'));
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
