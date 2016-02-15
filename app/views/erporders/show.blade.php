@extends('layouts.erp')
@section('content')
<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>
<br><div class="row">
	<div class="col-lg-12">
  <h4>Sales Order : {{$order->order_number}} &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Client: {{$order->client->name}}  &nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;&nbsp;&nbsp; Date: {{$order->date}} &nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;&nbsp;&nbsp; Status: {{$order->status}}  </h4>

<hr>
</div>	
</div>

<div class="row">
    <div class="col-lg-12">
    @if($order->status != 'released')
    <a href="{{URL::to('items/release/'.$order->id)}}" class="btn btn-primary"> Release Items</a>
    @endif

     @if($order->status != 'released')
    <a href="{{URL::to('releaseform/'.$order->id)}}" class="btn btn-primary"> Generate Release form</a>
     @endif

    <a href="{{URL::to('salesinvoice/'.$order->id)}}" class="btn btn-primary"> Generate Invoice</a>
    <a href="{{URL::to('payments/create')}}" class="btn btn-primary"> Make Payment</a>
    </div>
</div>

<div class="row">
	<div class="col-lg-12">

    <hr>
		
		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif

    <table class="table table-condensed table-bordered table-hover" >

    <thead>
        
        <th>Item</th>
        <th>Quantity</th>
        <th>Rate</th>
        <th>Amount</th>
        <th>Duration</th>
        <th>Total Amount</th>
       
    </thead>

    <tbody>

   
        <?php $total = 0; ?>
        @foreach($order->erporderitems as $orderitem)

            <?php

            $amount = $orderitem['price'] * $orderitem['quantity'];
            $total_amount = $amount * $orderitem['duration'];
            $total = $total + $total_amount;
            ?>
        <tr>
          
            <td>{{$orderitem->item->name}}</td>
            <td>{{$orderitem['quantity']}}</td>
            <td>{{asMoney($orderitem['price'])}}</td>
            <td>{{asMoney($amount)}}</td>
            <td>{{$orderitem['duration']}}</td>
            <td>{{asMoney($total_amount) }}</td>
            
        </tr>

        @endforeach

        <tr>
           
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Total</td>
            <td>{{asMoney($total)}}</td>
          
        </tr>
    </tbody>
        
    </table>
		

  </div>

</div>




@stop