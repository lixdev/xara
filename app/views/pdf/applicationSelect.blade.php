@extends('layouts.ports')
@section('content')

<div class="row">
	<div class="col-lg-12">
  <h3>Select Allowance</h3>

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

		 <form method="POST" action="{{URL::to('payrollReports/allowances')}}" accept-charset="UTF-8">
   
    <fieldset>

        <div class="form-group">
                        <label for="username">Period <span style="color:red">*</span></label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input required class="form-control datepicker2" readonly="readonly" placeholder="" type="text" name="period" id="period" value="{{{ Input::old('period') }}}">
                    </div>
       </div>

            <div class="form-group">
                        <label for="username">Select:</label>
                        <select name="allowance" class="form-control">
                            <option></option>
                            @foreach($allws as $allw)
                            <option value="{{$allw->id}}"> {{ $allw->allowance_name }}</option>
                            @endforeach

                        </select>
                
            </div>

                        <div class="checkbox">
                        <label>
                            <input type="checkbox" checked name="sel">
                              Select All
                        </label>
                    </div>
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Select</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>


@stop