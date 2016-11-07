@extends('layouts.main')
@section('content')

<div class="row">
	<div class="col-lg-12">
  <h3>New Kin</h3>

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

		 <form method="POST" action="{{{ URL::to('NextOfKins') }}}" accept-charset="UTF-8">
   
    <fieldset>

        <input class="form-control" placeholder="" type="hidden" readonly name="employee_id" id="employee_id" value="{{ $id }}">

        <div class="form-group">
            <label for="username">Kin Name</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{{ Input::old('name') }}}">
        </div>


        <div class="form-group">
            <label for="username">ID Number</label>
            <input class="form-control" placeholder="" type="text" name="id_number" id="id_number" value="{{{ Input::old('id_number') }}}">
        </div>
        
        <div class="form-group">
            <label for="username">Relationship </label>
            <input class="form-control" placeholder="" type="text" name="rship" id="rship" value="{{{ Input::old('rship') }}}">
        </div>

        <div class="form-group">
            <label for="username">Contact </label>
            <textarea class="form-control" name="contact" id="contact">{{{ Input::old('contact') }}}</textarea>
        </div>
        
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create Kin</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>
























@stop