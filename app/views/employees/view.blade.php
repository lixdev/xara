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


<a class="btn btn-info btn-sm "  href="{{ URL::to('employees/edit/'.$employee->id)}}">update details</a>

<hr>
</div>	
</div>


<div class="row">

<div class="col-lg-2">

<img src="{{asset('/public/uploads/employees/photo/'.$employee->photo) }}" width="150px" height="130px" alt="{{asset('/public/uploads/employees/photo/default_photo.png') }}"><br>
<br>
<img src="{{asset('/public/uploads/employees/signature/'.$employee->signature) }}" width="120px" height="50px" alt="{{asset('/public/uploads/employees/signature/sign_av.jpg') }}">
</div>

<div class="col-lg-4">

<table class="table table-bordered table-hover">
<tr><td colspan="2"><strong><span style="color:green">Personal Information</span></strong></td></tr>
	 <tr><td><strong>Payroll Number: </strong></td><td>{{$employee->personal_file_number}}</td></tr>
      @if($employee->middle_name != null || $employee->middle_name != ' ')
      <tr><td><strong>Employee Name: </strong></td><td> {{$employee->last_name.' '.$employee->first_name.' '.$employee->middle_name}}</td>
      @else
      <td><strong>Employee Name: </strong></td><td> {{$employee->last_name.' '.$employee->first_name}}</td>
      @endif
      </tr>
      <tr><td><strong>Identity Number: </strong></td><td>{{$employee->identity_number}}</td></tr>
     <tr><td><strong>Gender:</strong></td>
        @if($employee->gender != null)
        <td>{{$employee->gender}}</td>
        @else
        <td></td>
        @endif
        </tr>
        <tr><td><strong>Marital Status:</strong></td>
        @if($employee->marital_status != null)
        <td>{{$employee->marital_status}}</td>
        @else
        <td></td>
        @endif
        </tr>
        <tr><td><strong>Date of Birth:</strong></td>
        @if($employee->yob != null)
        <td>{{$employee->yob}}</td>
        @else
        <td></td>
        @endif
        </tr>
        <tr><td><strong>Citizenship:</strong></td>
        @if($employee->citizenship != null)
        <td>{{$employee->citizenship}}</td>
        @else
        <td></td>
        @endif
        </tr>
      <tr><td><strong>Education:</strong></td>
        @if($employee->education_type_id != 0)
        <td><?php 
            $education = DB::table('education')->where('id', '=', $employee->education_type_id)->pluck('education_name');            
            ?>

            {{ $education}}</td>
        @else
        <td></td>
        @endif
        </tr>
</table>
</div>



<div class="col-lg-4">

<table class="table table-bordered table-hover">
<tr><td colspan="2"><strong><span style="color:green">Company Information</span></strong></td></tr>

<tr><td><strong>Branch: </strong></td> 
        @if($employee->branch_id != 0)
        <td> {{ $employee->branch->name}}</td>
        @else
        <td></td>
        @endif
        </tr>
        <tr><td><strong>Department: </strong></td>
        @if($employee->department_id != 0)
        <td> {{ $employee->department->department_name}}</td>
        @else
        <td></td>
        @endif
        </tr>

 <tr><td><strong>Job Group: </strong></td>
        @if($employee->job_group_id != 0)
        <td>
            <?php 
            $jgroup = DB::table('job_group')->where('id', '=', $employee->job_group_id)->pluck('job_group_name');            
            ?>

            {{ $jgroup}}</td>
        @else
        <td></td>
        @endif
        </tr>
        <tr><td><strong>Employee Type: </strong></td>
        @if($employee->type_id != 0)
        <td>
            <?php 
            $etype = DB::table('employee_type')->where('id', '=', $employee->type_id)->pluck('employee_type_name');            
            ?>

            {{ $etype}}</td>
        @else
        <td></td>
        @endif
        </tr>
        
        <tr><td><strong>Work Permit: </strong></td>
        @if($employee->work_permit_number != null)
        <td>{{$employee->work_permit_number}}</td>
        @else
        <td></td>
        @endif
        </tr>
        <tr><td><strong>Job Title: </strong></td>
        @if($employee->job_title != null)
        <td>{{$employee->job_title}}</td>
        @else
        <td></td>
        @endif
        </tr>

        <tr><td><strong>Basic Salary: </strong></td>
        <td align="right">{{asMoney((double)$employee->basic_pay)}}</td>
        </tr>
        
        <tr><td><strong>Date Joined:</strong></td>
        @if($employee->date_joined != null)
        <td>{{$employee->date_joined}}</td>
        @else
        <td></td>
        @endif
        </tr>

</table>


</div>
</div>
<div class="row">

