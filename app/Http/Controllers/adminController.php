<?php

namespace App\Http\Controllers;

use App\Models\ecommerce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class adminController extends Controller
{
    public function indexdashboard(request $request)
    {
   
        return view('dashboard.dashboard');
    }
    public function userdetails(Request $request)
    {
        $query = ecommerce::query();
       
        if ($request->ajax()) {
            $user = $query->where('id', 'LIKE', '%' . $request->searchUser . '%')
                ->orWhere('fname', 'LIKE', '%' . $request->searchUser . '%')
                ->orWhere('lname', 'LIKE', '%' . $request->searchUser . '%')
                ->orWhere('email', 'LIKE', '%' . $request->searchUser . '%')
                ->orWhere('role', 'LIKE', '%' . $request->searchUser . '%')
                ->orWhere('country', 'LIKE', '%' . $request->searchUser . '%')
                ->orWhere('city', 'LIKE', '%' . $request->searchUser . '%')
                ->orWhere('gender', 'LIKE', '%' . $request->searchUser . '%')
                ->orWhere('is_active', 'LIKE', '%' . $request->searchUser . '%')
                ->paginate(5);
    
            return response()->json(['user' => $user]);
        } else {
            $user = $query->paginate(5);
            return view('dashboard.users.userlist', compact('user'));
        }
    }
    
    public function edituserdetails(request $request,$id)
    {
    
        $user=ecommerce::find($id);
        return view('dashboard.users.edituserlist',compact('user'));
 
 
    }
    public function userProfileupdate(request $request,$id)
    {
    
        $user = ecommerce::find($id);

        if ($user) {
    
            $user->fname = $request['fname'];
            $user->lname = $request['lname'];
            $user->country = $request['country'];
            $user->city = $request['city'];
            $user->gender = $request['gender'];
    
            // Save the changes
            $user->save();
    
            return redirect()->route('userdetails')->with('message', 'Profile updated successfully');
    
 
 
    }
}
    public function userPictureupdate(request $request,$id)
    {
    
        $this->validate($request,
        [
         'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ],
        [
          'photo.required'=> "Photo Required",
          'photo.image'=> "Invalid Picture",
          'photo.mimes'=> "Photo Required jpeg,png,jpg,gif",
          'photo.max'=> "Size of photo is to large",
        ]);
 
 
         $user = ecommerce::find($id);
 
         if($user){
 
             Storage::disk('public')->delete($user->photo);
 
 
             $user->photo = $request->file('photo')->store('userphoto', 'public');
             $user->save();
             return redirect()->route('userdetails')->with('message', 'Profile Updated succesfully');
          
 
         }
 
 
 
    }
    public function destroyuserdetails(request $request,$id)
    {
    
           $user = ecommerce::find($id);
 
           if ($user) {
            $user->delete(); // Correct syntax for deleting a record
            return redirect()->route('userdetails')->with('message', 'User deleted successfully');
        } else {
            return redirect()->route('userdetails')->with('message', 'User not found');
        }
 
 
 
    }
    public function useractive(Request $request, $id)
    {
        $user = ecommerce::find($id);
    
        if ($user) {
            // Toggle the 'is_active' field
            $user->is_active = !$user->is_active;
    
            // Save the changes to the database
            $user->save();
    
            return redirect()->route('userdetails')->with('message', 'User status updated successfully');
        } else {
            return redirect()->route('userdetails')->with('message', 'User not found');
        }
    }
    

    public function shop(){

        return view('shopitems.shopproduct');
    }
}