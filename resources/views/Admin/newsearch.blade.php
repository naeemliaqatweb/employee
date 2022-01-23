@extends('layouts.admin')
@section('content')
<section id="basic-datatable">
<section id="basic-datatable">
<div class="row">
<div class="col-12">
<div class="card">
{{--  <div class="card-header">
<h4 class="card-title"> Employee Payroll
</h4>
</div>  --}}
<div class="card-header">
<h4 class="card-title"> Employee Payroll
</h4>
</div>
<div class="card-content">
<div class="card-body card-dashboard">
<div class="row">
<div class="col-md-6">
   <h3 class="box-title">Employee Payroll  </h3>
<hr>
<form  method="post" action="{{ url('admin/search') }}">
<form class="my-5" method="post" action="{{ url('admin/search') }}">
@csrf
<div class="form-group">
<label for="first-name-icon">Cycle</label>

<div class="position-relative has-icon-left">
<select class="form-control cycle" name="cycle" placeholder="Cycle" required>
<select class="form-control cycle" name="cycle" placeholder="Cycle">
<option value="">Select Cycle</option>

@foreach ($threshold as $list)
    <option value="{{ $list->days }}" cycle="{{ $list->days }}">
        {{ $list->cycle }}</option>
@endforeach

</select>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
{{-- <div class="row">
<div class="col-md-6"> --}}
<div class="form-group">
<label for="start_date">Duration</label>
<div class="position-relative has-icon-left">
    <input type="date" id="date-input" class="form-control"
        name="start_date" placeholder="start date"  value="{{ old('start_date') }}" required>
<label for="password-icon">Duration</label>
<div class="position-relative has-icon-left">
    <input type="date" id="date-input" class="form-control"
        name="start_date" placeholder="start date">
    <div class="form-control-position">
        <i class="feather icon-calendar "></i>
    </div>
</div>
</div>

{{--  <div class="form-group">
<label for="end_date">Duration</label>
<div class="position-relative has-icon-left">
    <input type="date" id="date-input" class="form-control"
        name="end_date" placeholder="start date" required>
    <div class="form-control-position">
        <i class="feather icon-calendar "></i>
    </div>
</div>
</div>  --}}
{{-- </div>
<div class="col-md-6">
<div class="form-group">
<label for="password-icon">End Date</label>
<div class="position-relative has-icon-left">
    <input type="date" id="password-icon" class="form-control"
        name="end_date" placeholder="End date">
    <div class="form-control-position">
        <i class="feather icon-calendar "></i>
    </div>
</div>
</div>
</div>
</div>--}}
<div class="form-group">
<label for="first-name-icon">Dept</label>

<div class="position-relative has-icon-left">
<select type="text" name="DEPARTMENT" list="Weekly" id="first-name-icon"
class="form-control"  placeholder="Dept" >
<option value="">Select Department</option>

@foreach ($department as $list)
    <option value="{{ $list->id }}">{{ $list->department }}
    </option>
@endforeach
</select>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>
<div class="form-group">
<label for="first-name-icon">Emp</label>

<div class="position-relative has-icon-left">
<select type="text" name="Employee" list="Emp" id="first-name-icon"
class="form-control"  placeholder="Emp">
<option value="">Select Employee</option>

@foreach ($users as $list)
    <option value="{{ $list->id }}">{{ $list->first_name }}
    </option>
@endforeach
</select>
<div class="form-control-position">
<i class="feather icon-user"></i>
</div>
</div>
</div>

<div class="btn-group pull-left">
<button type="reset" class="btn btn-warning pull-right">Reset</button>
</div>
<div class="btn-group pull-right">
<button type="submit" class="btn btn-success pull-right">Submit</button>
</div>


</form>
<br>
<div class="">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th scope="col">Employee Name</th>
<th scope="col">Hrs.</th>
<th scope="col">Processed</th>
<th scope="col">Action</th>
</tr>
</thead>
<tbody>


{{--  @php
for($i = 0; $i<count($userArray); $i+=1)
{
echo $userArray[$i];

}
@endphp  --}}


<?php
for($i = 0; $i<count($userArray)-1; $i+=1)

