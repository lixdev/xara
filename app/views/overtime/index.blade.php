@extends('layouts.payroll')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Overtime earnings</h3>

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
          <a class="btn btn-info btn-sm" href="{{ URL::to('overtimes/create')}}">new overtime earning</a>
        </div>
        <div class="panel-body">


    <table id="users" class="table table-condensed table-bordered table-responsive table-hover">


      <thead>

        <th>#</th>
        <th>Employee</th>
        <th>Type</th>
        <th>Pay rate</th>
        <th>Amount</th>
        <th>Action</th>

      </thead>
      <tbody>

        <?php $i = 1; ?>
        @foreach($overtimes as $overtime)

        <tr>

          <td> {{ $i }}</td>
          <td>{{ $overtime->employee->first_name.' '.$overtime->employee->last_name }}</td>
          <td>{{ $overtime->type }}</td>
          <td>{{ $overtime->rate }}</td>
          <td>{{ $overtime->amount }}</td>
          <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
          
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{URL::to('overtimes/edit/'.$overtime->id)}}">Update</a></li>
                   
                    <li><a href="{{URL::to('overtimes/delete/'.$overtime->id)}}" onclick="return (confirm('Are you sure you want to delete this employee`s overtime?'))">Delete</a></li>
                    
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