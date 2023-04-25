<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function updateAdminPassword(){
        return view('admin.settings.update_admin_password');
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}