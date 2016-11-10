@extends('layouts.membercss')
@section('content')
<<<<<<< HEAD
=======

>>>>>>> 92fdd8bfdec9effbd47d97d54a71fc925c91940f
<?php
function asMoney($value) {
  return number_format($value, 2);
}
?>
<div class="row">
	<div class="col-lg-12">
  @if(isset($member))
  <h3>{{$member->name}} Loan Accounts</h3>
  @endif
<hr>
</div>	
</div>
<div class="row">
	<div class="col-lg-12">

    <div class="panel panel-default">
      <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('loans/application/'.$member->id)}}">New Loan Application</a>
        </div>
        <div class="panel-body">
      <table id="users" class="table table-condensed table-bordered table-responsive table-hover">
      <thead>

        <th>#</th>
        <th>Loan Type</th>
        
      
        <th>Loan Amount</th>
        <th>Status </th>
    

        <th></th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @if(isset($member->loanaccounts))
        @foreach($member->loanaccounts as $loan)

        
        <tr>

          <td> {{ $i }}</td>
          <td>{{ $loan->loanproduct->name }} - {{$loan->loan_purpose}}</td>
          
         
          <td>{{ asMoney($loan->amount_applied) }}</td>
          <td>

            @if($loan->is_new_application == true)
              new application 
            @endif
            
            @if($loan->is_approved)
              approved 
            @endif

            @if($loan->is_rejected)
              rejected 
            @endif

            @if($loan->is_disbursed)
              disbursed 
            @endif

            @if($loan->is_amended)
               amended 
            @endif

            </td>
          
          <td>
            @if($loan->is_disbursed)
             <a href="{{ URL::to('memloans/'.$loan->id) }}" class="btn btn-info btn-sm">Manage</a>
             @endif

          </td>                    
        </tr>
        <?php $i++; ?>
        @endforeach
      @endif
      </tbody>


    </table>
  </div>


  </div>

</div>
























@stop