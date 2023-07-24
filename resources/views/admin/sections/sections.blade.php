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
