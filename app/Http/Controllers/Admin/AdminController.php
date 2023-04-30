<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function login(Request $request){
        if ($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required'
            ];
            $customMessages = [
                // Add custom messages here.
                'email.required' => 'Email Address is required!',
                'email.email' => 'Valid Email Address is required',
                'password.required' => 'Password is required!',
            ];
            $this->validate($request,$rules,$customMessages);
            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password' => $data['password'],'status'=> 1])){
                return redirect('admin/dashboard');
            }else{
                return redirect()->back()->with('error_message','Invalid Email or Password');
            }

        }
        return view('admin.login');
    }
    public function checkAdminPassword(Request $request){
        $data = $request->all();
       if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
        return "true";

       }
       return "false";
    }
    public function updateAdminPassword(Request $request)
    {
        if($request->isMethod('POST')){
            $data = $request->all();
            if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
                if ($data['confirm_password'] == $data['new_password']) {
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password' =>bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_message','Password has been updated successfully');
                } else{
                    return redirect()->back()->with('error_message','Passwords dont match');
                }

            }
            return redirect()->back()->with('error_message','Your current password is incorrect');
        }
        $adminDetails = Admin::where(['email'=>Auth::guard('admin')->user()->email])->first()->toArray();
        return view('admin.settings.update_admin_password')->with($adminDetails);
    }
    public function updateAdminDetails(){
        return view('admin.settings.update_admin_details');
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
