<?php


namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the packages.
     */
    public function index()
    {
        $packages = Package::all(); // Retrieve all packages
        return view('user.pages.packages', compact('packages')); // Return a view with the packages
    }
    public function  checkout(){

        
    }

    /**
     * Show the form for creating a new package.
     */
    public function create()
    {
        return view('packages.create'); // Return the view for creating a new package
    }

    /**
     * Store a newly created package in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'attributes' => 'required|string',
            'price' => 'required|numeric',
        ]);

        Package::create($request->all()); // Create a new package with the validated data

        return redirect()->route('packages.index')->with('success', 'Package created successfully.'); // Redirect with success message
    }

    /**
     * Display the specified package.
     */
    public function show(Package $package)
    {
        return view('packages.show', compact('package')); // Return the view for the specified package
    }

    /**
     * Show the form for editing the specified package.
     */
    public function edit(Package $package)
    {
        return view('packages.edit', compact('package')); // Return the view for editing the specified package
    }

    /**
     * Update the specified package in storage.
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'attributes' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $package->update($request->all()); // Update the package with the validated data

        return redirect()->route('packages.index')->with('success', 'Package updated successfully.'); // Redirect with success message
    }

    /**
     * Remove the specified package from storage.
     */
    public function destroy(Package $package)
    {
        $package->delete(); // Delete the specified package

        return redirect()->route('packages.index')->with('success', 'Package deleted successfully.'); // Redirect with success message
    }
}