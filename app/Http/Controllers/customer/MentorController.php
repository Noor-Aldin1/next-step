<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Mentor;
use App\Models\UserMentor;

use App\Models\Experience;
use App\Models\User;
use App\Models\UserSubscription;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MentorController extends Controller
{
    protected $sql;
    protected $experience;


    public function __construct()
    {



        $this->experience = User::where('role_id', 2)
            ->whereHas('mentors', function ($query) {
                $query->where('mentors.id', 2); // Specify the table name for id
            })
            ->with('experience') // Change this to 'experiences'
            ->get(); // Get the users

        // Now, you can access experiences for each user
        $this->experience = $this->experience->flatMap(function ($user) {
            return $user->experiences; // This will create a flat collection of all experiences
        });

        $this->sql = DB::table('users')
            ->join('mentors', 'mentors.user_id', '=', 'users.id')
            ->leftJoin('profiles', 'profiles.user_id', '=', 'users.id')
            ->select(
                'mentors.id',
                'users.username',
                'users.photo',
                'mentors.status',
                'profiles.full_name',
                'profiles.job_title',
                'profiles.linkedin',
                'profiles.github'
            )
            ->where('users.role_id', 2)
            ->where('mentors.status', 'active');
    }

    /**
     * Display a listing of the mentors.
     */
    public function index()
    {
        // Fetch paginated results
        $results = $this->sql
            ->paginate(10); // Change this number to how many items you want per page
        // dd($results);
        $mentors = Mentor::with('user')->get(); // Fetch all mentors with their associated user data

        return view('user.pages.mentors', compact('mentors', 'results'));
    }


    /**
     * Show the form for creating a new mentor.
     */
    public function create()
    {
        return view('mentors.create');
    }

    /**
     * Store a newly created mentor in the database.
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'availability' => 'required|string|max:255',
            'video' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);
        // Handle video upload
        $videoPath = null;
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public'); // Store video in the "videos" directory inside storage/app/public
        }


        // Create new mentor
        Mentor::create([
            'user_id' => $request->user_id,
            'availability' => $request->availability,
            'video' => $videoPath, // Save the video path in the database
            'status' => $request->status,
        ]);

        return redirect()->route('mentors.index')->with('success', 'Mentor created successfully.');
    }

    /**
     * Display the specified mentor.
     */
    public function show($id)
    {
        $this->sql = DB::table('users')
            ->select(
                'users.id',
                'mentors.id',
                'users.username',
                'users.email',
                'users.photo',
                'profiles.id AS profile_id',
                'profiles.user_id',
                'profiles.full_name',
                'profiles.phone',
                'profiles.email AS profile_email',
                'profiles.job_title',
                'profiles.country',
                'profiles.city',
                'profiles.age',
                'profiles.language',
                'profiles.major',
                'profiles.gender',
                'profiles.about_me',
                'profiles.linkedin',
                'profiles.github',
                'profiles.university',
                'profiles.gap',
                'mentors.video',
                DB::raw('GROUP_CONCAT(DISTINCT skills.name) AS skills_list'),
                DB::raw('GROUP_CONCAT(DISTINCT projects.name) AS projects_list')
            )
            ->leftJoin('mentors', 'mentors.user_id', '=', 'users.id')
            ->leftJoin('profiles', 'profiles.user_id', '=', 'users.id')
            ->leftJoin('experience', 'experience.user_id', '=', 'users.id')
            ->leftJoin('user_skill', 'user_skill.user_id', '=', 'users.id')
            ->leftJoin('skills', 'skills.id', '=', 'user_skill.skill_id')
            ->leftJoin('projects', 'projects.user_id', '=', 'users.id')
            ->where('users.role_id', 2)
            ->groupBy(
                'users.id',
                'mentors.id',
                'users.username',
                'users.email',
                'users.photo',
                'profiles.id',
                'profiles.user_id',
                'profiles.full_name',
                'profiles.phone',
                'profiles.email',
                'profiles.job_title',
                'profiles.country',
                'profiles.city',
                'profiles.age',
                'profiles.language',
                'profiles.major',
                'profiles.gender',
                'profiles.about_me',
                'profiles.linkedin',
                'profiles.github',
                'profiles.university',
                'profiles.gap',
                'mentors.video'
            );

        // Get the mentor's details based on the given ID
        $results = $this->sql->where('mentors.id', $id)->first();
        $skills = $this->sql->where('mentors.id', $id)->get();
        $user = auth()->user();

        $userId = auth()->id(); // Assuming the user is authenticated

        $mentorId = $results->id; // Assuming you're passing the mentor's ID
        // dd($results->id);

        // Check if the user has already subscribed to this mentor
        $hasSubscribed = UserMentor::where('student_id', $userId)
            ->where('mentor_id', $mentorId)
            ->exists();

        // Check for an active subscription (you can adjust the condition as per your business logic)
        // $activeSubscription = UserSubscription::where('user_id', $user->id)
        //     ->where('end_date', '>', now()) // Ensure the subscription is still active
        //     ->exists();



        // Get users with experience
        $usersWithExperience = User::where('role_id', 2)
            ->whereHas('mentors', function ($query) use ($id) {
                $query->where('mentors.id', $id); // Specify the table name for id
            })
            ->with('experience') // Ensure you're using 'experiences'
            ->get(); // Get the users

        // Now, create a flat collection of all experiences
        // $experience = $this->experience = $usersWithExperience->flatMap(function ($user) {
        //     return $user->experience; // This will create a flat collection of all experiences 
        // });

        // Now $this->experience contains all experiences across users
        $experience = DB::table('users')
            ->join('mentors', 'mentors.user_id', '=', 'users.id')
            ->leftJoin('experience', 'experience.user_id', '=', 'users.id')
            ->where('users.role_id', 2)

            ->where('mentors.id', $mentorId)
            ->select('experience.*')
            ->get();
        // dd($experience);
        // Get the mentor details along with related information
        $mentor = Mentor::with(['user', 'students', 'materials', 'tasks', 'lectures', 'ratings', 'meetings'])->findOrFail($id);

        // Return the view with the mentor and related data
        return view('user.pages.mentor_details', compact('mentor', 'results', 'usersWithExperience', 'experience', 'skills', 'user', 'hasSubscribed'));
    }

    /**
     * Show the form for editing the specified mentor.
     */
    public function edit($id)
    {
        $mentor = Mentor::findOrFail($id);
        return view('mentors.edit', compact('mentor'));
    }

    /**
     * Update the specified mentor in the database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'availability' => 'required|string|max:255',
            'video' => 'nullable|mimes:mp4,avi,mov,wmv|max:20000', // Validate video file
            'status' => 'required|in:active,inactive',
        ]);

        $mentor = Mentor::findOrFail($id);

        // Handle video upload
        if ($request->hasFile('video')) {
            // Optional: Delete the old video file if it exists
            if ($mentor->video) {
                Storage::disk('public')->delete($mentor->video);
            }

            $videoPath = $request->file('video')->store('videos', 'public'); // Store new video
            $mentor->video = $videoPath; // Update video path
        }

        // Update other fields
        $mentor->update($request->only(['availability', 'status']));

        return redirect()->route('mentors.index')->with('success', 'Mentor updated successfully.');
    }


    /**
     * Remove the specified mentor from the database.
     */
    public function destroy($id)
    {
        $mentor = Mentor::findOrFail($id);
        $mentor->delete();

        return redirect()->route('mentors.index')->with('success', 'Mentor deleted successfully.');
    }

    /**
     * Get active mentors.
     */
    public function activeMentors()
    {
        $activeMentors = Mentor::active()->with('user')->get(); // Fetch only active mentors
        return view('mentors.active', compact('activeMentors'));
    }
}
