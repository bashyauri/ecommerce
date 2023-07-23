@extends('admin.layout.layout')
@section('content')


<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
              <h3 class="font-weight-bold">Update Vendor Details</h3>
            </div>
            <div class="col-12 col-xl-4">
             <div class="justify-content-end d-flex">
              <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                 <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                  <a class="dropdown-item" href="#">January - March</a>
                  <a class="dropdown-item" href="#">March - June</a>
                  <a class="dropdown-item" href="#">June - August</a>
                  <a class="dropdown-item" href="#">August - November</a>
                </div>
              </div>
             </div>
            </div>
          </div>
        </div>
      </div>
      @if($slug == 'personal')
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Vendor Personal Information</h4>
              @if(Session::has('error_message'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error</strong> {{Session::get('error_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
              @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success</strong> {{Session::get('success_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif

              @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>

        </div>
        @endif
            <form class="forms-sample" action = "{{url('admin/update-vendor-details/personal')}}" method = "POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label >Vendor Username/Email</label>
                  <input  class="form-control" value="{{Auth::guard('admin')->user()->email}}" readonly>
                </div>
                <div class="form-group">
                    <label for="vendor_name">Name</label>
                    <input type="text" name="vendor_name" value="{{Auth::guard('admin')->user()->name}}" class="form-control" id="admin_name" placeholder="Vendor Name" required>
                  </div>
                <div class="form-group">
                    <label for="vendor_address">Address</label>
                    <input type="text" name="vendor_address" value="{{$vendorDetails->address}}" class="form-control" id="vendor_address" placeholder="Enter Address" required>
                </div>
                <div class="form-group">
                <label for="vendor_city">City</label>
                <input type="text" name="vendor_city" value="{{$vendorDetails->city}}" class="form-control" id="vendor_city" placeholder="Enter City" required>
                </div>
                <div class="form-group">
                    <label for="vendor_state">State</label>
                    <input type="text" name="vendor_state" value="{{$vendorDetails->state}}" class="form-control" id="vendor_state" placeholder="Enter State" required>
                </div>
                <div class="form-group">
                    {{-- <label for="vendor_country">Country</label>
                    <input type="text" name="vendor_country" value="{{$vendorDetails->country}}" class="form-control" id="vendor_country" placeholder="Enter Country" required> --}}
                    <select class = "form-control" name="vendor_country" id="vendor_country">
                        <option value="">Select Country</option>
                        @foreach ($countries as $country)
                        <option value="{{$country->country_name}}" @if ($country->country_name == $vendorDetails->country)
                            @selected(true)

                        @endif>{{$country->country_name}}</option>

                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label for="vendor_pincode">PinCode</label>
                    <input type="text" name="vendor_pincode" value="{{$vendorDetails->pincode}}" class="form-control" id="vendor_pincode" placeholder="Enter State" required>
                </div>
                <div class="form-group">
                  <label for="vendor_mobile">Mobile</label>
                  <input type="text" name="vendor_mobile" value="{{$vendorDetails->mobile}}" class="form-control"
                   id="vendor_mobile" placeholder="Enter 11 digit number" maxlength="11" minlength="11" required>
                </div>
                <div class="form-group">
                    <label for="vendor_image">Photo</label>
                    <input type="file" name="vendor_image" class="form-control"
                     id="vendor_image">
                     @if (!empty(Auth::guard('admin')->user()->image))
                     <a  target="_blank" href="{{url('admin/images/photos/'.Auth::guard('admin')->user()->image)}}" >View Image</a>
                     <input type="hidden" name="current_vendor_image" value="{{Auth::guard('admin')->user()->image}}">

                     @endif
                  </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
              </form>
            </div>
          </div>
        </div>
        @elseif($slug == 'business')
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Vendor Business Information</h4>
                  @if(Session::has('error_message'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error</strong> {{Session::get('error_message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif
                  @if(Session::has('success_message'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success</strong> {{Session::get('success_message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif

                  @if ($errors->any())
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>

            </div>
            @endif
                <form class="forms-sample" action = "{{url('admin/update-vendor-details/business')}}" method = "POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label >Vendor Username/Email</label>
                      <input  class="form-control" value="{{Auth::guard('admin')->user()->email}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="shop_name">Shop Name</label>
                        <input type="text" name="shop_name" value="{{$vendorDetails->shop_name}}" class="form-control" id="shop_name" placeholder="Shop Name" required>
                      </div>
                    <div class="form-group">
                        <label for="shop_address">Shop Address</label>
                        <input type="text" name="shop_address" value="{{$vendorDetails->shop_address}}" class="form-control" id="shop_address" placeholder="Enter Shop Address" required>
                    </div>
                    <div class="form-group">
                    <label for="shop_city">Shop City</label>
                    <input type="text" name="shop_city" value="{{$vendorDetails->shop_city}}" class="form-control" id="shop_city" placeholder="Enter Shop City" required>
                    </div>
                    <div class="form-group">
                        <label for="shop_state">Shop State</label>
                        <input type="text" name="shop_state" value="{{$vendorDetails->shop_state}}" class="form-control" id="shop_state" placeholder="Enter Shop State" required>
                    </div>
                    <div class="form-group">
                        <label for="shop_country">Shop Country</label>
                        <input type="text" name="shop_country" value="{{$vendorDetails->shop_country}}" class="form-control" id="shop_country" placeholder="Enter Shop Country" required>
                    </div>
                    <div class="form-group">
                        <label for="shop_pincode">Shop PinCode</label>
                        <input type="text" name="shop_pincode" value="{{$vendorDetails->shop_pincode}}" class="form-control" id="shop_pincode" placeholder="Enter Shop Pincode" required>
                    </div>
                    <div class="form-group">
                      <label for="shop_mobile">Shop Mobile</label>
                      <input type="text" name="shop_mobile" value="{{$vendorDetails->shop_mobile}}" class="form-control"
                       id="shop_mobile" placeholder="Enter 11 digit Shop number" maxlength="11" minlength="11" required>
                    </div>
                    <div class="form-group">
                        <label for="business_license_number">Business License Number</label>
                        <input type="text" name="business_license_number" value="{{$vendorDetails->business_license_number}}" class="form-control"
                         id="business_license_number" placeholder="Enter Business License Number">
                      </div>
                      <div class="form-group">
                        <label for="gst_number">GST Number</label>
                        <input type="text" name="gst_number" value="{{$vendorDetails->gst_number}}" class="form-control"
                         id="gst_number" placeholder="Enter GST Number"  required>
                      </div>
                      <div class="form-group">
                        <label for="pan_number">PAN Number</label>
                        <input type="text" name="pan_number" value="{{$vendorDetails->pan_number}}" class="form-control"
                         id="gst_number" placeholder="Enter PAN Number"  required>
                      </div>
                    <div class="form-group">
                      <label for="address_proof">Address Proof</label>
                      <select class="form-control" name="address_proof" id="address_proof">
                        <option value="Passport" @if ($vendorDetails->address_proof == "Passport") selected @endif>Passport</option>
                        <option value="Voting Card" @if ($vendorDetails->address_proof == "Voting Card") selected @endif>Voting Card</option>
                        <option value="Pan" @if ($vendorDetails->address_proof == "Pan") selected @endif>Pan</option>
                        <option value="Driving License" @if ($vendorDetails->address_proof == "Driving License") selected @endif>Driving License</option>
                      </select>

                    </div>
                    <div class="form-group">
                        <label for="address_proof_image">Address Proof Image</label>
                        <input type="file" name="address_proof_image" class="form-control"
                         id="address_proof_image">
                         @if (!empty($vendorDetails->address_proof_image))
                         <a  target="_blank" href="{{url('admin/images/proofs/'.$vendorDetails->address_proof_image)}}" >View Image</a>
                         <input type="hidden" name="current_address_proof_image" value="{{$vendorDetails->address_proof_image}}">

                         @endif
                      </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>

        @elseif($slug == 'bank')
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Bank Information</h4>
                  @if(Session::has('error_message'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error</strong> {{Session::get('error_message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif
                  @if(Session::has('success_message'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success</strong> {{Session::get('success_message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif

                  @if ($errors->any())
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>

            </div>
            @endif
                <form class="forms-sample" action = "{{url('admin/update-vendor-details/bank')}}" method = "POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label >Vendor Username/Email</label>
                      <input  class="form-control" value="{{Auth::guard('admin')->user()->email}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="account_holder_name">Account Holder Name</label>
                        <input type="text" name="account_holder_name" value="{{$vendorDetails->account_holder_name}}" class="form-control" id="account_holder_name" placeholder="Account Holder name" required>
                      </div>
                    <div class="form-group">
                        <label for="shop_address">Bank Name</label>
                        <input type="text" name="bank_name" value="{{$vendorDetails->bank_name}}" class="form-control" id="bank_name" placeholder="Enter Bank Name" required>
                    </div>
                    <div class="form-group">
                    <label for="shop_city">Account Number</label>
                    <input type="text" name="account_number" value="{{$vendorDetails->account_number}}" class="form-control" id="account_number" placeholder="Enter Account Number" required>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
        @endif

    </div>


    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin.layout.footer')
    <!-- partial -->
  </div>
  @endsection
