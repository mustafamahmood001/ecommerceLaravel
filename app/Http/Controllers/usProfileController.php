<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ecommerce;
use App\Http\Requests\userProfileRequest;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class usProfileController extends Controller
{
    public function userProfileview()
    {
        $user = Auth::user();


        return view('usersprofile.userProfile',compact('user'));
    }
    public function userProfileedit(string $id)
    {
        $user = ecommerce::find($id);
    if ($user) {
        return view('usersprofile.userProfile', compact('user'));
    }
    }
    public function userProfileupdate(userProfileRequest $userProfileRequest, string $id)
    {
        $user = ecommerce::find($id);

        if ($user) {
    
            $user->fname = $userProfileRequest['fname'];
            $user->lname = $userProfileRequest['lname'];
            $user->country = $userProfileRequest['country'];
            $user->city = $userProfileRequest['city'];
            $user->gender = $userProfileRequest['gender'];
    
            // Save the changes
            $user->save();
    
            return redirect()->route('indexWeb')->with('message', 'Profile updated successfully');
    
        }
    }
    public function userPictureupdate(request $request,$id){

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
            return redirect()->route('indexWeb')->with('message', 'Profile Updated succesfully');
         

        }


    }
    public function userPasswordview(){
        return view('usersprofile.userPassword');
    }
    public function userPassword(Request $request, $id)
    {
        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required|string|min:6',
            'confirmpassword' => 'required|same:newpassword',
        ], [
            'oldpassword.required' => 'Old Password Required',
            'newpassword.required' => 'New Password Required',
            'newpassword.min' => 'New Password should be at least 6 characters',
            'confirmpassword.required' => 'Confirm Password Required',
            'confirmpassword.same' => 'Password does not match with New Password',
        ]);
    
        $user = ecommerce::find($id);
    
        if ($user) {
            if (Hash::check($request->oldpassword, $user->password)) {
                $user->fill([
                    'password' => Hash::make($request->newpassword),
                ]);
    
                $user->save();
    
                return redirect()->route('indexWeb')->with('message', 'Password Updated successfully');
            } else {
                return redirect()->route('indexWeb')->with('message', 'Old Password is incorrect');
            }
        }
    }
}
