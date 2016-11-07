@extends('layouts.membercss')
@section('content')

<div class="row">
	<div class="col-lg-12">
  <h3>Loan Guarantor</h3>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-5">

    
		
		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif


       

		 <form method="POST" action="{{{ URL::to('cssloanguarantors') }}}" accept-charset="UTF-8">
   
    <fieldset>


        <input class="form-control" placeholder="" type="hidden" name="loanaccount_id" id="loanaccount_id" value="{{$loanaccount->id}}">

         <div class="form-group">
            <label for="username">Member </label>
            <select class="form-control" name="member_id">
                <option value="">select member</option>
                <option>--------------------------</option>
                @foreach($members as $member)
                <option value="{{$member->id}}">{{ $member->membership_no  }} {{ $member->name }}</option>
                @endforeach
            </select>
            
        </div>

      
        
        <div class="form-actions form-group">
        
        

          <button type="submit" class="btn btn-primary btn-sm">Add Guarantor</button> 
        </div>

    </fieldset>
</form>

  	

  </div>

</div>























@stop