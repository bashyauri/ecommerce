<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\VendorsBankDetail;
use App\Models\VendorsBusinessDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{
    public function dashboard()
    {
        Session::put('page', 'dashboard');
        return view('admin.dashboard');
    }
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
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

            $this->validate($request, $rules, $customMessages);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->with('error_message', 'Invalid Email or Password');
            }
        }
        return view('admin.login');
    }
    public function checkAdminPassword(Request $request)
    {
        $data = $request->all();
        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return "true";
        }
        return "false";
    }
    public function updateAdminPassword(Request $request)
    {
        Session::put('page', 'update_admin_password');
        if ($request->isMethod('POST')) {
            $data = $request->all();
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                if ($data['confirm_password'] == $data['new_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_message', 'Password has been updated successfully');
                } else {
                    return redirect()->back()->with('error_message', 'Passwords dont match');
                }
            }
            return redirect()->back()->with('error_message', 'Your current password is incorrect');
        }
        $adminDetails = Admin::where(['email' => Auth::guard('admin')->user()->email])->first()->toArray();
        return view('admin.settings.update_admin_password')->with($adminDetails);
    }
    public function updateAdminDetails(Request $request)
    {
        Session::put('page', 'update_admin_details');
        if ($request->isMethod('post')) {
            $data = $request->all();

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
            $this->validate($request, $rules, $customMessages);
            // Upload Photos
            if ($request->hasFile('admin_image')) {
                $image_tmp = $request->file('admin_image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'admin/images/photos/' . $imageName;
                    Image::make($image_tmp)->save($imagePath);
                }
            } else if (!empty($data['current_admin_image'])) {
                $imageName = $data['current_admin_image'];
            } else {
                $imageName = "";
            }
            Admin::where('id', Auth::guard('admin')->user()->id)->update(
                [
                    'name' => $data['admin_name'],
                    'mobile' => $data['admin_mobile'],
                    'image' => $imageName
                ]
            );
            return redirect()->back()->with(['success_message' => 'Admin details updated successfully!']);
        }
        return view('admin.settings.update_admin_details');
    }
    public function updateVendorDetails(Request $request, string $slug)
    {


        if ($slug == 'personal') {
            Session::put('page', 'update_personal_details');
            if ($request->isMethod('POST')) {
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
                $this->validate($request, $rules, $customMessages);
                // Upload Photos
                if ($request->hasFile('vendor_image')) {
                    $image_tmp = $request->file('vendor_image');
                    if ($image_tmp->isValid()) {
                        $extension = $image_tmp->getClientOriginalExtension();
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin/images/photos/' . $imageName;
                        Image::make($image_tmp)->save($imagePath);
                    }
                } else if (!empty($data['current_vendor_image'])) {
                    $imageName = $data['current_vendor_image'];
                } else {
                    $imageName = "";
                }
                // Update in Admin table
                Admin::where('id', Auth::guard('admin')->user()->id)->update(
                    [
                        'name' => $data['vendor_name'],
                        'mobile' => $data['vendor_mobile'],
                        'image' => $imageName
                    ]
                );
                // Update in vendors table
                Vendor::where(['id' => Auth::guard('admin')->user()->vendor_id])->update([
                    'name' => $data['vendor_name'],
                    'mobile' => $data['vendor_mobile'], 'address' => $data['vendor_address'],
                    'city' => $data['vendor_city'], 'state' => $data['vendor_state'], 'country' => $data['vendor_country'],
                    'pincode' => $data['vendor_pincode'],
                ]);
                return redirect()->back()->with(['success_message' => 'Vendor details updated successfully!']);
            }
            $vendorDetails = Vendor::where(['id' => Auth::guard('admin')->user()->vendor_id])->first();
        } else if ($slug == 'business') {
            Session::put('page', 'update_business_details');
            if ($request->isMethod('POST')) {
                $data = $request->all();
                $rules = [
                    'shop_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_mobile' => 'required|numeric',
                    'shop_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'address_proof' => 'required',
                    'address_proof_image' => 'image',
                ];
                $customMessages = [
                    'shop_name.required' => 'Name is required',
                    'shop_name.regex' => 'The name must be valid',
                    'shop_city.regex' => 'The City must be valid',
                    'shop_mobile.required' => 'Mobile is required',
                    'shop_mobile.numeric' => 'Valid Mobile is required',
                    'address_proof.required' => 'Address Proof  is required',
                    'address_proof_image.image' => 'Address Proof Image is required',
                ];
                $this->validate($request, $rules, $customMessages);
                // Upload Photos
                if ($request->hasFile('address_proof_image')) {
                    $image_tmp = $request->file('address_proof_image');
                    if ($image_tmp->isValid()) {
                        $extension = $image_tmp->getClientOriginalExtension();
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin/images/proofs/' . $imageName;
                        Image::make($image_tmp)->save($imagePath);
                    }
                } else if (!empty($data['current_address_proof_image'])) {
                    $imageName = $data['current_address_proof_image'];
                } else {
                    $imageName = "";
                }
                // Update in vendors_business_table_details table
                VendorsBusinessDetail::where(['vendor_id' => Auth::guard('admin')->user()->vendor_id])->update([
                    'shop_name' => $data['shop_name'],
                    'shop_mobile' => $data['shop_mobile'], 'shop_address' => $data['shop_address'],
                    'shop_city' => $data['shop_city'], 'shop_state' => $data['shop_state'], 'shop_country' => $data['shop_country'],
                    'shop_pincode' => $data['shop_pincode'], 'business_license_number' => $data['business_license_number'],
                    'gst_number' => $data['gst_number'], 'pan_number' => $data['pan_number'],
                    'address_proof' => $data['address_proof'], 'address_proof_image' => $imageName,

                ]);

                return redirect()->back()->with(['success_message' => 'Vendor details updated successfully!']);
            }
            $vendorDetails = VendorsBusinessDetail::where(['vendor_id' => Auth::guard('admin')->user()->vendor_id])->first();
        } else if ($slug == 'bank') {
            Session::put('page', 'update_bank_details');
            if ($request->isMethod('POST')) {
                $data = $request->all();
                $rules = [
                    'account_holder_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'bank_name' => 'required',
                    'account_number' => 'required|numeric',

                ];
                $customMessages = [
                    'account_holder_name.required' => 'Account name is required',
                    'account_holder_name.regex' => 'Account holder name must be valid',
                    'bank_name.required' => 'Bank Name is required',
                    'account_number.numeric' => 'Valid Account number',
                    'account_number.required' => 'Account Number is required',

                ];
                $this->validate($request, $rules, $customMessages);

                // Update in vendors_bank_table_details table
                VendorsBankDetail::where(['vendor_id' => Auth::guard('admin')->user()->vendor_id])->update([
                    'account_holder_name' => $data['account_holder_name'],
                    'bank_name' => $data['bank_name'], 'account_number' => $data['account_number'],

                ]);

                return redirect()->back()->with(['success_message' => 'Vendor details updated successfully!']);
            }
            $vendorDetails = VendorsBankDetail::where(['vendor_id' => Auth::guard('admin')->user()->vendor_id])->first();
        }
        return view('admin.settings.update_vendor_details', ['slug' => $slug, 'vendorDetails' => $vendorDetails]);
    }
    public function admins($type = null)
    {
        $admins = Admin::query();
        if (!empty($type)) {
            $admins->where('type', $type);
            $title = ucfirst($type) . "s";
            Session::put('page', 'view_' . strtolower($title));
        } else {
            $title = "All Admins/Subadmins/Vendors";
            Session::put('page', 'view_all');
        }
        $admins = $admins->get();
        return view('admin.admins.admins', ['admins' => $admins, 'title' => $title]);
    }
    public function viewVendorDetails($id)
    {
        $vendorDetails = Admin::with('vendorPersonal', 'vendorBusiness', 'vendorBank')->where('id', $id)->first();
        return view('admin.admins.view_vendor_details', ['vendorDetails' => $vendorDetails]);
    }
    public function updateAdminStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Admin::where(['id' => $data['adminId']])->update(['status' => $status]);
            return response()->json(['status' => $status, 'adminId' => $data['adminId']]);
        }
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
