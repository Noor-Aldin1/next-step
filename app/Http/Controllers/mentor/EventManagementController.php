<?php

namespace App\Http\Controllers\mentor;


use App\Http\Controllers\Controller;
use App\Models\CourseStudent;
use App\Models\Mentor;
use App\Models\MentorMeeting;
use App\Models\UserMentor;
use App\Models\Course;
use App\Models\UserSubscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;


class EventManagementController extends Controller
{
    public function getAllTimes()
    {
        // Get the currently authenticated mentor
        $mentor = Mentor::where('user_id', auth()->id())->first();

        // If mentor is not found, return an empty array or handle accordingly
        if (!$mentor) {
            return []; // Handle the case where the mentor is not found
        }

        // Retrieve all lecture and meeting times
        $results = Mentor::leftJoin('lectures', 'lectures.mentor_id', '=', 'mentors.id')
            ->leftJoin('mentor_meetings', 'mentor_meetings.mentor_id', '=', 'mentors.id')
            ->select(
                'lectures.start_session AS lecture_start',
                'lectures.end_session AS lecture_end',
                'mentor_meetings.start_session AS meeting_start',
                'mentor_meetings.end_session AS meeting_end',
                'mentors.id AS mentor_id'
            )
            ->where('mentors.id', $mentor->id)
            ->get();

        $events = [];

        // Use an associative array to track unique events
        $uniqueEvents = [];

        // Loop through the results and prepare the events array
        foreach ($results as $result) {
            // Check if the lecture times are not null and add them to the events
            if ($result->lecture_start) {
                // Create a unique key based on start and end times
                $uniqueKey = 'lecture_' . $result->lecture_start . '_' . $result->lecture_end;
                if (!isset($uniqueEvents[$uniqueKey])) {
                    $events[] = [
                        'title' => 'Lecture',
                        'start' => $result->lecture_start,
                        'end' => $result->lecture_end,
                        'is_special' => ($result->mentor_id == $mentor->id),
                    ];
                    // Mark this event as added
                    $uniqueEvents[$uniqueKey] = true;
                }
            }

            // Check if the meeting times are not null and add them to the events
            if ($result->meeting_start) {
                // Create a unique key based on start and end times
                $uniqueKey = 'meeting_' . $result->meeting_start . '_' . $result->meeting_end;
                if (!isset($uniqueEvents[$uniqueKey])) {
                    $events[] = [
                        'title' => 'Meeting',
                        'start' => $result->meeting_start,
                        'end' => $result->meeting_end,
                        'is_special' => ($result->mentor_id == $mentor->id),
                    ];
                    // Mark this event as added
                    $uniqueEvents[$uniqueKey] = true;
                }
            }
        }

        // Now $events contains all the scheduled events without duplicates
        return $events; // Return or process the events as needed

    }

    public function addMeeting(Request $request)
    {


        // Validate the incoming request data
        $validatedData = $request->validate([
            'mentor_id' => 'required|exists:mentors,id',
            'user_id' => 'required|exists:users,id',
            'start_session' => 'required|date|after:now',
            'end_session' => 'required|date|after:start_session',
            'meeting_link' => 'nullable|url',
            'notes' => 'nullable|string',
            'status' => 'required|string|in:scheduled,completed,canceled', // Adjust as needed
        ]);

        try {
            // Create a new MentorMeeting instance with validated data
            MentorMeeting::create($validatedData);

            // Redirect to the meetings index page with a success message
            return redirect()->route('meetings.index')->with('success', 'Meeting added successfully!');
        } catch (\Exception $e) {
            // Log the error message for debugging
            Log::error('Meeting creation failed: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->withErrors(['error' => 'Failed to add meeting.']);
        }
    }
    public function index()
    {
        // --------User Names ------
        $userIds = UserMentor::where('mentor_id', auth()->id())->pluck('student_id')->toArray();

        // Retrieve active subscriptions for each user in the list
        $subscriptions = UserSubscription::whereIn('user_id', $userIds)
            ->where('end_date', '>', now()) // Check for active subscriptions
            ->pluck('user_id')
            ->toArray();

        // Retrieve usernames for users with active subscriptions
        $usernames = !empty($subscriptions) ? User::whereIn('id', $subscriptions)->get() : collect();

        // ----------Meeting Status ------
        $columnInfo = DB::select("SHOW COLUMNS FROM mentor_meetings WHERE Field = 'status'");
        $statuses = [];

        if (isset($columnInfo[0])) {
            // Use regex to extract the enum values from the Type column
            preg_match("/^enum\(\'(.*)\'\)$/", $columnInfo[0]->Type, $matches);
            if (isset($matches[1])) {
                // Split the values into an array
                $statuses = explode("','", $matches[1]);
            }
        }

        // --------Course Name ------
        $mentor = Mentor::where('user_id', auth()->id())->first();
        $courseName = $mentor ? Course::where('mentor_id', $mentor->id)->get() : collect();


        // --------Data for View ------
        $events = $this->getAllTimes();



        $data = compact('usernames', 'statuses', 'courseName', 'events');

        return view('mentor.pages.event_management', $data);
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
