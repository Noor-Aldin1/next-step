<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\MentorMeeting;
use App\Models\UserMentor;
use App\Models\Mentor;
use App\Http\Controllers\Customer\UserCoursesController;
use Illuminate\Http\Request;
use App\Http\Controllers\mentor\EventManagementController;
use Illuminate\Support\Facades\Auth;

class UserEventManagementController extends Controller
{

    protected $EventcoursesController;
    protected $CourseController;

    public function __construct(EventManagementController $EventManagementController, UserCoursesController  $CourseController)
    {
        $this->EventcoursesController = $EventManagementController;
        $this->CourseController = $CourseController;
    }




    public function getAllTimes()
    {
        $this->EventcoursesController->getAvailableTimes();
        // Get the currently authenticated mentor
        // Assuming you want to get the currently authenticated mentor, 
        // you might need to fetch it first if you're using it later.

        // Retrieve all lecture and meeting times
        $results = DB::table('mentors')
            ->leftJoin('lectures', 'lectures.mentor_id', '=', 'mentors.id')
            ->leftJoin('mentor_meetings', 'mentor_meetings.mentor_id', '=', 'mentors.id')
            ->join('course_lectures', 'course_lectures.lecture_id', '=', 'lectures.id')
            ->join('courses', 'courses.id', '=', 'course_lectures.course_id')
            ->join('course_students', 'course_students.course_id', '=', 'courses.id')
            ->join('users', 'users.id', '=', 'course_students.student_id')
            ->select(
                'lectures.start_session AS lecture_start',
                'lectures.end_session AS lecture_end',
                'mentor_meetings.start_session AS meeting_start',
                'mentor_meetings.end_session AS meeting_end',
                'mentors.id AS mentor_id'
            )
            ->where('users.id', Auth::id()) // Corrected this line
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
                        'is_special' => ($result->mentor_id == Auth::id()),
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
                        'is_special' => ($result->mentor_id == Auth::id()),
                    ];
                    // Mark this event as added
                    $uniqueEvents[$uniqueKey] = true;
                }
            }
        }

        // Now $events contains all the scheduled events without duplicates
        return $events; // Return or process the events as needed
    }






    public function getCourseEvents($mentorId)
    {
        $this->EventcoursesController->getAvailableTimes();

        $this->CourseController->index($mentorId);

        $events = $this->getAllTimes();
        $mentorId = session('mentorId');
        return view('user.m-user.pages.event_management', compact('events', 'mentorId'));
    }

    public function getMeetingsEvents($mentorId)
    {
        // Optionally call the CourseController's index method if needed
        $this->CourseController->index($mentorId);

        // Fetch meetings based on the mentor ID if applicable
        $meetings = DB::table('mentor_meetings')
            ->join('mentors', 'mentors.id', '=', 'mentor_meetings.mentor_id')
            ->join('users', 'mentors.user_id', '=', 'users.id')
            ->select('users.username', 'mentor_meetings.*')
            ->where('mentor_meetings.user_id', auth()->id())
            // ->where('mentor_meetings.mentor_id', $mentorId) // Uncomment if you need to filter by mentorId
            ->orderBy('mentor_meetings.start_session', 'desc') // Order by start_session date in ascending order
            ->paginate(10);


        // Optionally set mentorId from session if needed
        $mentorId = session('mentorId');

        return view('user.m-user.pages.meetings', compact('meetings', 'mentorId'));
    }
}
