<?php

namespace App\Http\Controllers\Auth;

use App\Models\Profile;
use App\Models\Application;
use App\Models\JobPosting;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employer;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisterdEmployerController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('employer.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'company_name' => ['required', 'string', 'max:255'],
            'business_sector' => ['required', 'string', 'max:255'],
            'employee_num' => ['nullable', 'integer'],
            'city' => ['required', 'string', 'max:255'],
            'account_manager' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],


        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 3, // default role is Employer

        ]);

        Employer::create([
            'user_id' => $user->id,
            'company_name' => $request->company_name,
            'business_sector' => $request->business_sector,
            'employee_num' => $request->employee_num,
            'city' => $request->city,
            'account_manager' => $request->account_manager,
            'phone' => $request->phone,
        ]);


        // Automatically create a profile for the user with null values


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    public function edit(): View
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Find the employer associated with the user
        $employer = Employer::where('user_id', $user->id)->first();

        // Count the number of jobs posted by the employer
        $jobCount = JobPosting::where('employer_id', $employer->id)->count();

        // Count the total number of applicants for the jobs posted by this employer
        $totalApplicants = Application::whereIn('id', function ($query) use ($employer) {
            $query->select('id')
                ->from('job_postings')
                ->where('employer_id', $employer->id);
        })->count();

        // Return the view with the user and employer data, along with job and applicant counts
        return view('employer.pages.profile.main_profile', [
            'user' => $user,
            'employer' => $employer,
            'jobCount' => $jobCount,
            'totalApplicants' => $totalApplicants,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id], // Ignore the current user's email
            'company_name' => ['required', 'string', 'max:255'],
            'business_sector' => ['required', 'string', 'max:255'],
            'employee_num' => ['nullable', 'integer'],
            'city' => ['required', 'string', 'max:255'],
            'account_manager' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        // Find the user and employer by their ID
        $user = User::findOrFail($id);
        $employer = Employer::where('user_id', $user->id)->firstOrFail();

        // Update the user model
        $user->username = $request->username;
        $user->email = $request->email;

        // Save the user model
        $user->save();

        // Update the employer model
        $employer->company_name = $request->company_name;
        $employer->business_sector = $request->business_sector;
        $employer->employee_num = $request->employee_num;
        $employer->city = $request->city;
        $employer->account_manager = $request->account_manager;
        $employer->phone = $request->phone;

        // Save the employer model
        $employer->save();

        // Redirect with a success message
        return redirect()->route('employer.profile')->with('success', 'Employer profile updated successfully.');
    }
}