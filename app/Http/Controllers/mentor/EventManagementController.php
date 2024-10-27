<?php

namespace App\Http\Controllers\mentor;


use App\Http\Controllers\Controller;
use App\Models\CourseStudent;
use App\Models\Mentor;
use App\Models\MentorMeeting;
use App\Models\UserMentor;
use App\Models\Course;
use App\Models\UserSubscription;
use App\Models\Lecture;
use App\Models\CourseLecture;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;


class EventManagementController extends Controller
{
    public function getAvailableTimes()
    {
        // Define all possible time slots from 08:00 to 23:30
        $allTimeSlots = [];
        $start = new \DateTime('08:00');
        $end = new \DateTime('23:30'); // Set the end time to 23:30 for the last slot

        // Generate all time slots in half-hour increments
        while ($start <= $end) {
            $allTimeSlots[] = $start->format('H:i');
            $start->modify('+30 minutes');
        }

        // Get the next few dates (for example, the next 3 days)
        $dates = [];
        for ($i = 0; $i < 3; $i++) {
            $dates[] = now()->addDays($i)->format('Y-m-d');
        }

        $availableTimes = [];

        // Loop through the dates and retrieve booked time slots for each date
        foreach ($dates as $date) {
            // Retrieve all lecture and meeting times for all mentors for the specified date
            $results = Mentor::leftJoin('lectures', 'lectures.mentor_id', '=', 'mentors.id')
                ->leftJoin('mentor_meetings', 'mentor_meetings.mentor_id', '=', 'mentors.id')
                ->select(
                    'lectures.start_session AS lecture_start',
                    'lectures.end_session AS lecture_end',
                    'mentor_meetings.start_session AS meeting_start',
                    'mentor_meetings.end_session AS meeting_end'
                )
                ->whereDate('lectures.start_session', $date) // Filter by lecture date
                ->orWhereDate('mentor_meetings.start_session', $date) // Filter by meeting date
                ->get();

            // Create an array to track booked time slots
            $bookedSlots = [];

            // Loop through the results and mark the booked time slots
            foreach ($results as $result) {
                // Mark booked slots for lectures
                if ($result->lecture_start && $result->lecture_end) {
                    $this->markBookedSlots($bookedSlots, $result->lecture_start, $result->lecture_end);
                }

                // Mark booked slots for meetings
                if ($result->meeting_start && $result->meeting_end) {
                    $this->markBookedSlots($bookedSlots, $result->meeting_start, $result->meeting_end);
                }
            }

            // Remove duplicates and filter out booked slots from available slots
            $availableSlots = array_diff($allTimeSlots, array_unique($bookedSlots));

            // Store available times for the date
            $availableTimes[$date] = array_values($availableSlots); // Reindex array
        }

        // Return the available times grouped by date
        return response()->json([
            'success' => true,
            'available_times' => $availableTimes,
        ], 200); // HTTP 200 OK 
    }

    // Helper method to mark booked slots within the specified time range
    private function markBookedSlots(&$bookedSlots, $start, $end)
    {
        $startTime = new \DateTime($start);
        $endTime = new \DateTime($end);

        // Generate time slots from start to end in 30-minute increments
        while ($startTime < $endTime) {
            $bookedSlots[] = $startTime->format('H:i');
            $startTime->modify('+30 minutes');
        }
    }


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
        // Retrieve the mentor based on the authenticated user
        $mentor = Mentor::where('user_id', auth()->id())->firstOrFail();

        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'start_session' => 'nullable|date|after_or_equal:now', // Start session must be a future date
            'end_session' => 'nullable|date|after:start_session',  // End session must be after start_session
            'meeting_link' => 'nullable|url',
            'notes' => 'nullable|string',
            'status' => 'required|string|in:scheduled,completed,canceled',
        ]);

        // Convert start and end session to datetime format if provided
        if ($request->has('start_session')) {
            $validatedData['start_session'] = Carbon::parse($request->start_session)->format('Y-m-d H:i:s');
        }

        if ($request->has('end_session')) {
            $validatedData['end_session'] = Carbon::parse($request->end_session)->format('Y-m-d H:i:s');
        }

        // Add the mentor_id to the validated data
        $validatedData['mentor_id'] = $mentor->id;
        MentorMeeting::create($validatedData);
        return redirect()->route('mentor.events.index')->with('success', 'Meeting added successfully!');
        try {
            // Create a new MentorMeeting instance with validated data
            MentorMeeting::create($validatedData);

            // Redirect to the meetings index page with a success message
            return redirect()->route('meetings.index')->with('success', 'Meeting added successfully!');
        } catch (\Exception $e) {
            // Log the error message for debugging with additional context
            Log::error('Meeting creation failed: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'mentor_id' => $mentor->id,
            ]);

            // Redirect back with an error message
            return redirect()->back()->withErrors(['error' => 'Failed to add meeting due to an internal error. Please try again later.']);
        }
    }



    public function addLecture(Request $request)
    {
        // Retrieve the mentor based on the authenticated user
        $mentor = Mentor::where('user_id', auth()->id())->firstOrFail();

        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'linke_lecture' => 'nullable|url',
            'start_session' => 'nullable|date|after_or_equal:now', // Start session must be a future date
            'end_session' => 'nullable|date|after:start_session', // End session must be after start_session
        ]);

        // Convert start and end session to datetime format if provided
        if ($request->has('start_session')) {
            $validatedData['start_session'] = Carbon::parse($request->start_session)->format('Y-m-d H:i:s');
        }

        if ($request->has('end_session')) {
            $validatedData['end_session'] = Carbon::parse($request->end_session)->format('Y-m-d H:i:s');
        }

        // Add the mentor_id to the validated data
        $validatedData['mentor_id'] = $mentor->id;

        try {
            // Create a new Lecture instance with validated data
            Lecture::create($validatedData);
            $CourseLecture = new CourseLecture;
            $CourseLecture->course_id = $request->course_id;
            $CourseLecture->lecture_id = Lecture::latest()->value('id');
            $CourseLecture->save();



            // Redirect to the lectures index page with a success message
            return redirect()->route('lectures.index')->with('success', 'Lecture added successfully!');
        } catch (\Exception $e) {
            // Log the error message for debugging with additional context
            Log::error('Lecture creation failed: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'mentor_id' => $mentor->id,
            ]);

            // Redirect back with an error message
            return redirect()->back()->withErrors(['error' => 'Failed to add lecture due to an internal error. Please try again later.']);
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
