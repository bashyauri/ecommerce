@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Sections</h4>

              <div class="table-responsive pt-3">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>
                        ID
                      </th>
                      <th>
                        Name
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
                    @foreach ($sections as $section)
                    <tr>
                        <td>
                          {{$section->id}}
                        </td>
                        <td>
                            {{$section->name}}
                        </td>


                          <td>
                           @if ($section->status == 1)
                           <a class="updateSectionStatus" id ="section-{{$section->id}}" section_id="{{$section->id}}" href="javascript:void(0)">
                            <i style="font-size:25px;" class="mdi mdi-bookmark-check" status="Active"></i></a>
                           @else
                           <a class="updateSectionStatus" id ="section-{{$section->id}}" section_id="{{$section->id}}" href="javascript:void(0)">
                            <i style="font-size:25px;" class="mdi mdi-bookmark-outline" status="Inactive">

                           @endif

                          </td>
                          <td>

                           <a href="{{ url('admin/view-vendor-details/'.$section->id)}}">
                            <i style="font-size:25px;" class="mdi mdi-file-document"></i></a>

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
