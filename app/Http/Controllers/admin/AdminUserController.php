<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{

    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->paginate(10);

        $roles = Role::all();

        return view('admin.pages.user.all_user', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|integer',
            'photo' => 'nullable|image|max:2048',
        ]);

        $user = new User();
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->role_id = $validatedData['role_id'];

        if ($request->hasFile('photo')) {
            $user->photo = $request->file('photo')->store('images', 'public');
        }

        $user->save();
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

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user.
     */
    public function show(string $id)
    {
        $user = User::with([
            'profile',
            'projects',
            'experience' => function ($query) {
                $query->orderBy('end_due', 'desc')->orderBy('start_due', 'desc');
            },
            'certifications',
            'userSkills' => function ($query) {
                $query->with('skill'); // Load the associated skill
            },
            'skills'
        ])->findOrFail($id);

        $roles = Role::all();
        $skills = Skill::all();


        return view('admin.pages.user.user_profile', compact('user', 'skills', 'id', 'roles'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => 'required|integer',
            'photo' => 'nullable|image|max:2048',
        ]);

        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->role_id = $validatedData['role_id'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        if ($request->hasFile('photo')) {
            $user->photo = $request->file('photo')->store('images', 'public');
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
    public function profileEdit(string $id)
    {
        // Retrieve the profile by ID or fail if not found
        $profile = Profile::where('user_id', $id)->firstOrFail();
        $user_id = $id;



        // Pass the profile data to the edit view
        return view('admin.pages.user.partials.profile.edit_profile', compact('profile', 'id'));
    }
    public function profileUpdate(Request $request, string $id)
    {
        // Validate main profile information
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'job_title' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:18|max:100', // Optional age validation
            'language' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'about_me' => 'nullable|string',
            'linkedin' => 'nullable|string|max:255|url', // Optional URL validation
            'github' => 'nullable|string|max:255|url', // Optional URL validation
            'major' => 'nullable|string|max:255',
            'university' => 'nullable|string|max:255',
            'gap' => 'nullable|string|max:255',
        ]);

        // Retrieve the profile by ID or fail if not found
        $profile = Profile::where('id', $id)->firstOrFail();
        // dd($profile->user_id);

        // Update the profile with validated data
        $profile->update($request->only([
            'full_name',
            'phone',
            'email',
            'job_title',
            'country',
            'city',
            'age',
            'language',
            'gender',
            'about_me',
            'linkedin',
            'github',
            'major',
            'university',
            'gap'
        ]));



        // Redirect back with success message
        return redirect()->route('admin.users.show', $profile->user_id)->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => true]);
    }
}
