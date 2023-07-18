@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{$title}}</h4>

              <div class="table-responsive pt-3">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>
                        Admin ID
                      </th>
                      <th>
                        Name
                      </th>
                      <th>
                        Type
                      </th>
                      <th>
                        Mobile
                      </th>
                      <th>
                        Email
                      </th>
                      <th>
                        Image
                      </th>
                      <th>
                        Status
                      </th>
                      <th>
                        Actions
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($admins as $admin)
                    <tr>
                        <td>
                          {{$admin->id}}
                        </td>
                        <td>
                            {{$admin->name}}
                        </td>
                        <td>
                            {{$admin->type}}
                          {{-- <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          </div> --}}
                        </td>
                        <td>
                            {{$admin->mobile}}
                        </td>
                        <td>
                            {{$admin->email}}
                        </td>
                        <td>
                          <img src="{{asset('admin/images/photos/'.$admin->image)}}"/>
                          </td>
                          <td>
                            {{$admin->status ==1 ? "Active" : "Inactive"}}
                          </td>
                          <td>

                          </td>
                      </tr>
                    @endforeach


                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->



    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
@include('admin.layout.footer')

@endsection
