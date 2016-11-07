@extends('layouts.ports')
@section('content')

<div class="row">
	<div class="col-lg-12">
  <h3> Loan Reports</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-12">

    <ul>

      <li>

        <a href="{{ URL::to('reports/loanlisting') }}" target="_blank"> Loan Listing report</a>

      </li>

      @foreach($loanproducts as $loanproduct)

       <li>

        <a href="{{ URL::to('reports/loanproduct/'.$loanproduct->id)}}" target="_blank"> {{ $loanproduct->name}} report</a>

      </li>
      @endforeach


      



    </ul>

  </div>

</div>
























@stop