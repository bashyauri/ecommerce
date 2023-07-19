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
                    <input type="text" name="vendor_name" value="{{$vendorDetails->vendorPersonal->email}}" class="form-control"  readonly>
                  </div>
                <div class="form-group">
                    <label for="vendor_address">Address</label>
                    <input type="text" name="vendor_address" value="{{$vendorDetails->vendorPersonal->email}}" class="form-control"  readonly>
                </div>
                <div class="form-group">
                <label for="vendor_city">City</label>
                <input type="text" name="vendor_city" value="{{$vendorDetails->vendorPersonal->email}}" class="form-control"  readonly>
                </div>
                <div class="form-group">
                    <label for="vendor_state">State</label>
                    <input type="text" name="vendor_state" value="{{$vendorDetails->state}}" class="form-control" readonly>
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


    </div>


    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin.layout.footer')
    <!-- partial -->
  </div>
  @endsection
