@extends('layouts.system')
@section('content')
<br/><br/><br/><br/>

<div class="row">
	<div class="col-lg-1">



</div>	

<div class="col-lg-3">

<img src="{{asset('public/uploads/logo/'.$organization->logo)}}" alt="logo" width="100%">

</div>	


<div class="col-lg-5 ">

	<table class="table table-bordered table-condensed">

												  				<tr>

																	<td>System</td><td>XARA FINANCIALS</td>
																</tr>
																<tr>

																	<td>Version</td><td>v3.1.10</td>
																</tr>

																<tr>

																	<td>Licensed To</td><td>{{$organization->name}}</td>
																</tr>
																<!-- <tr>

																	<td>License Type</td><td>{{$organization->license_type}}</td>
																</tr>

																<tr>
																	<td>Licensed</td><td>{{$organization->licensed.' Members'}}</td>

																</tr>
																
																<tr>
																	<td>License Code</td><td>{{$organization->license_code}}</td>
																</tr>
																
																<tr>
																	<td>License Key</td><td>{{$organization->license_key}}</td>

																</tr>
																 -->

															</table>



</div>	



</div>


@stop