@extends('layouts.payroll')
@section('content')
<br/>

<div class="row">
    <div class="col-lg-12">
  <h3>Update Employee Overtime</h3>

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

         <form method="POST" action="{{{ URL::to('overtimes/update/'.$overtime->id) }}}" accept-charset="UTF-8">
   
    <fieldset>

       <div class="form-group">
                        <label for="username">Employee <span style="color:red">*</span></label>
                        <input class="form-control" placeholder="" type="text" readonly name="employee" id="employee" value="{{$overtime->employee->first_name.' '.$overtime->employee->last_name}}">
                
                    </div>                    

                    <div class="form-group">
                        <label for="username">Type <span style="color:red">*</span></label>
                        <select name="type" class="form-control">
                            <option></option>
                            <option value="Hourly"<?= ($overtime->type=='Hourly')?'selected="selected"':''; ?>> Hourly</option>
                            <option value="Daily"<?= ($overtime->type=='Daily')?'selected="selected"':''; ?>> Daily</option>
                        </select>
                
                    </div>

                    <div class="form-group">
                        <label for="username">Rate <span style="color:red">*</span></label>
                        <select name="rate" class="form-control">
                            <option></option>
                            <option value="Normal"<?= ($overtime->rate=='Normal')?'selected="selected"':''; ?>> Normal</option>
                            <option value="Weekday"<?= ($overtime->rate=='Weekday')?'selected="selected"':''; ?>> Weekday</option>
                            <option value="Saturday"<?= ($overtime->rate=='Saturday')?'selected="selected"':''; ?>> Saturday</option>
                            <option value="Sunday"<?= ($overtime->rate=='Sunday')?'selected="selected"':''; ?>> Sunday</option>
                            <option value="Holiday"<?= ($overtime->rate=='Holiday')?'selected="selected"':''; ?>> Holiday</option>
                        </select>
                
                    </div>

        <div class="form-group">
            <label for="username">Amount <span style="color:red">*</span> </label>
            <input class="form-control" placeholder="" type="text" name="amount" id="amount" value="{{$overtime->amount}}">
        </div>
        
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Update Overtime</button>
        </div>

    </fieldset>
</form>
        

  </div>

</div>

@stop