{ 
    ?>

<tr>

    <td scope="row">@php echo $userArray[$i+=1] @endphp</td>


 <td scope="row">@php
     $id = $userArray[$i-1];
    $basic = $userArray[$i+=1];
    $overTime = $userArray[$i+=1];
    $ip=intval($basic);

    $ip2 = intval($overTime);
        $bmin=gmdate("",$ip);

    $hoursBasictime=$ip/3600;

    $forBasicMin = floor($hoursBasictime);
    $mulBasic = $forBasicMin*3600;
    $totBasicMin = $ip-$mulBasic;
    $minBasic = $totBasicMin/60;


    $hoursOverTime = $ip2/3600;
    $basicOverMin = floor($hoursOverTime); //Total INT Hour divided *3600
    $totOverSec = $basicOverMin*3600;
    $totOverMinSec = $ip2-$totOverSec;
    $totOverTimeMin = $totOverMinSec/60;
$totalhours=$forBasicMin+$hoursOverTime;

    $tempTotMin = $minBasic + $totOverTimeMin;
    $TotMin = 0;
    if($tempTotMin>=59) {
        $TotMin = $tempTotMin-59;
        $totalhours+=1;
    }
    else {
        $TotMin = $tempTotMin;
    }
        $totalMinFinal = 0;
        if($checkcycle==14){
        if(floor($totalhours)>80) {
            $hoursOverTime =(floor($totalhours))-80;
            $minBasic = 0;
            $hoursBasictime = 80;
            $totOverTimeMin = floor($TotMin);

        }
        else {
            $hoursOverTime = 0;
            $totOverTimeMin = 0;
        }

        }

        $acc = App\Models\Accumulate::get('accumalative_payrol_value')->last()->toArray();
        $acc_val = $acc['accumalative_payrol_value'];

        $process_count = App\Models\Proceed::where("user_id",$id)->count();
        $process = App\Models\Proceed::select(DB::raw('SUM(total_pay) as total_pay ,SUM(nis) as nis_total '))
        ->where("user_id",'26')->get()->toarray();

        $check_status = App\Models\Proceed::where("user_id",$id)->where('start_date',$startdate)
        ->where('end_date',$end_date)->count();
        $tot_sal = 0;
        $tot_nis = 0;
        $income = 0;
        $inc_tax = 0;
        if($process_count==0) {
            $tot_sal = 0;
            $tot_nis = 0;
        }
        else {
            $tot_sal = $process[0]['total_pay'];
            $tot_nis = $process[0]['nis_total'];
        }

        if($tot_sal>$acc_val) {
            $income= ($tot_sal-$tot_nis-$acc_val);
            $inc_tax = ($income/100)*25;

        }




    @endphp
    <input type="hidden" value="{{ $inc_tax }}"  class="income_tax_hd" >
        {{floor($totalhours)  }}: {{ floor($TotMin) }}
    {{ floor($hoursBasictime) }} : {{ floor($minBasic) }}
     {{ "/" }} {{  floor($hoursOverTime) }} {{ floor($totOverTimeMin) }}</td>
        @if($check_status>0)

    <td><i class="fa fa-fw fa-check" style="color: green;"></i></td>
    @else
        <td><i class="fa fa-fw fa-remove" style="color: rgb(250, 21, 40);"></i></td>

    @endif
    <td><button class="btn btn-info senddata btn-sm" user_id={{ $id }} totalhours="{{ floor($totalhours)  }}"    totalm="{{ floor($TotMin) }}"
         hoursBasihourctime="{{ floor($hoursBasictime) }}"  minBasic="{{ floor($minBasic)}}"     hoursOverTime={{  floor($hoursOverTime) }}  totOverTimeMin="{{ floor($totOverTimeMin) }}"><i
                    class="fa fa-fw fa-eye"></i></button></td>


</tr>

@php  } @endphp

@foreach($user as  $value)


<tr>

    <th scope="row"> {{ $value->user->first_name ?? '' }}</th>
    @php $hours_get = App\Models\Attendence::where('user_id', $value->user_id)->sum('total_hours');

                $hours = gmdate('H:i', $hours_get);

                   $overtime= App\Models\Attendence::where('user_id',  $value->user_id)->sum(DB::raw("TIME_TO_SEC(overtime)"));
                @endphp
    <td>      {{  $hours }}</td>



    <td><i class="fa fa-fw fa-check" style="color: green;"></i></td>
    <td><button type="button" atten="{{ $value->user_id }}" total_hourse="{{ $hours_get }}"  overtime={{ $overtime }}
                class="btn btn-info btn-sm"><i
                    class="fa fa-fw fa-eye"></i></button></td></td>

</tr>
@endforeach


</tbody>
</table>
</div>

</div>
<div class="col-md-6">
<div class="">

<h3 class="box-title">Department &amp; Rate</h3>
<hr>
<div class="row">
<div class="col-md-3 col-sm-6 col-xs-6">Department: </div>
<div class="col-md-3 col-sm-6 col-xs-6"><strong class="department">Department Name</strong></div>
<div class="col-md-3 col-sm-6 col-xs-6">Regular Hours: </div>
<div class="col-md-3 col-sm-6 col-xs-6 regular_hours">0</div>
<div class="col-md-3 col-sm-6 col-xs-6">Overtime Rate: </div>
<div class="col-md-3 col-sm-6 col-xs-6 over_time_rate">$0</div>
<div class="col-md-3 col-sm-6 col-xs-6 ">Hourly Rate: </div>
<div class="col-md-3 col-sm-6 col-xs-6 hourly_rate">$0</div>
<div class="col-md-3 col-sm-6 col-xs-6">8.00</div>
<div class="col-md-3 col-sm-6 col-xs-6">Overtime Rate: </div>
<div class="col-md-3 col-sm-6 col-xs-6 overtimrate">$0</div>
<div class="col-md-3 col-sm-6 col-xs-6 ">Hourly Rate: </div>
<div class="col-md-3 col-sm-6 col-xs-6 hourly_rate">$400.00</div>
<div class="col-md-3 col-sm-6 col-xs-6">Bonus Rate: </div>
</div>

