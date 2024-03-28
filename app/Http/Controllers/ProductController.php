<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        $query = Product::query();
    
        if ($request->ajax()) {
            $products = $query->where('id', 'LIKE', '%' . $request->searchProduct . '%')
                ->orWhere('name', 'LIKE', '%' . $request->searchProduct . '%')
                ->orWhere('price', 'LIKE', '%' . $request->searchProduct . '%')
                ->orWhere('sale_price', 'LIKE', '%' . $request->searchProduct . '%')
                ->orWhere('color', 'LIKE', '%' . $request->searchProduct . '%')
                ->orWhere('brand', 'LIKE', '%' . $request->searchProduct . '%')
                ->orWhere('product_code', 'LIKE', '%' . $request->searchProduct . '%')
                ->orWhere('function', 'LIKE', '%' . $request->searchProduct . '%')
                ->orWhere('stock', 'LIKE', '%' . $request->searchProduct . '%')
                ->orWhere('name', 'LIKE', '%' . $request->searchProduct . '%')
                ->orWhere('is_active', 'LIKE', '%' . $request->searchProduct . '%')
                ->orWhere('description', 'LIKE', '%' . $request->searchProduct . '%')->sortable()
                ->paginate(3);
    
            return response()->json(['products' => $products]);
        } else {
            $products = $query->sortable()->paginate(3);
            return view('dashboard.products.indexproduct', compact('products'));
        }
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $brands=Brands::all();
        return view('dashboard.products.createproduct', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $this->validate($request, [
        'name' => 'required|min:2|max:10|string',
        'price' => 'numeric|required',
        'sale_price' => 'nullable|numeric',
        'color' => 'required|string',
        'brand' => 'required',
        'product_code' => 'required|min:4',
        'function' => 'nullable|string',
        'stock' => 'required|numeric',
        'description' => 'required|string|max:200',
        'image' => 'required|mimes:jpeg,png,jpg,gif'
    ], [
        'name.required' => 'Product name is required.',
        'name.min' => 'Product name must be at least :min characters.',
        'name.max' => 'Product name may not be greater than :max characters.',
        'price.numeric' => 'Price must be a number.',
        'price.required' => 'Price required.',
        'sale_price.numeric' => 'Sale price must be a number.',
        'color.required' => 'Color required.',
        'color.string' => 'Color must be a string.',
        'brand.required' => 'Brand required.',
        'product_code.required' => 'Product code required.',
        'product_code.min' => 'Product code must be at least :min characters.',
        'function.string' => 'Function must be a string.',
        'stock.required' => 'Stock required.',
        'stock.numeric' => 'Stock must be a number.',
        'description.required' => 'Description required.',
        'description.string' => 'Description must be a string.',
        'description.max' => 'Description may not be greater than :max characters.',
        'image.required' => 'Photo required.',
        'image.mimes' => 'Photo must be a file of type: :values.',
    ]);
    
    // The rest of your code for handling the form data goes here
    // For example, storing the data in the database

    $photoPath = $request->file('image')->store('productphoto', 'public');
        $product = new Product([
            'name' => $request->input('name'),
            'price'=> $request->input('price'),
            'sale_price'=> $request->input('sale_price'),
            'color'=> $request->input('color'),
            'brand'=> $request->input('brand'),
           'product_code'=> $request->input('product_code'),
           'function'=> $request->input('function'),
           'stock'=> $request->input('stock'),
           'description'=> $request->input('description'),
            'image' => $photoPath, 
        ]);
        
        $product->save();
        return redirect()->route('products.index')->with('message', 'Product Uploaded Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brands=Brands::all();
        $products=Product::find($id);
        if($products){
         return view('dashboard.products.editproduct',compact('products','brands'));
        }
        else{
            return redirect()->route('products.index')->with('message','No product Found');
        }
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:10|string',
            'price' => 'numeric|required',
            'sale_price' => 'nullable|numeric',
            'color' => 'required|string',
            'brand' => 'required',
            'product_code' => 'required|min:4',
            'function' => 'nullable|string',
            'stock' => 'required|numeric',
            'description' => 'required|string|max:200',
            
        ], [
            'name.required' => 'Product name is required.',
            'name.min' => 'Product name must be at least :min characters.',
            'name.max' => 'Product name may not be greater than :max characters.',
            'price.numeric' => 'Price must be a number.',
            'price.required' => 'Price required.',
            'sale_price.numeric' => 'Sale price must be a number.',
            'color.required' => 'Color required.',
            'color.string' => 'Color must be a string.',
            'brand.required' => 'Brand required.',
            'product_code.required' => 'Product code required.',
            'product_code.min' => 'Product code must be at least :min characters.',
            'function.string' => 'Function must be a string.',
            'stock.required' => 'Stock required.',
            'stock.numeric' => 'Stock must be a number.',
            'description.required' => 'Description required.',
            'description.string' => 'Description must be a string.',
            'description.max' => 'Description may not be greater than :max characters.',
            
        ]);
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('products.index')->with('message', 'Product not found.');
        }
    
        $oldImage = $product->image;
    
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->sale_price = $request->input('sale_price');
        $product->color = $request->input('color');
        $product->brand = $request->input('brand');
        $product->product_code = $request->input('product_code');
        $product->function = $request->input('function');
        $product->stock = $request->input('stock');
        $product->description = $request->input('description');
    
        if ($request->hasFile('image')) {
            // Handle image upload and update logic here
            $photoPath = $request->file('image')->store('productphoto', 'public');
            $product->image = $photoPath;
    
            // Delete the old image if it exists
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
        }
    
        $product->save();
    
        return redirect()->route('products.index')->with('message', 'Product updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroyProduct($id)
    {
        // Find the Brands model by its primary key
        $product = Product::find($id);
    
        if ($product) {
            // Check if the brand has a photo
            if ($product->photo !== null) {
                // Delete the associated photo from the disk
                Storage::disk('public')->delete($product->photo);
            }
    
            // Delete the brand
            $product->delete();
    
            return redirect()->route('products.index')->with('message', 'Product deleted successfully.');
        }
    
        // Handle the case where the Brands model is not found
        return redirect()->route('products.index')->with('error', 'Brand not found.');
    }
    public function productactive($id)
    {
        $products = Product::find($id);

        if ($products) {
            // Toggle the 'is_active' field
            $products->is_active = ! $products->is_active;
    
            // Save the changes to the database
            $products->save();
    
            return redirect()->route('products.index')->with('message', 'Product status updated successfully');
        } else {
            return redirect()->route('products.index')->with('message', 'Product not found');
        }
    }
}
