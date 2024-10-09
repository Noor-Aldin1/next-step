<?php


namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Add this line
// Import PDF facade


use App\Models\Profile;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use App\Models\UserSkill;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class ResumeController extends Controller
{
    // Example method for displaying a list of resumes
    public function index()
    {
        // Logic for displaying resumes


    }

    // Method to display the form for creating a new resume
    public function create()
    {
        // Logic for showing the form to create a resume
    }

    // Method to store a new resume in the database
    public function store(Request $request)
    {
        // Logic for validating and storing the resume
    }

    // Method to display a specific resume
    public function show($id)
    {
        // Fetch the user by ID
        $user = User::findOrFail($id);


        $experiences = Experience::where('user_id', $user->id)->get();

        $projects = Project::where('user_id', $user->id)->get();
        $Certification = Certification::where('user_id', $user->id)->get();
        $skill_name = $results = DB::table('skills')
            ->join('user_skill', 'user_skill.skill_id', '=', 'skills.id')
            ->join('users', 'user_skill.user_id', '=', 'users.id')
            ->select('skills.name', 'user_skill.rate')
            ->where('users.id', $user->id)
            ->get();
        $userSkills = UserSkill::where('user_id', $user->id)->get();
        $profiles = Profile::where('user_id', $user->id)->first();

        return view('user.pages.resume', compact('user', 'experiences', 'projects', 'Certification', 'skill_name', 'userSkills', 'profiles'));
    }

    public function downloadPdf($id)
    {
        // Fetch the user by ID
        $user = User::findOrFail($id);

        // Fetch user's experiences, projects, certifications, skills, and profiles
        $experiences = Experience::where('user_id', $user->id)->get();
        $projects = Project::where('user_id', $user->id)->get();
        $Certification = Certification::where('user_id', $user->id)->get();
        $skill_name = DB::table('skills')
            ->join('user_skill', 'user_skill.skill_id', '=', 'skills.id')
            ->join('users', 'user_skill.user_id', '=', 'users.id')
            ->select('skills.name', 'user_skill.rate')
            ->where('users.id', $user->id)
            ->get();
        $profiles = Profile::where('user_id', $user->id)->first();

        // Load the view and pass the data to it
        $viewData = compact('user', 'experiences', 'projects', 'Certification', 'skill_name', 'profiles');

        // Load the view with the provided data to create a PDF
        $pdf = PDF::loadView('user.pages.resume', $viewData);

        // Download the PDF file
        return $pdf->download('resume.pdf');
    }


    // Method to display the form for editing an existing resume
    public function edit($id)
    {
        // Logic for showing the edit form for a resume
    }

    // Method to update an existing resume
    public function update(Request $request, $id)
    {
        // Logic for validating and updating the resume
    }

    // Method to delete a resume
    public function destroy($id)
    {
        // Logic for deleting a resume
    }
}