<?php

namespace App\Http\Controllers;
use App\Models\cart;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Product;

class cartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
    $cartData = Cart::with('getProductData')->where('user_id', $user->id)->get();
    $subtotal = 0;

    foreach ($cartData as $value) {
        $productData = $value->getProductData;
        $price = !empty($productData->sale_price) ? $productData->sale_price : $productData->_price;
        $subtotal += $price * $value->quantity;
    }

    $tax = 3; // replace with your actual tax rate
    $shipping = 100;
    $total = round($subtotal + $shipping + ($subtotal * $tax / 100));

    return view('productsinfo.cartinfo', compact('user', 'cartData', 'subtotal', 'total', 'tax'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function storeCart(Request $request)
{
    // Validate the request
    $request->validate([
        'quantity' => 'required|numeric|min:1',
        'userComments' => 'required|string', // Add any additional validation rules for the comment field
    ]);

    // Save data into the 'carts' table
    $cart = Cart::create([
        'user_id' => $request->userId,
        'product_id' => $request->productId,
        'quantity' => $request->quantity,
    ]);

    // Check if the cart was successfully created
    if ($cart) {
        // Save data into the 'comments' table, associating it with the cart
        Comment::create([
            'ecommerce_id' => $request->userId,
            'comments' => $request->userComments,
            'product_id' => $request->productId,
            'cart_id' => $cart->id, // Associate the comment with the newly created cart
        ]);

        // Assuming you have a Product model, you can retrieve the product
        $product = Product::find($request->productId);

        // Check if the product is valid before redirecting
        if ($product) {
            return redirect()->route('product_info', ['product' => $product->id])->with('message', 'Checkout Successfully');
        }
    }

    // If something went wrong, redirect back with an error message
    return redirect()->back()->with('error', 'Error during checkout');
}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->except('_token');
    
        // Check if 'cart' key exists in $requestData
        foreach ($requestData['cart'] as $cartId) {
            // Check if the key exists in the 'cartQty' array
            if (isset($requestData['cartQty'][$cartId])) {
                // Process the item based on the aligned keys
                $quantity = $requestData['cartQty'][$cartId];
                if ($quantity < 1) {
                    Cart::where('id', $cartId)->delete();
                    Comment::where('ecommerce_id', auth()->user()->id)->delete();
                } else {
                    Cart::where('id', $cartId)->update(['quantity' => $quantity]);
                }
            }
        }
    
        Comment::where('ecommerce_id', auth()->user()->id)->update(['comments' => $requestData['userComments']]);
        return redirect()->back()->with('message', 'Cart updated successfully');
    }


    public function productsCarts(request $request, Product $product) {
       
    
          
        // Debugging: Dump and die to inspect the retrieved product
        // dd($product);
    
        return view('productsinfo.addCart', compact('product'));
    }
    
    

    public function deleteCart($id){
        // Find the cart record with the given ID
        $cart = Cart::find($id);
        if ($cart) {
            // Delete the cart record
            $cart->delete();
        }
    
        // Find the comment record(s) associated with the cart ID
        $comments = Comment::where('cart_id', $id)->get();
        foreach ($comments as $comment) {
            // Delete each comment record
            $comment->delete();
        }
    
        // Optionally, you can redirect the user back to a specific route
        return redirect()->back()->with('success', 'Cart and associated comments deleted successfully.');
    }

    

   
}
