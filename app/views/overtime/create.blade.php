@extends('layouts.payroll')

<script type="text/javascript">
 function totalBalance() {
      var p = document.getElementById("period").value;
      var amt = document.getElementById("amount").value.replace(/,/g,'');
      var total = p * amt * 10;
      total=total.toLocaleString('en-US',{minimumFractionDigits: 2});
      document.getElementById("total").value = total;

}

function totalB() {
      var p = document.getElementById("period").value;
      var amt = document.getElementById("amount").value.replace(/,/g,'');
      var total = p * amt ;
      total=total.toLocaleString('en-US',{minimumFractionDigits: 2});
      document.getElementById("total").value = total;

}

</script>

@section('content')
<br/>

<div class="row">
    <div class="col-lg-12">
  <h3>New Employee Overtime</h3>

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

         <form method="POST" action="{{{ URL::to('overtimes') }}}" accept-charset="UTF-8">
   
    <fieldset>

       <div class="form-group">
                        <label for="username">Employee <span style="color:red">*</span></label>
                        <select name="employee" class="form-control">
                           <option></option>
                            @foreach($employees as $employee)
                            <option value="{{ $employee->id }}"> {{ $employee->first_name.' '.$employee->last_name }}</option>
                            @endforeach
                        </select>
                
                    </div>                    

                    <div class="form-group">
                        <label for="username">Type <span style="color:red">*</span></label>
                        <select name="type" class="form-control">
                            <option></option>
                            <option value="Hourly"> Hourly</option>
                            <option value="Daily"> Daily</option>
                        </select>
                
                    </div>

                    <div class="form-group">
                        <label for="username">Rate <span style="color:red">*</span></label>
                        <select name="rate" class="form-control">
                            <option></option>
                            <option value="Normal"> Normal</option>
                            <option value="Weekday"> Weekday</option>
                            <option value="Saturday"> Saturday</option>
                            <option value="Sunday"> Sunday</option>
                            <option value="Holiday"> Holiday</option>
                        </select>
                
                    </div>

          <div class="form-group">
            <label for="username">Period Worked <span style="color:red">*</span> </label>
            <input class="form-control" placeholder="" type="text" name="period" onkeypress="totalB()" onkeyup="totalB()" id="period" value="{{{ Input::old('period') }}}">
            
        </div>

        <div class="form-group">
            <label for="username">Amount <span style="color:red">*</span> </label>
            <input class="form-control" placeholder="" type="text" name="amount" onkeypress="totalBalance()" onkeyup="totalBalance()" id="amount" value="{{{ Input::old('amount') }}}">
            <script type="text/javascript">
           $(document).ready(function() {
           $('#amount').priceFormat();
           });
           </script>
        </div>
        
        <div class="form-group">
            <label for="username">Total amount </label>
            <input class="form-control" placeholder="" readonly type="text" name="total" id="total" value="{{{ Input::old('total') }}}">
            
        </div>
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create Overtime</button>
        </div>

    </fieldset>
</form>
        

  </div>

</div>

@stop