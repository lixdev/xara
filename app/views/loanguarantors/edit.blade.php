@extends('layouts.member')
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


       

		 <form method="POST" action="{{{ URL::to('loanguarantors/update/'.$loanguarantor->id) }}}" accept-charset="UTF-8">
   
    <fieldset>


        <input class="form-control" placeholder="" type="hidden" name="loanaccount_id" id="loanaccount_id" value="{{$loanguarantor->loanaccount->id}}">

         <div class="form-group">
            <label for="username">Member </label>
            <select class="form-control" name="member_id">
                <option>--------------------------</option>
                @foreach($members as $member)
                <option value="{{$member->id}}"<?= ($loanguarantor->member_id==$member->id)?'selected="selected"':''; ?>>{{ $member->membership_no  }} {{ $member->name }}</option>
                @endforeach
            </select>
            
        </div>


        <div class="form-actions form-group">
        
        

          <button type="submit" class="btn btn-primary btn-sm">Update Guarantor</button> 
        </div>

    </fieldset>
</form>

  	

  </div>

</div>























@stop