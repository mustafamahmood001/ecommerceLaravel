<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Brands::query();
    
        if ($request->ajax()) {
            $brands = $query->where('id', 'LIKE', '%' . $request->search . '%')
                ->orWhere('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('description', 'LIKE', '%' . $request->search . '%')->sortable()
                ->paginate(5);
    
            return response()->json(['brands' => $brands]);
        } else {
            $brands = $query->sortable()->paginate(5);
            return view('dashboard.brands.indexbrands', compact('brands'));
        }
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.brands.createbrand');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $photoPath = $request->file('photo')->store('brandphoto', 'public');
        $brand = new Brands([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'photo' => $photoPath, 
        ]);
        
        $brand->save();
        return redirect()->route('brands.index')->with('message', 'Brand Uploaded Successfully');
    }

    

    /**
     * Display the specified resource.
     */
    public function show(Brands $brands)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brands $brand)
    {
        return view('dashboard.brands.editbrandlist', compact('brand'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brands $brand)
{
    // Validate the request data here if needed

    $brand->update([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        // Add other fields as needed
    ]);

    return redirect()->route('brands.index')->with('message', 'Brand updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {

    
}
public function destroyBrand($id)
{
    // Find the Brands model by its primary key
    $brand = Brands::find($id);

    if ($brand) {
        // Check if the brand has a photo
        if ($brand->photo !== null) {
            // Delete the associated photo from the disk
            Storage::disk('public')->delete($brand->photo);
        }

        // Delete the brand
        $brand->delete();

        return redirect()->route('brands.index')->with('message', 'Brand deleted successfully.');
    }

    // Handle the case where the Brands model is not found
    return redirect()->route('brands.index')->with('error', 'Brand not found.');
}


public function userPictureUpdate(Request $request, $id)
{
    // Find the Brands model by its primary key
    $brandPhoto = Brands::find($id);

    if ($brandPhoto) {
        // Check if the photo property is not null before attempting to delete
        if ($brandPhoto->photo !== null) {
            // Delete the existing photo
            Storage::disk('public')->delete($brandPhoto->photo);
        }

        // Upload and save the new photo
        $brandPhoto->photo = $request->file('photo')->store('brandphoto', 'public');
        $brandPhoto->save();

        return redirect()->route('brands.index')->with('message', 'Profile updated successfully');
    }

    // Handle the case where the Brands model is not found
    return redirect()->route('brands.index')->with('error', 'Brand not found.');
}
public function brandactive(Request $request, $id)
{
    $brands = Brands::find($id);

    if ($brands) {
        // Toggle the 'is_active' field
        $brands->is_active = !$brands->is_active;

        // Save the changes to the database
        $brands->save();

        return redirect()->route('brands.index')->with('message', 'Brand status updated successfully');
    } else {
        return redirect()->route('brands.index')->with('message', 'Brand not found');
    }
}


}