<?php


function asMoney($value) {
  return number_format($value, 2);
}

?>

@extends('layouts.erp')
@section('content')

<div class="row">
	<div class="col-lg-12">
  <h4><font color='green'>Items</font></h4>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-12">
   
    @if (Session::has('flash_message'))

      <div class="alert alert-success">
      {{ Session::get('flash_message') }}
     </div>
    @endif

    @if (Session::has('delete_message'))

      <div class="alert alert-danger">
      {{ Session::get('delete_message') }}
     </div>
    @endif

    <div class="panel panel-default">
      <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('items/create')}}">new item</a>
        </div>
        <div class="panel-body">


    <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Name</th>
        <th>Description</th>
        <th>Type</th>
        <th>Purchase Price</th>
        <th>Selling Price</th>
        <th></th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($items as $item)

        <tr>

          <td> {{ $i }}</td>
          <td>{{ $item->name }}</td>
          <td>{{ $item->description }}</td>
          <td>{{ $item->type }}</td>
          <td align="right">{{ asMoney($item->purchase_price) }}</td>
          <td align="right">{{ asMoney($item->selling_price) }}</td>
          <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{URL::to('items/edit/'.$item->id)}}">Update</a></li>
                   
                    <li><a href="{{URL::to('items/delete/'.$item->id)}}" onclick="return (confirm('Are you sure you want to delete this item?'))">Delete</a></li>
                    
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

@stop