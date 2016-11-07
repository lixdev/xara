@extends('layouts.system')
@section('content')

<div class="row">
	<div class="col-lg-1">



</div>	

<div class="col-lg-12">

	@if (Session::get('error'))
            <div class="alert alert-danger">{{{ Session::get('error') }}}</div>
        @endif

        @if (Session::get('notice'))
            <div class="alert alert-info">{{{ Session::get('notice') }}}</div>
        @endif

<p>Bulk Process Loans </p>
<hr>

<br>
</div>	


<div class="col-lg-5 ">

	
<form method="POST" action="{{{ URL::to('automated/autoloans') }}}"  enctype="multipart/form-data">
 

<input type="hidden" value="loans" name="category">




        <div class="form-group loanproduct" id="loanproduct">
            <label for="username">Loan Products </label>
            <select name="loanproduct_id" class="form-control " >

                <?php $date = date('Y-m-d'); $category = 'loan'; ?>
                @foreach($loanproducts as $loanproduct)
                @if(!Autoprocess::checkProcessed($date, $category, $loanproduct))
                <option value="{{$loanproduct->id}}">{{$loanproduct->name}}</option>
                @endif
                @endforeach
                

            </select>
        </div>



         <div class="form-group " >

            <label>Period</label>
            <input type="text" class="form-control datepicker2" readonly="readonly" name="period">

         </div>


        

        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Process Loans</button>
        </div>


</form>	

</div>	



</div>





@stop