<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Userrole;
use Hash;

use App\Model\Logs;
use Auth;
use DB;

class UpdateUserController extends Controller
{
    public function profileupdate()
    {
        $id = Auth::user()->id;
        $data["data"] = DB::table('users')
        ->where('id', $id)
        ->first();
        
        return view('admin.updateuser.index', $data);

    }

    public function changepassword()
    {
        $id = Auth::user()->id;
        $data["data"] = DB::table('users')
        ->where('id', $id)
        ->first();
        
        return view('admin.updateuser.userpass', $data);

    }

    public function updateuserpass(Request $request)
    {
     

        $request->validate([
            'currentpass' => 'required',
            'newpass' => 'required',
            'confirmpass' => 'required'
        ]);

        
        $user_id =  Auth::user()->id;

        if(!(Hash::check($request->get('currentpass'), Auth::guard('user')->user()->password))) {
            // The passwords matches
            // return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
            $flashdata = ['class'=>'danger', 'message'=>"Your current password does not matches with the password you provided. Please try again."];
            return redirect()->back()->with($flashdata);
        }
        if(strcmp($request->get('currentpass'), $request->get('newpass')) == 0){
            //Current password and new password are same
            // return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
            $flashdata = ['class'=>'danger', 'message'=>"New Password cannot be same as your current password. Please choose a different password."];
            return redirect()->back()->with($flashdata);
        }
        if($request->get('newpass') != $request->get('confirmpass')){
            //Current password and new password are same
            // return redirect()->back()->with("error","New Password and Confirm New Password does not match.");
            $flashdata = ['class'=>'danger', 'message'=>"New Password and Confirm New Password does not match."];
            return redirect()->back()->with($flashdata);
        }
        
        //Change Password
        $user = Auth::guard('user')->user();
        $user->password = bcrypt($request->get('newpass'));
        $user->save();
        $flashdata = ['class'=>'success', 'message'=>"Password changed successfully."];
        return redirect()->back()->with($flashdata);


    }


    public function updateuser(Request $request)
    {
        $id = $request->id;

        $validated = $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'email' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'email' => $request->email
        ];


        Logs::add("Profile Manage", "edit", $data);

        // Quiz::find($id)->update($data);
        User::where('id', $id)->update(array('name' => $request->name,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'email' => $request->email));

        echo json_encode([
            "status"=>"success",
            "message"=>"Profile has updated successfully"
        ]);

        $flashdata = ['class'=>'success', 'message'=>"Profile Update Successfull "];

        return redirect()->back()->with($flashdata);

    }

}
