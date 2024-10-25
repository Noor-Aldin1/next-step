<?php

namespace App\Http\Controllers\mentor;

use App\Http\Controllers\Controller;
use App\Models\UserMentor;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Certification;
use App\Models\UserSkill;
use App\Models\Profile;
use App\Models\StudentTask;
use App\Models\User;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Mentor;

class AllStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the mentor based on the authenticated user
        $mentor = Mentor::where('user_id', auth()->id())->first();

        // Check if the mentor exists
        if (!$mentor) {
            return view('mentor.pages.all_student', ['message' => 'Mentor not found.']);
        }

        // Get the mentor's ID
        $mentorid = $mentor->id;

        // Set default sort order and retrieve it from request if available
        $order = $request->query('order', 'newest'); // Default to 'newest' if not specified
        $sortOrder = $order === 'oldest' ? 'asc' : 'desc';

        // Fetch all students assigned to this mentor with sorting
        $studentAll = DB::table('user_mentor')
            ->join('users', 'users.id', '=', 'user_mentor.student_id')
            ->join('mentors', 'user_mentor.mentor_id', '=', 'mentors.id')
            ->join('profiles', 'profiles.user_id', '=', 'users.id')
            ->where('mentors.id', '=', $mentorid)
            ->where('users.role_id', '=', 1)  // Assuming 1 is the role ID for students
            ->select(
                'users.id as user_id',
                'users.username as name',
                'users.photo as photo',
                'profiles.major as major',
                'profiles.phone as phone',
                'users.email as user_email',
                'profiles.email as pro_email',
                'profiles.full_name as pro_full_name',
                'profiles.id as profile_id',
                'user_mentor.created_at'
            )
            ->orderBy('user_mentor.created_at', $sortOrder) // Apply sort order based on filter
            ->paginate(10);

        // Prepare data for the view
        $data = compact('studentAll', 'order');

        // Return the view with the data
        return view('mentor.pages.all_student', $data);
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
        // Fetch the user by ID
        $user = User::findOrFail($id);

        // Fetch related data for the user
        $experiences = Experience::where('user_id', $user->id)->get();
        $projects = Project::where('user_id', $user->id)->get();
        $certifications = Certification::where('user_id', $user->id)->get(); // Fixed the variable name here
        $skill_name = DB::table('skills')
            ->join('user_skill', 'user_skill.skill_id', '=', 'skills.id')
            ->join('users', 'user_skill.user_id', '=', 'users.id')
            ->select('skills.name', 'user_skill.rate')
            ->where('users.id', $user->id)
            ->get();
        $userSkills = UserSkill::where('user_id', $user->id)->get();
        $profile = Profile::where('user_id', $user->id)->first(); // Fixed the variable name here
        // dd($skill_name);
        $projectsCount = Project::where('user_id', $user->id)->count();
        $userTasksCount = StudentTask::where('student_id', $user->id)
            ->where('submission', '!=', null)
            ->count();
        $certificationsCount = Certification::where('user_id', $user->id)->count();

        // Prepare the data for the view
        $data = compact(
            'certifications',   // Consistent variable name
            'experiences',
            'projects',
            'skill_name',
            'userSkills',
            'profile',
            'projectsCount',
            'user',
            'certificationsCount',
            'userTasksCount'
        );

        // Return the view with the data
        return view('mentor.pages.about_student', $data);
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