</div>
<div class="mt-4">

<h3 class="box-title">Pay Calculation</h3>
<hr>
<div class="row">
<div class="col-md-3 col-sm-6 col-xs-6">Employee: </div>
<div class="col-md-3 col-sm-6 col-xs-6"><strong class="first_name">Name</strong></div>
<div class="col-md-3 col-sm-6 col-xs-6">TRN: </div>
<div class="col-md-3 col-sm-6 col-xs-6 trn">0</div>
<div class="col-md-3 col-sm-6 col-xs-6">NIS: </div>
<div class="col-md-3 col-sm-6 col-xs-6 nis">0.00</div>
<br>

<div class="col-md-3 col-sm-6 col-xs-6">Work Hours: </div>
<div class="col-md-3 col-sm-6 col-xs-6 totalhors">0.00</div>

<div class="col-md-3 col-sm-6 col-xs-6">Reg Pay:</div>
<div class="col-md-3 col-sm-6 col-xs-6 totalbasichourspay">$0.00</div>
<div class="col-md-3 col-sm-6 col-xs-6 ">OT Pay:</div>
<div class="col-md-3 col-sm-6 col-xs-6 OTP">$0.00</div>
<div class="col-md-3 col-sm-6 col-xs-6">Bonus:</div>
<div class="col-md-3 col-sm-6 col-xs-6">$0.00</div>
<div class="col-md-3 col-sm-6 col-xs-6">Stat:</div>
</div>

</div>
<div class="box my-4">
<div class="box-body">
<h4>Payments</h4>
<div class="table-responsive no-padding">
<table class="table table-bordered" width="100%">
<tbody>
    <tr>
        <th>Description</th>
        <th>Hr/Day</th>
        <th>Rate</th>
        <th>Total</th>
    </tr>
    <tr>
        <th>Basic Pay</th>
        <td class="basichours">0.00</td>
        <td class="hourly_rate">$0.00</td>
        <td class="totalbasichourspay">$0.00</td>
    </tr>

    <tr>
        <th>Overtime</th>
        <td class="overtime">0.00</td>
        <td class="overtimrate">$0.00</td>
        <td class="totalovertime">$0.00</td>
    </tr>
    <tr>
        <th>Bonus</th>
        <td>Selected Duration</td>
        <td class="rate">$0.00</td>
        <td class="sumtotalbasicandovertinme">$0.00</td>
    </tr>
    <tr>
        <th colspan="3">Total</th>
        <td>$0.00</td>
    </tr>
</tbody>
</table>
</div>
<h4>Deductions</h4>
<div class="table-responsive no-padding">
<table class="table table-bordered" width="100%">
<tbody>
    <tr>
        <th colspan="2">Reason</th>
        <th>Amount</th>
    </tr>
    <tr>
        <th colspan="2">Total</th>
        <th>$0.00</th>
    </tr>
</tbody>
</table>
</div>
<h4>Net: $0.00</h4>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
        $('document').ready(function() {
            //alert();
        $('.btn-info').click(function() {
 var total_hourse=$(this).attr('total_hourse');

                     var atten_id=$(this).attr('atten');
                     var overtime=$(this).attr('overtime');


        //   alert(atten_id);
          $.ajax({
              url:"{{url('atten_get')}}",
              type:"get",
              data:{
                  "atten_id":atten_id,"total_hourse":total_hourse,"overtime":overtime
              },
              success: function (resutl) {
                $('.department').html(resutl.department);
                  $('.first_name').html(resutl.first_name);
                  $('.totalhors').html(resutl.totalhors);
                     $('.OTP').html('$'+resutl.orver_time_pay);
                    $('.hourly_rate').html('$'+resutl.hourly_rate);
                                $('.trn').html('$'+resutl.trn);
                                $('.nis').html(resutl.nis);

                    $('.basichours').html(resutl.basic_pay);

            $('.totalbasichours').html('$'+resutl.totalbasichours);
                        $('.overtime').html(resutl.overtime);

            $('.totalbasichourspay').html('$'+resutl.totalbasichourspay);
            $('.totalovertime').html('$'+resutl.totalovertime);
           var a= $('.overtimrate').html('$'+resutl.overtimrate);

            $('.sumtotalbasicandovertinme').html('$'+resutl.sumtotalbasicandovertinme);
            $('.rate').html('$'+resutl.rate);




              }
          });
         });
        });
        </script>
@endsection
