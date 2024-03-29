@extends('admin.layout.layout')
@section('content')


<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
              <h3 class="font-weight-bold">Vendor Details</h3>
              <h6 class="font-weight-bold"><a href="{{url('admin/admins/vendor')}}">Back to Vendors</a></h6>
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

      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Vendor Personal Information</h4>

                <div class="form-group">
                  <label >Email</label>
                  <input  class="form-control" value="{{$vendorDetails->vendorPersonal->email}}" readonly>
                </div>
                <div class="form-group">
                    <label for="vendor_name">Name</label>
                    <input type="text" name="vendor_name" value="{{$vendorDetails->vendorPersonal->name}}" class="form-control"  readonly>
                  </div>
                <div class="form-group">
                    <label for="vendor_address">Address</label>
                    <input type="text" name="vendor_address" value="{{$vendorDetails->vendorPersonal->address}}" class="form-control"  readonly>
                </div>
                <div class="form-group">
                <label for="vendor_city">City</label>
                <input type="text" name="vendor_city" value="{{$vendorDetails->vendorPersonal->city}}" class="form-control"  readonly>
                </div>
                <div class="form-group">
                    <label for="vendor_state">State</label>
                    <input type="text" name="vendor_state" value="{{$vendorDetails->vendorPersonal->state}}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="vendor_country">Country</label>
                    <input type="text" name="vendor_country" value="{{$vendorDetails->vendorPersonal->country}}" class="form-control" id="vendor_country" placeholder="Enter Country" readonly>
                </div>
                <div class="form-group">
                    <label for="vendor_pincode">PinCode</label>
                    <input type="text" name="vendor_pincode" value="{{$vendorDetails->vendorPersonal->pincode}}" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="vendor_mobile">Mobile</label>
                  <input type="text" name="vendor_mobile" value="{{$vendorDetails->vendorPersonal->mobile}}" class="form-control"
                   readonly>
                </div>
                @if (!empty($vendorDetails->image))
                <div class="form-group">
                    <label for="vendor_image">Photo</label>
                    <br>
                     <img style="width:200px;" src="{{url('admin/images/photos/'.$vendorDetails->image)}}" >



                  </div>
                  @endif

              </form>
            </div>
          </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Business Information</h4>


                  <div class="form-group">
                      <label for="vendor_name">Shop Name</label>
                      <input type="text" name="vendor_name" value="{{$vendorDetails->vendorBusiness->shop_name}}" class="form-control"  readonly>
                    </div>
                  <div class="form-group">
                      <label for="vendor_address">Shop Address</label>
                      <input type="text" name="vendor_address" value="{{$vendorDetails->vendorBusiness->shop_address}}" class="form-control"  readonly>
                  </div>
                  <div class="form-group">
                  <label for="vendor_city">Shop City</label>
                  <input type="text" name="vendor_city" value="{{$vendorDetails->vendorBusiness->shop_city}}" class="form-control"  readonly>
                  </div>
                  <div class="form-group">
                      <label for="vendor_state">Shop State</label>
                      <input type="text" name="vendor_state" value="{{$vendorDetails->vendorBusiness->shop_state}}" class="form-control" readonly>
                  </div>
                  <div class="form-group">
                      <label for="vendor_country">Shop Country</label>
                      <input type="text" name="vendor_country" value="{{$vendorDetails->vendorBusiness->shop_country}}" class="form-control" id="vendor_country" placeholder="Enter Country" readonly>
                  </div>
                  <div class="form-group">
                      <label for="vendor_pincode">Shop PinCode</label>
                      <input type="text" name="vendor_pincode" value="{{$vendorDetails->vendorBusiness->shop_pincode}}" class="form-control" readonly>
                  </div>
                  <div class="form-group">
                    <label for="vendor_mobile">Shop Mobile</label>
                    <input type="text" name="vendor_mobile" value="{{$vendorDetails->vendorBusiness->shop_mobile}}" class="form-control"
                     readonly>
                  </div>
                  <div class="form-group">
                    <label >Shop Website</label>
                    <input  class="form-control" value="{{$vendorDetails->vendorBusiness->shop_website}}" readonly>
                  </div>
                  <div class="form-group">
                    <label >Shop Email</label>
                    <input  class="form-control" value="{{$vendorDetails->vendorBusiness->shop_email}}" readonly>
                  </div>
                  <div class="form-group">
                    <label >Address Proof</label>
                    <input  class="form-control" value="{{$vendorDetails->vendorBusiness->address_proof}}" readonly>
                  </div>
                  @if (!empty($vendorDetails->vendorBusiness->address_proof_image))
                  <div class="form-group">
                      <label for="vendor_image">Photo</label>
                      <br>
                       <img style="width:200px;" src="{{url('admin/images/proofs/'.$vendorDetails->vendorBusiness->address_proof_image)}}" >

                    </div>

                    @endif
                    <div class="form-group">
                    <label >Business License Number</label>
                    <input  class="form-control" value="{{$vendorDetails->vendorBusiness->business_license_number}}" readonly>
                  </div>
                   <div class="form-group">
                    <label >Gst Number</label>
                    <input  class="form-control" value="{{$vendorDetails->vendorBusiness->gst_number}}" readonly>
                  </div>
                  <div class="form-group">
                    <label >Pan Number</label>
                    <input  class="form-control" value="{{$vendorDetails->vendorBusiness->pan_number}}" readonly>
                  </div>

                </form>
              </div>
            </div>
          </div>


    </div>
    <div class="row">
    <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Bank Information</h4>

                <div class="form-group">
                  <label >Account holder name</label>
                  <input  class="form-control" value="{{$vendorDetails->vendorBank->account_holder_name}}" readonly>
                </div>
                <div class="form-group">
                    <label for="vendor_name">Bank Name</label>
                    <input type="text"  value="{{$vendorDetails->vendorBank->bank_name}}" class="form-control"  readonly>
                  </div>
                <div class="form-group">
                    <label for="vendor_address">Account Number</label>
                    <input type="text" value="{{$vendorDetails->vendorBank->account_number}}" class="form-control"  readonly>
                </div>





            </div>
          </div>
        </div>
    </div>


    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin.layout.footer')
    <!-- partial -->
  </div>
  @endsection
