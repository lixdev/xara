
@extends('layouts.payroll')

{{HTML::script('media/jquery-1.8.0.min.js') }}

<script type="text/javascript">
document.getElementById("edate").value = '';
 function totalBalance() {
      var instals = document.getElementById("instalments").value;
      var amt = document.getElementById("amount").value.replace(/,/g,'');
      var total = instals * amt * 10;
      total=total.toLocaleString('en-US',{minimumFractionDigits: 2});
      document.getElementById("balance").value = total;

}

function totalB() {
      var instals = document.getElementById("instalments").value;
      var amt = document.getElementById("amount").value.replace(/,/g,'');
      var total = instals * amt ;
      total=total.toLocaleString('en-US',{minimumFractionDigits: 2});
      document.getElementById("balance").value = total;

}

function getdate() {
    var tt = document.getElementById('ddate').value;
    var instals = document.getElementById("instalments").value;

    var date = new Date(tt);
    var newdate = new Date(date);
    
    newdate.setMonth(newdate.getMonth() + parseInt(instals)+1);

    var dd = newdate.getDate();
    var mm = newdate.getMonth();
    var y = newdate.getFullYear();

    var someFormattedDate = dd + '/' + mm + '/' + y;

    if(tt == '' || instals== ''){
    document.getElementById('edate').value = '';
    }else{
    document.getElementById('edate').value = someFormattedDate;
    }
   
}

</script>

<script type="text/javascript">
$(document).ready(function(){
$('#insts').hide();
$('#bal').hide();
$('#formular').change(function(){
if($(this).val() == "Instalments"){
    $('#insts').show();
    $('#bal').show();
}else{
    $('#insts').hide();
    $('#bal').hide();
}
getdate();
});

$('#ddate').change(function(){
var tt = $('#ddate').val();
var newdate = new Date(tt);
var instals = $('#instalments').val();

    if(instals == ''){
    instals = 1;
    }else{
     instals = $('#instalments').val();
    }
if($('#ddate').val() == ''){
    $('#edate').val();
    }else{
    $('#edate').val(formatDate(addMonths(newdate, parseInt(instals))));
    }
});

function addMonths(date, months) {
    var result = new Date(date);
    result.setMonth(date.getMonth() + months);
    return result;
}

function formatDate(date) {
    return date.getDate() + '/' + (date.getMonth()+1) + '/' + date.getFullYear();
}

function getdate() {
var tt = $('#ddate').val();

    var instals = $('#instalments').val();

    if(instals == ''){
    var instals = 1;
    }else{
     var instals = $('#instalments').val();
    }

    var newdate = new Date(tt);

    var jan312009 = new Date(tt);
    var oneMonthFromJan312009 = new Date(new Date(jan312009).setMonth(jan312009.getMonth()+parseInt(instals)));


    var dd = oneMonthFromJan312009.getDate();
    var mm = oneMonthFromJan312009.getMonth();
    var y = oneMonthFromJan312009.getFullYear();

    var someFormattedDate = dd + '/' + mm + '/' + y;

    if($('#ddate').val() == ''){
    $('#edate').val();
    }else{
    $('#edate').val(someFormattedDate);
    }
}

});
</script>

@section('content')
<br/>

<div class="row">
    <div class="col-lg-12">
  <h3>New Employee Deduction</h3>

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

         <form method="POST" action="{{{ URL::to('employee_deductions') }}}" accept-charset="UTF-8">
   
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
         <label for="username">Deduction Type <span style="color:red">*</span></label>
                        <select name="deduction" class="form-control">
                           <option></option>
                            @foreach($deductions as $deduction)
                            <option value="{{ $deduction->id }}"> {{ $deduction->deduction_name }}</option>
                            @endforeach
                        </select>
                
        </div>          


        <div class="form-group">
                        <label for="username">Formular <span style="color:red">*</span></label>
                        <select name="formular" id="formular" class="form-control forml">
                            <option></option>
                            <option value="One Time">One Time</option>
                            <option value="Recurring">Recurring</option>
                            <option value="Instalments">Instalments</option>
                        </select>
                
                    </div>

        <div class="form-group insts" id="insts">
            <label for="username">Instalments </label>
            <input class="form-control" placeholder="" onkeypress="totalB(),getdate()" onkeyup="totalB(),getdate()" type="text" name="instalments" id="instalments" value="{{{ Input::old('instalments') }}}">
        </div>

        <div class="form-group">
            <label for="username">Amount <span style="color:red">*</span> </label>
            <input class="form-control" placeholder="" type="text" onkeypress="totalBalance()" onkeyup="totalBalance()" name="amount" id="amount" value="{{{ Input::old('amount') }}}">
            <script type="text/javascript">
           $(document).ready(function() {
           $('#amount').priceFormat();
           });
           </script>       
        </div>

        <div class="form-group bal_amt" id="bal">
            <label for="username">Total </label>
            <input class="form-control" placeholder="" readonly="readonly" type="text" name="balance" id="balance" value="{{{ Input::old('balance') }}}">
            
        </div>

        
        <div class="form-group">
                        <label for="username">Deduction Date <span style="color:red">*</span></label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker" readonly="readonly" placeholder="" type="text" name="ddate" id="ddate" value="{{{ Input::old('ddate') }}}">
                        </div>
        </div>

        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create Employee Deduction</button>
        </div>

    </fieldset>
</form>
        

  </div>

</div>

@stop