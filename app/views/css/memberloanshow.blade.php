@extends('layouts.membercss')
@section('content')
{{HTML::script('media/jquery-1.8.0.min.js') }}
<script type="text/javascript">
$(document).ready(function(){
$('#status').val("bla");
$('#amtshow').click(function(){
    $('#status').val('approved');
});
$('#rej').click(function(){
    $('#status').val('rejected');
});
});
</script>

<div class="row">
	<div class="col-lg-12">
  <h3>{{$loanaccount->loanproduct->name}} for {{$loanaccount->member->name}}</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-7">

      <table id="users" class="table table-bordered table-condensed table-hover table-stripped">
          <tr>
            <td>Member Name</td><td>{{$loanaccount->member->name}}</td>

          </tr>

          <tr>
            <td>Loan Product Name</td><td>{{$loanaccount->loanproduct->name}}</td>

          </tr>
          <tr>
            <td>Date Applied</td><td>{{$loanaccount->application_date}}</td>

          </tr>
          <tr>
            <td>Amount</td><td>{{number_format($loanaccount->amount_applied,2)}}</td>

          </tr>
          <tr>
            <td>Interest Rate</td><td>{{$loanaccount->interest_rate}} % monthly</td>

          </tr>
          <tr>
            <td>Period</td><td>{{$loanaccount->period}} Months</td>

          </tr>
         
      </table>

     <div align="right"> 
     
                 <form id="form" method="POST" action="{{{ URL::to('gurantorapprove/'.$loanaccount->id) }}}" accept-charset="UTF-8" enctype="multipart/form-data">
                  <input class="form-control" style="width:200px" placeholder="" type="hidden" name="mid1" id="mid" value="{{$loanaccount->member->id}}">
                  <input class="form-control" style="width:200px" placeholder="" type="hidden" name="amount_applied" id="amount_applied" value="{{$loanaccount->amount_applied}}">
                  <input class="form-control" style="width:200px" placeholder="" type="hidden" name="pname" id="pname" value="{{$loanaccount->loanproduct->name}}">
                   <input class="form-control" style="width:200px" placeholder="" type="hidden" name="status" id="status" value="">
                   <button id="amtshow" type="submit" class="btn btn-success btn-sm" onclick="return (confirm('Are you sure you want to approve this loan application?'))">
                    Approve 
                  </button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="rej" onclick="return (confirm('Are you sure you want to reject this loan application?'))" type="submit" class="btn btn-danger btn-sm">
                    Reject 
                  </button><br><br>
                 </form>
                 
                </div>
       

  </div>
</div>




@stop