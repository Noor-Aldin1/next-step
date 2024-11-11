<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mentor;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Log;

class AdminMentorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = Mentor::with(['user']);

        // Apply filters if they are provided
        if ($request->has('mentor_id') && $request->mentor_id !== null) {
            $query->where('id', $request->mentor_id);
        }

        if ($request->has('mentor_name') && $request->mentor_name !== null) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('username', 'like', '%' . $request->mentor_name . '%');
            });
        }

        $mentors = $query->paginate(10);
        $users = User::where('role_id', '=', 2)->get();

        return view('admin.pages.mentors.all_mentors', compact('mentors', 'users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Display the form to create a new mentor (Optional)
        return view('admin.pages.mentors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $inputChose = $request->input('user_idCHose');

        // Validate basic data first
        $validatedData = $request->validate([
            'user_idCHose' => 'nullable|exists:users,id', // Validate user selection for "Choose Default User"
            'status' => 'required|in:active,inactive', // Validate the status field
        ]);

        $status = $request->input('status');
        // Initialize $imagePath and $videoPath to null
        $imagePath = null;
        $videoPath = null;

        // Check if "Choose Default User" is selected
        if ($inputChose) {
            // Additional validation for the video field if user is chosen
            $request->validate([
                'video' => 'required|file|mimes:mp4,mov,avi,wmv|max:10240',  // Max size for video validation
            ]);

            // Handle video upload manually
            if ($request->hasFile('video')) {
                $videoFile = $request->file('video');
                $filename = 'mentor-video-' . uniqid() . '-' . time() . '.' . $videoFile->getClientOriginalExtension();
                $location = public_path('videos/');
                $videoFile->move($location, $filename);
                $videoPath = 'videos/' . $filename;
            }

            // Assign the mentor to the chosen user
            Mentor::create([
                'user_id' => $inputChose,
                'availability' => 'unavailable', // Assuming unavailable if user is chosen
                'status' => $status,
                'video' => $videoPath,
            ]);
        } else {
            // Validate fields when creating a new user
            $validatedData = array_merge($validatedData, $request->validate([
                'username' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'availability' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'video' => 'nullable|mimes:mp4,avi,mkv,webm|max:50000',
            ]));

            // Handle image upload if exists
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
            }

            // Create a new user since "New User" is selected
            $user = User::create([
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'role_id' => 2, // default role is Mentor
                'photo' => $imagePath,
            ]);

            // Add user_id to validated data
            $validatedData['user_id'] = $user->id;

            // Handle video upload manually
            if ($request->hasFile('video')) {
                $videoFile = $request->file('video');
                $filename = 'mentor-video-' . uniqid() . '-' . time() . '.' . $videoFile->getClientOriginalExtension();
                $location = public_path('videos/');
                $videoFile->move($location, $filename);
                $videoPath = 'videos/' . $filename;
            }

            // Create a new mentor for the newly created user
            Mentor::create([
                'user_id' => $user->id,
                'availability' => $validatedData['availability'] ?? 'unavailable',
                'status' => $validatedData['status'],
                'video' => $videoPath,
            ]);

            Profile::create([
                'user_id' => $user->id,
                'full_name' => null,
                'email' => null,
                'phone' => null,
                'job_title' => null,
                'country' => null,
                'city' => null,
                'age' => null,
                'language' => null,
                'skills' => null,
                'experience' => null,
                'linkedin' => null,
                'github' => null,
            ]);
        }

        return back()->with('success', 'Mentor created successfully.');
    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Retrieve the specific mentor by ID
        $mentor = Mentor::with(['user', 'courses', 'materials', 'tasks', 'lectures', 'ratings', 'students', 'meetings'])
            ->findOrFail($id);

        // Return a view to show the mentor details
        return view('admin.pages.mentors.show', compact('mentor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Retrieve the mentor by ID
        $mentor = Mentor::findOrFail($id);

        // Display the form for editing the mentor
        return view('admin.pages.mentors.edit', compact('mentor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request data
        $request->validate([
            'video' => 'nullable|mimes:mp4,avi,mkv,webm|max:50000',
            'status' => 'required|in:active,inactive',
        ]);

        // Find the mentor and update the data
        $mentor = Mentor::findOrFail($id);

        // Check if a new video file has been uploaded
        $videoPath = $mentor->video; // Keep the existing video if no new video is uploaded

        if ($request->hasFile('video')) {
            $videoFile = $request->file('video');
            $filename = 'mentor-video-' . uniqid() . '-' . time() . '.' . $videoFile->getClientOriginalExtension();
            $location = public_path('videos/');
            $videoFile->move($location, $filename);
            $videoPath = 'videos/' . $filename; // Update the video path
        }

        // Update mentor data
        $mentor->update([
            'availability' => $request->input('availability', 'unavailable'), // Default availability if not provided
            'video' => $videoPath,
            'status' => $request->input('status'),
        ]);

        // Optionally, you can redirect with a success message
        return back()->with('success', 'Mentor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the mentor and delete
        $mentor = Mentor::findOrFail($id);
        $mentor->delete();

        // Optionally, you can redirect with a success message
        return response()->json(['success' => true]);
    }
}
