@extends('layouts.membercss')
@section('content')
<div class="row">
	<div class="col-lg-12">
 

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-5">

    
		
		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif

		 <form method="POST" action="{{{ URL::to('leaveapplications') }}}" accept-charset="UTF-8">
   
    <fieldset>

        <input type="hidden" name="employee_id" value="{{$employee->id}}">


        <div class="form-group">
            <label for="username">Leave type</label>
            <select class="form-control" name="leavetype_id">
            <option> select leave</option>
              @foreach($leavetypes as $leavetype)  
                    <option value="{{$leavetype->id}}">{{$leavetype->name}}</option>
              @endforeach
            </select>
        </div>


        <div class="form-group">
                        <label for="username">Start Date <span style="color:red">*</span></label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input required class="form-control datepicker21" readonly="readonly" placeholder="" type="text" name="applied_start_date" id="applied_start_date" value="">
                    </div>
       </div>



       <div class="form-group">
                        <label for="username">End Date <span style="color:red">*</span></label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input required class="form-control datepicker21" readonly="readonly" placeholder="" type="text" name="applied_end_date" id="applied_end_date" value="">
                    </div>
       </div>


        

      
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Submit Application</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>
@stop


