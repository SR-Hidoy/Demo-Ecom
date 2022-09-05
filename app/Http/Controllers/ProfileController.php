<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
// use Illuminate\Validation\Validator::validateReqired;

class ProfileController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    function index(){
      return view('admin.profile.index');
    }

    function profilepost(Request $request){
      $request->validate([
        'name' => 'required'
      ]);
      $old_name = Auth::user()->name;
      User::find(Auth::id())->update([
        'name' => $request->name
      ]);
      return back()->with('success_message', 'Your name sussessfully updated from '.$old_name. '  to '.$request->name);
    }
      // echo Auth::user()->id;
      // echo $request->name;
      // print_r($request->name);
      // return view('admin.profile.index');

    function passwordpost(Request $request){

      $request->validate([
        'old_password' => 'required',
        'password' => 'required|confirmed',
        'password_confirmation' => 'required'
      ]);
      if($request->old_password == $request->password){

        return back()->withErrors("Your New password can not be your old password");
      }
      $old_password_from_user = $request->old_password;
      $password_from_user_db = Auth::user()->password;
      if(Hash::check($old_password_from_user, $password_from_user_db)){
        User::find(Auth::id())->update([
          'password' => Hash::make($request->password)
        ]);
      }
      else{
        return back()->with("database_status", "Your old password does not match with database password");
      }
       return back()->with('password_Change_status', 'Your password changed successfully!');
    }
}
