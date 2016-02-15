@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h4>Sales Order : {{$order->order_number}} &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Client: {{$order->client->name}}  &nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;&nbsp;&nbsp; Date: {{$order->date}} &nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;&nbsp;&nbsp; Status: {{$order->status}}  </h4>

<hr>
</div>	
</div>



<div class="row">
    <div class="col-lg-12">

 
        
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
        <th>Duration</th>
        <th>Release Date</th>
        <th>Location</th>
        <th>Condition</th>
        <th>Remarks</th>
       
    </thead>

    <tbody>
<form action="{{URL::to('leaseditems')}}" method="post" >

    <input type="hidden" name="order_id" value="{{$order->id}}">
    
        @foreach($order->erporderitems as $orderitem)

           
        <tr>
          
            <td>
            <input type="hidden" name="client_id[]" value="{{$order->client->id}}">
            <input type="hidden" name="item_id[]" value="{{$orderitem->item->id}}">
            {{$orderitem->item->name}}
            </td>
            <td>
            <input type="hidden" name="quantity[]" value="{{$orderitem['quantity']}}">
            {{$orderitem['quantity']}}
            </td>
            <td>
            <input type="hidden" name="duration[]" value="{{$orderitem['duration']}}">
            {{$orderitem['duration']}}
           
            </td>
            <td>
                <input class="form-control datepicker"  readonly="readonly" placeholder="" type="text" name="release_date[] " id="release_date" value="{{date('d-M-Y')}}">
            </td>
            <td>
                <select class="form-control" name="location_id[]">
                    @foreach($locations as $location)
                    <option value="{{$location->id}}">{{$location->name}}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-control" name="release_condition[]">
                    <option value="good">Good</option>
                    <option value="damaged">Damaged</option>
                </select>
            </td>
            <td>
                <textarea class="form-control" name="release_remarks[]"></textarea>
            </td>
            
        </tr>

        @endforeach

       
    </tbody>
        
    </table>
        

  </div>

</div>




<div class="row">

   <hr>
    <div class="col-lg-12">
    <button type="submit" class="btn btn-primary pull-right"> Release Items</button>
    </form>
    </div>
</div>






@stop