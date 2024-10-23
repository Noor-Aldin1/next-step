<?php

namespace App\Http\Controllers\mentor;

use App\Http\Controllers\Controller;
use App\Models\UserMentor;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Certification;
use App\Models\UserSkill;
use App\Models\Profile;
use App\Models\User;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Mentor;

class AllStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the mentor based on the authenticated user
        $mentor = Mentor::where('user_id', auth()->id())->first();

        // Check if the mentor exists
        if (!$mentor) {
            return view('mentor.pages.all_student', ['message' => 'Mentor not found.']);
        }

        // Get the mentor's ID
        $mentorid = $mentor->id;

        // Fetch all students assigned to this mentor
        $studentAll = DB::table('user_mentor')
            ->join('users', 'users.id', '=', 'user_mentor.student_id')
            ->join('mentors', 'user_mentor.mentor_id', '=', 'mentors.id')
            ->join('profiles', 'profiles.user_id', '=', 'users.id')
            ->where('mentors.id', '=', $mentorid)
            ->where('users.role_id', '=', 1)  // Assuming 1 is the role ID for students
            ->select(
                'users.id as user_id',        // Alias for user ID
                'users.username as name',      // User details
                'users.photo as photo',
                'profiles.major as major',
                'profiles.phone as phone',
                'users.email as user_email',   // Alias for email to avoid conflict
                'profiles.email as pro_email',  // Alias for email to avoid conflict
                'profiles.full_name as pro_full_name',  // Alias for email to avoid conflict
                'profiles.id as profile_id',    // Alias for profile ID
                'user_mentor.created_at'
            )
            ->get();

        // Check if there are students assigned to the mentor
        if ($studentAll->isNotEmpty()) {
            // Get the first student
            $firstStudent = $studentAll->first();

            // Fetch experiences, projects, certifications, skills, and profile for this user
            $experiences = Experience::where('user_id', $firstStudent->user_id)->get();
            $projects = Project::where('user_id', $firstStudent->user_id)->get();
            $certifications = Certification::where('user_id', $firstStudent->user_id)->get();

            // Get skills and their rates for the user
            $skill_name = DB::table('skills')
                ->join('user_skill', 'user_skill.skill_id', '=', 'skills.id')
                ->join('users', 'user_skill.user_id', '=', 'users.id')
                ->select('skills.name', 'user_skill.rate')
                ->where('users.id', $firstStudent->user_id)
                ->get();

            // Fetch user skills and profile
            $userSkills = UserSkill::where('user_id', $firstStudent->user_id)->get();
            $profile = Profile::where('user_id', $firstStudent->user_id)->first();

            // Prepare data to pass to the view
            $data = compact(
                'studentAll',
                'experiences',
                'projects',
                'certifications',
                'skill_name',
                'userSkills',
                'profile',
                'firstStudent'
            );

            // Return the view with the data
            return view('mentor.pages.all_student', $data);
        } else {
            // If no students found, handle the case (you could return a view with an error or redirect)
            return view('mentor.pages.all_student', ['message' => 'No students found for this mentor']);
        }
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