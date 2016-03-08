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

  @if (Session::has('flash_message'))

      <div class="alert alert-success">
      {{ Session::get('flash_message') }}
     </div>
    @endif

     @if (Session::has('delete_message'))

      <div class="alert alert-danger">
      {{ Session::get('delete_message') }}
     </div>
    @endif


<a class="btn btn-info btn-sm "  href="{{ URL::to('occurences/edit/'.$occurence->id)}}">update details</a>
<a class="btn btn-danger btn-sm " href="{{URL::to('occurences/delete/'.$occurence->id)}}" onclick="return (confirm('Are you sure you want to delete this employee`s occurence?'))">Delete</a>
<a class="btn btn-success btn-sm "  href="{{ URL::to('employees/view/'.$occurence->employee->id)}}">Go Back</a>

<hr>
</div>	
</div>


<div class="row">

<div class="col-lg-2">

<img src="{{asset('/public/uploads/employees/photo/'.$occurence->employee->photo) }}" width="150px" height="130px" alt="{{asset('/public/uploads/employees/photo/default_photo.png') }}"><br>
<br>
<img src="{{asset('/public/uploads/employees/signature/'.$occurence->employee->signature) }}" width="120px" height="50px" alt="{{asset('/public/uploads/employees/signature/sign_av.jpg') }}">
</div>

<div class="col-lg-6">

<table class="table table-bordered table-hover">
<tr><td colspan="2"><strong><span style="color:green">Occurence Information</span></strong></td></tr>
      @if($occurence->employee->middle_name != null || $occurence->employee->middle_name != ' ')
      <tr><td><strong>Employee: </strong></td><td> {{$occurence->employee->last_name.' '.$occurence->employee->first_name.' '.$occurence->employee->middle_name}}</td>
      @else
      <td><strong>Employee: </strong></td><td> {{$occurence->employee->last_name.' '.$occurence->employee->first_name}}</td>
      @endif
      </tr>
      <tr><td><strong>Occurence Brief: </strong></td><td>{{$occurence->occurence_brief}}</td></tr>
      <tr><td><strong>Occurence Type: </strong></td><td>{{$occurence->occurence_type}}</td></tr>
      <tr><td><strong>Narrative: </strong></td><td>{{$occurence->narrative}}</td></tr>
      <?php
       $d=strtotime($occurence->occurence_date);
      ?>
      <tr><td><strong>Date: </strong></td><td>{{date("F j, Y", $d)}}</td></tr>
      
</table>
</div>

</div>


	</div>


</div>


@stop