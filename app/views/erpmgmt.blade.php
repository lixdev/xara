@extends('layouts.erp')
@section('content')
<br><br/>
<div class="row">
                      <div class="col-md-2">
                        <a class="btn btn-default btn-icon input-block-level" href="{{ URL::to('items/create')}}">
                          <i class="fa fa-barcode fa-2x"></i>
                          <div>New Item</div>
                          
                        </a>
                      </div>

                      <div class="col-md-2">
                        <a class="btn btn-default btn-icon input-block-level" href="{{ URL::to('clients/create')}}">
                          <i class="fa fa-user fa-2x"></i>
                          <div>New Client</div>
                          
                        </a>
                      </div>


                      <div class="col-md-2">
                        <a class="btn btn-default btn-icon input-block-level" href="{{URL::to('salesorders/create')}}">
                          <i class="glyphicon glyphicon-tasks fa-2x"></i>
                          <div>New Quote</div>
                          
                        </a>
                      </div>

                      <div class="col-md-2">
                        <a class="btn btn-default btn-icon input-block-level" href="{{ URL::to('purchaseorders/cretae')}}">
                          <i class="glyphicon glyphicon-random fa-2x"></i>
                          <div>Release Items</div>
                          
                        </a>
                      </div>
                      
                      

                      <div class="col-md-2">
                        <a class="btn btn-default btn-icon input-block-level" href="{{ URL::to('stocks/create')}}">
                          <i class="glyphicon glyphicon-random fa-2x"></i>
                          <div>Receive Items</div>
                          
                        </a>
                      </div>


                      <div class="col-md-2">
                        <a class="btn btn-default btn-icon input-block-level" href="{{ URL::to('payments/create')}}">
                          <i class="glyphicon glyphicon-barcode fa-2x"></i>
                          <div>New Stock</div>
                          
                        </a>
                      </div>


                       

                      
                    </div>


<br><br>
<hr>
<div class="row">
              						
<div class="col-lg-4"></div>
	<div class="col-lg-4">

		

		<br><br>
		<img src="{{asset('images/logo.png')}}">
    
	</div>


</div>

@stop