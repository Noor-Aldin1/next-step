<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Mentor;
use App\Models\CourseMaterial;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
    protected $coursesController;

    public function __construct(CoursesController $coursesController)
    {
        $this->coursesController = $coursesController;
    }

    public function index($id)
    {
        $this->coursesController->show($id);

        $course = session('course');
        $students = session('students');
        $lectures = session('lectures');
        $mentor = session('mentor');

        // Retrieve all materials for the authenticated mentor
        $materials = DB::table('materials')
            ->join('course_materials', 'course_materials.material_id', '=', 'materials.id')
            ->where('materials.mentor_id', $mentor->id)
            ->where('course_materials.course_id', $id)
            ->select('materials.*')
            ->get();
        return view('mentor.pages.course.materials', compact('materials', 'course'));
    }

    /**
     * Show the form for creating a new material.
     */
    public function create()
    {
        return view('mentor.materials.create');
    }

    /**
     * Store a newly created material in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'required|file|mimes:pdf,doc,docx,txt|max:2048', // File validation
        ]);

        // Handle file upload
        $filePath = $request->file('file_path')->store('materials');
        $mentorId = Mentor::where('user_id', auth()->id())->value('id');

        $mentor_Id = $request->input('mentor_id');
        // Create material record
        $material = Material::create([
            'mentor_id' => $mentorId ?? $mentor_Id,
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
        ]);

        $course_id = $request->input('course_id');
        $courseId = session()->has('course') ? session('course')->id : $course_id;

        CourseMaterial::create([
            'course_id' => $courseId,
            'material_id' => $material->id,

        ]);

        return redirect()->back()->with('success', 'Material created successfully.');
    }

    /**
     * Display the specified material.
     */
    public function show(string $id)
    {
        $material = Material::findOrFail($id);

        // Ensure that the material belongs to the authenticated mentor
        if ($material->mentor_id !== auth()->id()) {
            abort(403);
        }

        return view('mentor.materials.show', compact('material'));
    }

    /**
     * Show the form for editing the specified material.
     */
    public function edit(string $id)
    {
        $material = Material::findOrFail($id);

        if ($material->mentor_id !== auth()->id()) {
            abort(403);
        }

        return view('mentor.materials.edit', compact('material'));
    }

    /**
     * Update the specified material in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,txt|max:2048', // File validation
        ]);

        // Retrieve the material and check mentor ownership
        $material = Material::findOrFail($id);


        // Handle file upload if a new file is provided
        if ($request->hasFile('file_path')) {
            // Store the new file and update the file path
            $filePath = $request->file('file_path')->store('materials');
            $material->file_path = $filePath; // Update file path
        }

        // Update material details
        $material->title = $request->title;
        $material->description = $request->description;
        $material->save(); // Save updated material

        // Retrieve the course ID
        $course_id = $request->input('course_id');

        // Check if course_id is provided; use session if not
        if (!$course_id && session('course')) {
            $course_id = session('course')->id;
        }

        // Update or create the course material relationship
        CourseMaterial::updateOrCreate(
            ['material_id' => $material->id], // Find by material_id
            ['course_id' => $course_id] // Update or create course material
        );

        return redirect()->back()->with('success', 'Material updated successfully.');
    }



    /**
     * Remove the specified material from storage.
     */
    public function destroy(string $id)
    {
        $material = Material::findOrFail($id);



        $material->delete();

        return response()->json(['success' => true]);
    }
}
