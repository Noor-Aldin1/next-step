<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\UserMentor;
use Illuminate\Http\Request;
use App\Models\UserSubscription;

class UsermentorsController extends Controller
{ /*    //@return \Illuminate\Http\Response
    */
    public function index()
    {
        // Fetch all mentor-student relationships
        $relationships = UserMentor::all();
        return view('usermentor.index', compact('relationships'));
    }

    /**
     * Show the form for creating a new mentor-student relationship.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usermentor.create');
    }

    /**
     * Store a newly created mentor-student relationship in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the input (no need to validate student_id since it’s the authenticated user)
        $request->validate([
            'mentor_id' => 'required|exists:mentors,id',
        ]);

        // Get the authenticated user's ID
        $userId = auth()->id(); // Assuming the user is authenticated

        // Check the user's subscription
        $userSubscription = UserSubscription::where('user_id', $userId)->latest()->first();

        if (!$userSubscription) {
            return redirect()->back()->withErrors('You do not have an active subscription.');
        }

        // Determine the number of mentors the user can have based on the subscription
        $allowedMentors = 0;
        if ($userSubscription->package_id == 1) {
            // First subscription (e.g., basic) allows only 1 mentor
            $allowedMentors = 1;
        } elseif ($userSubscription->package_id == 2) {
            // Second subscription (e.g., premium) allows up to 3 mentors
            $allowedMentors = 3;
        }

        // Count the number of existing mentor-student relationships
        $existingMentorCount = UserMentor::where('student_id', $userId)->count();

        // Check if the user can add another mentor
        if ($existingMentorCount >= $allowedMentors) {
            return redirect()->back()->withErrors("You have reached the limit of $allowedMentors mentors for your current subscription.");
        }

        // Create a new mentor-student relationship
        UserMentor::create([
            'mentor_id' => $request->mentor_id,
            'student_id' => $userId, // Use the authenticated user’s ID
        ]);

        return redirect()->route('usermentor.index')->with('success', 'Mentor-student relationship created successfully.');
    }



    /**
     * Display the specified mentor-student relationship.
     *
     * @param  \App\Models\UserMentor  $userMentor
     * @return \Illuminate\Http\Response
     */
    public function show(UserMentor $userMentor)
    {
        return view('usermentor.show', compact('userMentor'));
    }

    /**
     * Show the form for editing the specified mentor-student relationship.
     *
     * @param  \App\Models\UserMentor  $userMentor
     * @return \Illuminate\Http\Response
     */
    public function edit(UserMentor $userMentor)
    {
        return view('usermentor.edit', compact('userMentor'));
    }

    /**
     * Update the specified mentor-student relationship in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserMentor  $userMentor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserMentor $userMentor)
    {
        // Validate input
        $request->validate([
            'mentor_id' => 'required|exists:mentors,id',
            'student_id' => 'required|exists:students,id',
        ]);

        // Update the relationship
        $userMentor->update($request->only('mentor_id', 'student_id'));

        return redirect()->route('usermentor.index')->with('success', 'Mentor-student relationship updated successfully.');
    }

    /**
     * Remove the specified mentor-student relationship from storage.
     *
     * @param  \App\Models\UserMentor  $userMentor
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserMentor $userMentor)
    {
        $userMentor->delete();
        return redirect()->route('usermentor.index')->with('success', 'Mentor-student relationship deleted successfully.');
    }
}
