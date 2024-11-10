<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mentor;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AdminMentorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all mentors along with their associated user (e.g., user profile)
        $mentors = Mentor::with(['user'])->paginate(10);
        $users = User::where('role_id', '=', 2)->get();
        // Return the view with the mentors data
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
            $validatedData = $request->validate([
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
            $mentor = Mentor::create([
                'user_id' => $inputChose,
                'availability' => 'unavailable', // Assuming unavailable if user is chosen
                'status' => $status,
                'video' => $videoPath,
            ]);
        } else {
            // Validate fields when creating a new user
            $validatedData = $request->validate([
                'username' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'availability' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'video' => 'nullable|mimes:mp4,avi,mkv,webm|max:50000',
                'status' => 'required|in:active,inactive',
            ]);

            // Handle image upload if exists
            if ($request->hasFile('image')) {
                $imageFile = $request->file('image');
                $imageFilename = 'mentor-image-' . uniqid() . '-' . time() . '.' . $imageFile->getClientOriginalExtension();
                $imageLocation = public_path('images/');
                $imageFile->move($imageLocation, $imageFilename);
                $imagePath = 'images/' . $imageFilename;
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
            $mentor = Mentor::create([
                'user_id' => $user->id,
                'availability' => $validatedData['availability'] ?? 'unavailable',
                'status' => $validatedData['status'],
                'video' => $videoPath,
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
            'user_id' => 'required|exists:users,id',
            'availability' => 'required|string',
            'video' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        // Find the mentor and update the data
        $mentor = Mentor::findOrFail($id);
        $mentor->update($request->all());

        // Optionally, you can redirect with a success message
        return redirect()->route('admin.mentors.index')->with('success', 'Mentor updated successfully.');
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
