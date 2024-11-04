<?php


namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Support\Facades\Log;



class AdminEmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all employer users with their associated user details
        $employerUsers = DB::table('employers')
            ->join('users', 'employers.user_id', '=', 'users.id')
            ->select('users.*', 'employers.*', 'employers.id AS id')
            ->where('users.role_id', 3)
            ->get();

        // Retrieve employee details if necessary
        $employee = Employer::with('user')->whereHas('user', function ($query) {
            $query->where('role_id', 3);
        })->get();

        return view('admin.pages.employer.all_employees', compact('employerUsers', 'employee'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_name' => 'required|string|max:255',
            'business_sector' => 'required|string|max:255',
            'employee_num' => 'required|integer',
            'city' => 'required|string|max:255',
            'account_manager' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // Initialize $imagePath to null
        $imagePath = null;

        // Check if the request has an uploaded file for the image
        if ($request->hasFile('image')) {
            // Check if the file is valid
            if ($request->file('image')->isValid()) {
                // Store the image and get the path
                $imagePath = $request->file('image')->store('images', 'public');
            } else {
                // If the image is not valid, log an error
                Log::error('Uploaded image is not valid.', [
                    'image' => $request->file('image')->getError(),
                ]);
                return back()->withErrors(['image' => 'The uploaded image is not valid.']);
            }
        } else {
            // Log if the file was not found in the request
            Log::error('No image file found in request.');
            return back()->withErrors(['image' => 'An image file is required.']);
        }

        // Create a new user
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
            'role_id' => 3,
            'photo' => $imagePath,
        ]);

        // Create a new employer associated with the user
        Employer::create([
            'company_name' => $request->company_name,
            'business_sector' => $request->business_sector,
            'employee_num' => $request->employee_num,
            'city' => $request->city,
            'account_manager' => $request->account_manager,
            'phone' => $request->phone,
            'user_id' => $user->id,
        ]);

        // Redirect or return a response
        return back()->with('success', 'Employer created successfully.');
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
    public function edit($id)
    {
        // Fetch the specific employee based on the ID
        $employee = Employer::with('user')->findOrFail($id);

        return view('admin.pages.employer.edit_employee', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request data
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id, // Allow the current email to be unchanged
            'password' => 'nullable|string|min:8|confirmed', // Password is optional for update
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is optional
            'company_name' => 'required|string|max:255',
            'business_sector' => 'required|string|max:255',
            'employee_num' => 'required|integer',
            'city' => 'required|string|max:255',
            'account_manager' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // Retrieve the existing user and employer
        $user = User::findOrFail($id);
        $employer = $user->employer; // Assuming there's a relationship defined in User model

        // Initialize $imagePath to null
        $imagePath = $user->photo; // Keep the existing image path by default

        // Check if the request has an uploaded file for the image
        if ($request->hasFile('image')) {
            // Check if the file is valid
            if ($request->file('image')->isValid()) {
                // Store the image and get the path
                $imagePath = $request->file('image')->store('images', 'public');
            } else {
                // If the image is not valid, log an error
                Log::error('Uploaded image is not valid.', [
                    'image' => $request->file('image')->getError(),
                ]);
                return back()->withErrors(['image' => 'The uploaded image is not valid.']);
            }
        }

        // Update the user record
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password, // Update only if a new password is provided
            'role_id' => 3,
            'photo' => $imagePath,
        ]);

        // Update the employer associated with the user
        $employer->update([
            'company_name' => $request->company_name,
            'business_sector' => $request->business_sector,
            'employee_num' => $request->employee_num,
            'city' => $request->city,
            'account_manager' => $request->account_manager,
            'phone' => $request->phone,
        ]);

        // Redirect or return a response
        return back()->with('success', 'Employer updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Find the employer by ID
            $employer = Employer::findOrFail($id);

            // Retrieve the associated user
            $user = $employer->user;

            // Delete the employer
            $employer->delete();

            // Delete the associated user if exists
            if ($user) {
                $user->delete();
            }

            // Commit transaction
            DB::commit();

            // Return a JSON response for AJAX
            return response()->json(['success' => true, 'message' => 'Employer deleted successfully.']);
        } catch (\Exception $e) {
            // Rollback transaction if any error occurs
            DB::rollBack();

            // Log the error for debugging
            Log::error('Failed to delete employer.', ['error' => $e->getMessage()]);

            // Return a JSON error response for AJAX
            return response()->json(['success' => false, 'message' => 'Failed to delete employer.'], 500);
        }
    }
}
