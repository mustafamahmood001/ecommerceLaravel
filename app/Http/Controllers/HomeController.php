<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function productIndex(request $request){
       
        $startDate = Carbon::now()->firstOfMonth();
        $endDate = Carbon::now()->lastOfMonth();
    
        $products = Product::whereBetween('created_at', [$startDate, $endDate])->inRandomOrder()->limit(12)->get();
        
       
        return view('index', compact('products'));
    }
    
    public function FilterIndex(request $request){
        if ($request->has('reset')) {
            return redirect()->route('homes');
        }

        $requestData = $request->all();
        $brands = Brands::pluck('name', 'id');
        $products = Product::query();
    
        if (isset($request['search']) && !empty($request['search'])) {
            $searchTerm = $request['search'];
            $products->where(function ($query) use ($searchTerm) {
                $query->orWhere('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('price', 'like', '%' . $searchTerm . '%')
                    ->orWhere('sale_price', 'like', '%' . $searchTerm . '%')
                    ->orWhere('color', 'like', '%' . $searchTerm . '%')
                    ->orWhere('brand', 'like', '%' . $searchTerm . '%')
                    ->orWhere('product_code', 'like', '%' . $searchTerm . '%')
                    ->orWhere('function', 'like', '%' . $searchTerm . '%')
                    ->orWhere('stock', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }
        if(isset($requestData['price']) && !empty($requestData['price'])){
            if($requestData['price'] == 'Less_than_500'){
                $products = $products->where('price', '<', '1500');
            } elseif($requestData['price'] == 'between_500_5k'){
                $products = $products->whereBetween('price', [500, 5000]);
            } elseif($requestData['price'] == 'between_5k_10k'){
                $products = $products->whereBetween('price', [5000, 10000]);
            } elseif($requestData['price'] == 'between_10k_pkr30k'){
                $products = $products->whereBetween('price', [10000, 30000]);
            } elseif($requestData['price'] == 'greater_than_30k'){
                $products = $products->where('price', '>', '30000');
            }
        }
    
        if(isset($requestData['color']) && !empty($requestData['color'])){
            $products = $products->where('color', $requestData['color']);
        }
    
        if(isset($requestData['function']) && !empty($requestData['function'])){
            $products = $products->where('function', $requestData['function']);
        }
    
        if(isset($requestData['sort_by']) && !empty($requestData['sort_by'])){
            if($requestData['sort_by'] == 'Price_Lower_to_Higher'){
                $products = $products->orderBy('price', 'ASC');
            } elseif($requestData['sort_by'] == 'Price_Higher_to_Lower'){
                $products = $products->orderBy('price', 'DESC');
            } elseif($requestData['sort_by'] == 'model_a_z'){
                $products = $products->orderBy('name', 'ASC');
            } elseif($requestData['sort_by'] == 'model_z_a'){
                $products = $products->orderBy('name', 'DESC');
            }
        }
    
        $products = $products->paginate(12);
        return view('index', compact('products','brands'));
    }

    
    public function productsinfo(request $request, Product $product){

        $relatedProduct=Product::where('brand',$product->brand)
        ->where('function',$product->function)->inRandomOrder()->limit(4)->get();

        return view('productsinfo.indexproductinfo', compact('product', 'relatedProduct'));

    }
    public function productslisting(Request $request){

        if ($request->has('reset')) {
            return redirect()->route('products_listing');
        }

        $requestData = $request->all();
        $brands = Brands::pluck('name', 'id');
        $products = Product::query();

    
        if(isset($requestData['price']) && !empty($requestData['price'])){
            if($requestData['price'] == 'Less_than_500'){
                $products = $products->where('price', '<', '1500');
            } elseif($requestData['price'] == 'between_500_5k'){
                $products = $products->whereBetween('price', [500, 5000]);
            } elseif($requestData['price'] == 'between_5k_10k'){
                $products = $products->whereBetween('price', [5000, 10000]);
            } elseif($requestData['price'] == 'between_10k_pkr30k'){
                $products = $products->whereBetween('price', [10000, 30000]);
            } elseif($requestData['price'] == 'greater_than_30k'){
                $products = $products->where('price', '>', '30000');
            }
        }
    
        if(isset($requestData['color']) && !empty($requestData['color'])){
            $products = $products->where('color', $requestData['color']);
        }
    
        if(isset($requestData['function']) && !empty($requestData['function'])){
            $products = $products->where('function', $requestData['function']);
        }
    
        if(isset($requestData['sort_by']) && !empty($requestData['sort_by'])){
            if($requestData['sort_by'] == 'Price_Lower_to_Higher'){
                $products = $products->orderBy('price', 'ASC');
            } elseif($requestData['sort_by'] == 'Price_Higher_to_Lower'){
                $products = $products->orderBy('price', 'DESC');
            } elseif($requestData['sort_by'] == 'model_a_z'){
                $products = $products->orderBy('name', 'ASC');
            } elseif($requestData['sort_by'] == 'model_z_a'){
                $products = $products->orderBy('name', 'DESC');
            }
        }
    
        $products = $products->paginate(12);
    
        return view('productsinfo.listingallproduct', compact('brands', 'products'));
    }
    
    
}