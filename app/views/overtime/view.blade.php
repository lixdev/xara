@extends('layouts.payroll')
@section('content')
<br/>
<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>
<div class="row">
	<div class="col-lg-12">


<a class="btn btn-info btn-sm "  href="{{ URL::to('overtimes/edit/'.$overtime->id)}}">update details</a>

<hr>
</div>	
</div>


<div class="row">

<div class="col-lg-2">

<img src="{{asset('/public/uploads/employees/photo/'.$overtime->employee->photo) }}" width="150px" height="130px" alt=""><br>
<br>
<img src="{{asset('/public/uploads/employees/signature/'.$overtime->employee->signature) }}" width="120px" height="50px" alt="">
</div>

<div class="col-lg-6">

<table class="table table-bordered table-hover">
<tr><td colspan="2"><strong><span style="color:green">Overtime Information</span></strong></td></tr>
      @if($overtime->employee->middle_name != null || $overtime->employee->middle_name != ' ')
      <tr><td><strong>Employee: </strong></td><td> {{$overtime->employee->last_name.' '.$overtime->employee->first_name.' '.$overtime->employee->middle_name}}</td>
      @else
      <td><strong>Employee: </strong></td><td> {{$overtime->employee->last_name.' '.$overtime->employee->first_name}}</td>
      @endif
      </tr>
      <tr><td><strong>Type: </strong></td><td>{{$overtime->type}}</td></tr>
      <tr><td><strong>Pay Rate: </strong></td><td>{{$overtime->rate}}</td></tr>
      <tr><td><strong>Period Worked: </strong></td><td>{{$overtime->period}}</td></tr>
      <tr><td><strong>Amount: </strong></td><td align="right">{{asMoney($overtime->amount)}}</td></tr>
      <tr><td><strong>Total Amount: </strong></td><td align="right">{{asMoney((double)$overtime->amount*(double)$overtime->period)}}</td></tr>
</table>
</div>

</div>


	</div>


</div>


@stop