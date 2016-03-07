
@extends('layouts.payroll')

{{ HTML::script('media/jquery-1.8.0.min.js') }}

<?php
$part = explode("-", $period);
$start_date = $part[1]."-".$part[0]."-01";
$end_date  = date('Y-m-t', strtotime($start_date));
$start  = date('Y-m-01', strtotime($end_date));


     $per = DB::table('transact')
          ->where('financial_month_year','=',$period)
          ->count();
     if($per>0){?>

      <script type="text/javascript"> 
     
      if (window.confirm("Do you wish to process payroll for this period again?"))
      {

         $(function(){
                  var p1 = <?php echo $part[0]?>;
                  var p2 = "-";
                  var p3 = <?php echo $part[1]?>;

                  console.log(p1+p2+p3);

                  $.ajax({
                      url     : "{{URL::to('deleterow')}}",
                      type    : "POST",
                      async   : false,
                      data    : {
                          'period1'  : p1,
                          'period2'  : p2,
                          'period3'  : p3
                      },
                      success : function(d){
                      if(d == 0){
                           
                         }else{
                           
                         }
                      }        
             });
         });
       }else{
      window.location.href = "{{URL::to('payroll')}}";
     }
    </script>
    <?php } ?>

    <?php
function asMoney($value) {
  return number_format($value, 2);
}

?>

@section('content')
<br/>

<div class="row">
  <div class="col-lg-12">
  <h3>Payroll Preview</h3>

<hr>
</div>  
</div>


<div class="row" >
  <div class="col-lg-12">

    <div class="panel panel-default">
      <div class="panel panel-success">
      <div class="panel-heading">
          <h4>Payroll Preview</h4>
        </div>
        <div class="panel-body" style="margin-left:-10px;">
    <form method="POST" action="{{{ URL::to('payroll') }}}" accept-charset="UTF-8">

      <input type="hidden" name="period" value="{{ $period }}"> 
       <input type="hidden" name="account" value="{{ $account }}"> 

    <table id="users" style="font-size:10px;width:1000px" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
         <th>PF Number</th>
         <th>Employee</th>
         <th>Basic Pay</th>
         <th>Earnings</th>
         <th>Gross Pay</th>
         <th>Paye</th>
         <th>Nssf</th>
         <th>Nhif</th>
         <th>Other Deductions</th>
         <th>Total Deductions</th>
         <th>Net Pay</th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($employees as $employee)

        <tr>

          <td> {{ $i }}</td>
          <td >{{ $employee->personal_file_number }}</td>
          <td>{{ $employee->first_name.' '.$employee->last_name }}</td>
          <td align="right">{{ asMoney((double)$employee->basic_pay) }}</td>
          <td align="right">{{ asMoney((double)Payroll::total_benefits($employee->id)) }}</td>
          <td align="right">{{ asMoney((double)Payroll::gross($employee->id)) }}</td>
          <td align="right">{{ asMoney((double)Payroll::tax($employee->id)) }}</td>
          <td align="right">{{ asMoney((double)Payroll::nssf($employee->id)) }}</td>
          <td align="right">{{ asMoney((double)Payroll::nhif($employee->id)) }}</td>
          <td align="right">{{ asMoney((double)Payroll::deductions($employee->id)) }}</td>
          <td align="right">{{ asMoney((double)Payroll::total_deductions($employee->id)) }}</td>
          <td align="right">{{ asMoney((double)Payroll::net($employee->id)) }}</td>
          
        </tr>
         
        <?php $i++; ?>
        @endforeach

      </tbody>

    </table>
     
     <div align="right" style="margin-top:50px;" class="form-actions form-group">
        
          <button class="btn btn-primary btn-sm process" >Process</button>
        </div>

      </form>
    

  </div>


  </div>

</div>

@stop