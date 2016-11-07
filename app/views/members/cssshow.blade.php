@extends('layouts.membercss')
@section('content')

<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>
<div class="row">
	<div class="col-lg-12">


<a class="btn btn-info btn-sm "  href="{{ URL::to('members/edit/'.$member->id)}}">update details</a>

<hr>
</div>	
</div>


<div class="row">


<div class="col-lg-2">

<img src="{{  asset('public/uploads/photos/'.$member->photo)}}" width="150px" height="130px" alt="no photo"><br>
<br>
<img src="{{  asset('public/uploads/photos/'.$member->signature)}}" width="120px" height="50px" alt="no signature">
</div>

<div class="col-lg-4">

<table class="table table-bordered table-hover">

	<tr>

		<td>Member Name</td><td>{{ $member->name}}</td>


	</tr>
	<tr>

		<td>Membership Number</td><td>{{ $member->membership_no}}</td>


	</tr>
   @if($member->branch != null)
	<tr>

		<td>Branch</td><td>{{ $member->branch->name}}</td>


	</tr>
  @endif

  @if($member->group != null)
	<tr>

		<td>Group</td><td>{{ $member->group->name}}</td>


	</tr>
  @endif
	
<tr>

		<td>ID Number</td><td>{{ $member->id_number}}</td>


	</tr>


</table>


</div>



<div class="col-lg-4">

<table class="table table-bordered table-hover">



	<tr>

		<td>Gender</td><td>{{ $member->gender}}</td>


	</tr>

	<tr>

		<td>Phone Number</td><td>{{ $member->phone}}</td>


	</tr>
	<tr>

		<td>Email Address</td><td>{{ $member->email}}</td>


	</tr>
	<tr>

		<td>Address</td><td>{{ $member->address}}</td>


	</tr>

	



</table>


</div>




</div>







</div>



<div class="row">
	<div class="col-lg-12">

<hr>

</div>	
</div>






<div class="row">


	<div class="col-lg-12">




		<div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#remittance" aria-controls="remittance" role="tab" data-toggle="tab">Remittance</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Next Of Kin</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Loan Accounts</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Saving Accounts</a></li>
     <li role="presentation"><a href="#shares" aria-controls="shares" role="tab" data-toggle="tab">Share Accounts</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="remittance">
    	<br>

    	<div class="col-lg-5"> 

    		<table class="table table-bordered table-hover ">

    		<tr>

    			<td>Monthly Saving Remittance </td><td>{{ asMoney($member->monthly_remittance_amount )}}</td>

    		</tr>

    	</table>
    	</div>
    	
    </div>



    <div role="tabpanel" class="tab-pane" id="profile">

    	<br>

    	<div class="col-lg-10">

    <div class="panel panel-default">
      <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('kins/create/'.$member->id)}}">new Kin</a>
        </div>
        <div class="panel-body">


    <table id="users" style="width:100%" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Kin Name</th>

         <th>ID Number</th>
         <th>Relationship</th>
         
           <th>Goodwill</th>
        <th></th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($member->kins as $kin)

        <tr>

          <td> {{ $i }}</td>
          <td>{{ $kin->name }}</td>
          <td>{{ $kin->id_number }}</td>
          <td>{{ $kin->rship }}</td>
          <td>{{ $kin->goodwill.' %' }}</td>
          <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" style="margin-left:0" role="menu">
                    <li><a href="{{URL::to('kins/edit/'.$kin->id)}}">Update</a></li>
                   
                    <li><a href="{{URL::to('kins/delete/'.$kin->id)}}">Delete</a></li>
                    
                  </ul>
              </div>

                    </td>



        </tr>

        <?php $i++; ?>
        @endforeach


      </tbody>


    </table>
  </div>


  </div>


    </div>

</div>
    <div role="tabpanel" class="tab-pane" id="messages">


<br>

      <div class="panel panel-default">
        <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('loans/application/'.$member->id)}}">New Loan</a>
        </div>
        <div class="panel-body">


    <table id="mobile" width="100%" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Loan Product</th>

         <th>Account Number</th>
         <th>Loan Amount</th>
         
         <th>Loan Balance</th>
        <th></th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($member->loanaccounts as $loan)

        <tr>

          <td> {{ $i }}</td>
          <td>{{ $loan->loanproduct->name }}</td>
          <td>{{ $loan->account_number }}</td>
          <td>{{ asMoney(Loanaccount::getLoanAmount($loan))}}</td>
          <td>{{ asMoney(Loantransaction::getLoanBalance($loan) )}}</td>
          <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" style="margin-left:0" role="menu">
                    <li><a href="{{URL::to('memloans/'.$loan->id)}}">View</a></li>
                   
                    
                    
                  </ul>
              </div>

                    </td>



        </tr>

        <?php $i++; ?>
        @endforeach


      </tbody>


    </table>
  </div>
</div>




















    </div>



    <div role="tabpanel" class="tab-pane" id="settings">

      <br>
        <div class="row">
          <div class="col-lg-12">

            <div class="panel panel-default">
              <div class="panel-heading">
                <h5>Savings Account</h5>
              </div>
            
            <div class="panel-body">


                <table id="users" width="100%" class="table table-condensed table-bordered table-responsive table-hover">


                  <thead>

                    <th>#</th>
                   
                    <th>Savings Product</th>
                    <th>Account Number</th>
         
                    <th></th>

                  </thead>
                  
                  <tbody>

                      <?php $i = 1; ?>
                    
                    @foreach($member->savingaccounts as $saving)

                    <tr>

                      <td> {{ $i }}</td>
                    
                      <td>{{ $saving->savingproduct->name }}</td>
                      <td>{{ $saving->account_number }}</td>
                      <td> <a href="{{ URL::to('memtransactions/'.$saving->id)}}" class="btn btn-primary btn-sm">View </a></td>
                    </tr>

                      <?php $i++; ?>
                    @endforeach


                  </tbody>


                </table>
            </div>


          </div>

        </div>
    </div>







   



  </div>







 <div role="tabpanel" class="tab-pane" id="shares">

      <br>
        <div class="row">
          <div class="col-lg-12">

            <div class="panel panel-default">
              <div class="panel-heading">
              <h5>Share Account</h5>
            </div>
            
            <div class="panel-body">


                <table width="100%" id="users" class="table table-condensed table-bordered table-responsive table-hover">


                  <thead>

                    <th>#</th>
                    
                    <th>Account Number</th>
                    
                    <th></th>

                  </thead>
                  
                  <tbody>

                    
                    
                  

                    <tr>

                      <td> 1</td>
                      
                      
                      <td>{{ $member->shareaccount->account_number }}</td>
                      <td> <a href="{{ URL::to('sharetransactions/show/'.$member->shareaccount->id)}}" class="btn btn-primary btn-sm">View </a></td>
                    </tr>

                 
                 


                  </tbody>


                </table>
            </div>


          </div>

        </div>
    </div>







  

</div>


	</div>





</div>



















@stop