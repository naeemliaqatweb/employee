@extends('layouts.admin')
@section('content')

<?php
use Carbon\Carbon;
use App\Models\Attendence;


?>
 <section id="basic-datatable">
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Show All Attendance List</h4>
              </div>
              <div class="card-content">
                  <div class="card-body card-dashboard">
                      <p class="card-text">Attendance List</p>
                      <div class="table-responsive">
                          <table class="table zero-configuration">
                              <thead>
                                  <tr>
                                      <th>#id</th>
                                      <th>Employee Name</th>
                                      <th>In Time</th>
                                      <th>Out Time</th>
                                      <th>Work Time</th>
                                      <th>Basic Hours</th>
                                      <th>Over Time</th>
                                      <th>Action</th>

                                  </tr>
                              </thead>
                              <tbody>
                                @php
                                    $i=1;
                                    $user_name=Auth::user()->first_name;
                                @endphp
                                @foreach($emp_atten as $list)

                                  <tr>
                                      <td>{{$i++}}</td>
                                      <td>{{$list->first_name}}</td>
                                      <td>{{$list->date}} - {{$list->start_time}}</td>
                                        @if($list->end_time==0)

                                          <td>00:00:00</td>

                                      @else
                                                                            <td>{{$list->date}} - {{$list->end_time}}</td>

@endif
                                          <td>{{ $list->work_time}}</td>

 @if($list->status == 0)
 <td>08:00:00</td>
 @else
                                                                            <td>08:00:00 / {{  $list->work_time}}</td>
                        @endif

                                        <td>{{$list->overtime}}</td>
 @if($list->status == 0)
                                                                              <td><a class="btn btn-success" href="{{ route('admin.attent_status_approve', $list->id)}}" style="color: white;">Active</a></td>
 @else
                                                                              <td><a class="btn btn-info" href="{{ route('admin.attent_status_disapprove',$list->id) }}" style="color: white;">Inactive</a></td>
                                        @endif
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
</section>
</div>
@endsection
