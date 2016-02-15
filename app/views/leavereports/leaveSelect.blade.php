@extends('layouts.leave')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Select Period</h3>

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

		 <form method="POST" action="{{URL::to('leaveReports/Employeesonleave')}}" accept-charset="UTF-8">
   
    <fieldset>

        <div class="form-group">
                        <label for="username">Leave Type:</label>
                        <select name="balance" class="form-control">
                            <option></option>
                            @foreach($leaves as $leave)
                            <option value="{{$leave->id}}"> {{ $leave->name }}</option>
                            @endforeach

                        </select>
                
            </div>

                        
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Select</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>


@stop