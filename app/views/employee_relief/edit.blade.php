@extends('layouts.payroll')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Update Employee Relief</h3>

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

		 <form method="POST" action="{{{ URL::to('employee_relief/update/'.$rel->id) }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
                        <div class="form-group">
            <label for="username">Employee</label>
            <input class="form-control" placeholder="" type="text" readonly name="employee" id="employee" value="{{ $rel->employee->first_name.' '.$rel->employee->last_name }}">
        </div> 
                
                    </div>


        <div class="form-group">
         <label for="username">Relief Type <span style="color:red">*</span></label>
                        <select name="relief" class="form-control">
                           <option></option>
                            @foreach($reliefs as $relief)
                            <option value="{{ $relief->id }}"<?= ($rel->relief_id==$relief->id)?'selected="selected"':''; ?>> {{ $relief->relief_name }}</option>
                            @endforeach
                        </select>
                
        </div>          


        <div class="form-group">
            <label for="username">Amount <span style="color:red">*</span></label>
            <input class="form-control" placeholder="" type="text" name="amount" id="amount" value="{{ $rel->relief_amount}}">
            <script type="text/javascript">
           $(document).ready(function() {
           $('#amount').priceFormat();
           });
           </script>  
        </div>

        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Update Employee Relief</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>


@stop