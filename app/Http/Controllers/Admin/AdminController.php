<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;

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
    public function updateAdminDetails(Request $request){
        if($request->isMethod('post')){
            $data= $request->all();

        //   Update Admin Details
            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' => 'required|numeric'
            ];
            $customMessages = [
                'admin_name.required' => 'Name is required',
                'admin_name.regex' => 'The name must be valid',
                'admin_mobile.required' => 'Mobile is required',
                'admin_mobile.numeric' => 'Valid Mobile is required',
            ];
            $this->validate($request,$rules,$customMessages);
            // Upload Photos
            if($request->hasFile('admin_image')){
                $image_tmp = $request->file('admin_image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'admin/images/photos/'.$imageName;
                    Image::make($image_tmp)->save($imagePath);

                }
            } else if(!empty($data['current_admin_image'])){
                $imageName = $data['current_admin_image'];

            } else {
                $imageName = "";
            }
            Admin::where('id',Auth::guard('admin')->user()->id)->update(
                ['name'=> $data['admin_name'],
                'mobile' => $data['admin_mobile'],
                'image' => $imageName]
        );
            return redirect()->back()->with(['success_message' => 'Admin details updated successfully!']);
        }
        return view('admin.settings.update_admin_details');
    }
    public function updateVendorDetails(Request $request, string $slug){
        if($slug == 'personal'){
            if($request->isMethod('POST')){
                $data = $request->all();
                $rules = [
                    'vendor_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_mobile' => 'required|numeric',
                    'vendor_city' => 'required|regex:/^[\pL\s\-]+$/u',
                ];
                $customMessages = [
                    'vendor_name.required' => 'Name is required',
                    'vendor_name.regex' => 'The name must be valid',
                    'vendor_city.regex' => 'The City must be valid',
                    'vendor_mobile.required' => 'Mobile is required',
                    'vendor_mobile.numeric' => 'Valid Mobile is required',
                ];
                $this->validate($request,$rules,$customMessages);
                // Upload Photos
                if($request->hasFile('vendor_image')){
                    $image_tmp = $request->file('vendor_image');
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $imageName = rand(111,99999).'.'.$extension;
                        $imagePath = 'admin/images/photos/'.$imageName;
                        Image::make($image_tmp)->save($imagePath);

                    }
                } else if(!empty($data['current_vendor_image'])){
                    $imageName = $data['current_vendor_image'];

                } else {
                    $imageName = "";
                }
                // Update in Admin table
                Admin::where('id',Auth::guard('admin')->user()->id)->update(
                    ['name'=> $data['vendor_name'],
                    'mobile' => $data['vendor_mobile'],
                    'image' => $imageName]
            );
            // Update in vendors table
            Vendor::where(['id'=>Auth::guard('admin')->user()->vendor_id])->update(['name'=> $data['vendor_name'],
            'mobile' => $data['vendor_mobile'],'address' => $data['vendor_address'],
            'city' => $data['vendor_city'],'state' => $data['vendor_state'],'country' => $data['vendor_country'],
            'pincode' => $data['vendor_pincode'],
        ]);
                return redirect()->back()->with(['success_message' => 'Vendor details updated successfully!']);
            }
            $vendorDetails = Vendor::where(['id'=>Auth::guard('admin')->user()->vendor_id])->first();

        } else if($slug == 'business'){

        } else if($slug == 'bank'){

        }
        return view('admin.settings.update_vendor_details',['slug' => $slug,'vendorDetails'=>$vendorDetails]);

    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}