<div class="col-lg-4" style="margin-left:170px;">
    <table class="table table-bordered table-hover">
<tr><td colspan="2"><strong><span style="color:green">Goverment Requirements</span></strong></td></tr>
     <tr><td><strong>Kra Pin: </strong></td>
        @if($employee->pin != null)
        <td>{{$employee->pin}}</td>
        @else
        <td></td>
        @endif
        </tr>
        <tr><td><strong>Nssf Number: </strong></td>
        @if($employee->social_security_number != null)
        <td>{{$employee->social_security_number}}</td>
        @else
        <td></td>
        @endif
        </tr>
        <tr><td><strong>Nhif Number: </strong></td>
        @if($employee->hospital_insurance_number != null)
        <td>{{$employee->hospital_insurance_number}}</td>
        @else
        <td></td>
        @endif
        </tr>
      </table>
    </div>

  <div class="col-lg-4" >
    <table class="table table-bordered table-hover">
      <tr><td colspan="2"><strong><span style="color:green">Bank Information</span></strong></td></tr>
<tr><td><strong>Employee Bank: </strong></td>
        @if($employee->bank_id != 0)
        <td>
            <?php 
            $bank = DB::table('banks')->where('id', '=', $employee->bank_id)->pluck('bank_name');            
            ?>

            {{ $bank}}</td>
        @else
        <td></td>
        @endif
        </tr>
 
        <tr><td><strong>Bank Branch: </strong></td>
        @if($employee->bank_id != 0)
        <td>
            <?php 
            $bbranch = DB::table('bank_branches')->where('id', '=', $employee->bank_branch_id)->pluck('bank_branch_name');            
            ?>

            {{ $bbranch}}</td>
        @else
        <td></td>
        @endif
        </tr>
        <tr><td><strong>Bank Account Number:</strong></td>
        @if($employee->bank_account_number != null)
        <td>{{$employee->bank_account_number}}</td>
        @else
        <td></td>
        @endif
        </tr>
        <tr><td><strong>Bank EFT Code:</strong></td>
        @if($employee->bank_eft_code != null)
        <td>{{$employee->bank_eft_code}}</td>
        @else
        <td></td>
        @endif
        </tr>
        <tr><td><strong>Swift Code:</strong></td>
        @if($employee->swift_code != null)
        <td>{{$employee->swift_code}}</td>
        @else
        <td></td>
        @endif
        </tr>

</table>
</div>
</div>
<div class="row">
 <div class="col-lg-4" style="margin-left:170px;">
<table class="table table-bordered table-hover">
 <tr><td colspan="2"><strong><span style="color:green">Contact Information</span></strong></td></tr>
 <tr><td><strong>Office Email:</strong></td>
        @if($employee->email_office != null)
        <td>{{$employee->email_office}}</td>
        @else
        <td></td>
        @endif
        </tr>
<tr><td><strong>Personal Email:</strong></td>
        @if($employee->email_personal != null)
        <td>{{$employee->email_personal}}</td>
        @else
        <td></td>
        @endif
        </tr>
        <tr><td><strong>Mobile Phone:</strong></td>
        @if($employee->telephone_mobile != null)
        <td>{{$employee->telephone_mobile}}</td>
        @else
        <td></td>
        @endif
        </tr>
        <tr><td><strong>Postal Address:</strong></td>
        @if($employee->postal_address != null)
        <td>{{$employee->postal_address}}</td>
        @else
        <td></td>
        @endif
        </tr>
        <tr><td><strong>Postal Zip:</strong></td>
        @if($employee->postal_zip != null)
        <td>{{$employee->postal_zip}}</td>
        @else
        <td></td>
        @endif
        </tr>
</table>
</div>

<div class="col-lg-4">
<table class="table table-bordered table-hover">
 <tr><td colspan="2"><strong><span style="color:green">Other Information</span></strong></td></tr>
 <tr><td><strong>Apply Tax:</strong></td>
        @if($employee->income_tax_applicable != null)
        <td>Yes</td>
        @else
        <td></td>
        @endif
        </tr>
        <tr><td><strong>Apply Tax Relief:</strong></td>
        @if($employee->income_tax_relief_applicable != null)
        <td>Yes</td>
        @else
        <td>No</td>
        @endif
        </tr>
        <tr><td><strong>Apply Nssf:</strong></td>
        @if($employee->hospital_insurance_applicable != null)
        <td>Yes</td>
        @else
        <td>No</td>
        @endif
        </tr>
        <tr><td><strong>Apply Nhif:</strong></td>
        @if($employee->social_security_applicable != null)
        <td>Yes</td>
        @else
        <td>No</td>
        @endif
        </tr>
        
</table>
</div>

</div>


	</div>


</div>


@stop