@extends('layouts.main')
@section('content')
<br/>
<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>
<div class="row">
	<div class="col-lg-12">


<a class="btn btn-info btn-sm "  href="{{ URL::to('NextOfKins/edit/'.$kin->id)}}">update details</a>

<hr>
</div>	
</div>


<div class="row">

<div class="col-lg-2">

<img src="{{asset('/public/uploads/employees/photo/'.$kin->employee->photo) }}" width="150px" height="130px" alt="{{asset('/public/uploads/employees/photo/default_photo.png') }}"><br>
<br>
<img src="{{asset('/public/uploads/employees/signature/'.$kin->employee->signature) }}" width="120px" height="50px" alt="{{asset('/public/uploads/employees/signature/sign_av.jpg') }}">
</div>

<div class="col-lg-6">

<table class="table table-bordered table-hover">
<tr><td colspan="2"><strong><span style="color:green">Next Of Kin Information</span></strong></td></tr>
      @if($kin->employee->middle_name != null || $kin->employee->middle_name != ' ')
      <tr><td><strong>Employee: </strong></td><td> {{$kin->employee->last_name.' '.$kin->employee->first_name.' '.$kin->employee->middle_name}}</td>
      @else
      <td><strong>Employee: </strong></td><td> {{$kin->employee->last_name.' '.$kin->employee->first_name}}</td>
      @endif
      </tr>
      <tr><td><strong>Kin: </strong></td><td>{{$kin->name}}</td></tr>
      <tr><td><strong>Relationship: </strong></td><td>{{$kin->relationship}}</td></tr>
      <tr><td><strong>Contact Info: </strong></td><td><pre>{{$kin->contact}}</pre></td></tr>
      <tr><td><strong>Kin ID Number: </strong></td><td>{{$kin->id_number}}</td></tr>
      <tr><td><strong>Goodwill: </strong></td><td>{{$kin->goodwill.'%'}}</td></tr>
</table>
</div>

</div>


	</div>


</div>


@stop