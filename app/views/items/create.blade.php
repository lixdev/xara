@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h3>New Item</h3>

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

		 <form method="POST" action="{{{ URL::to('items') }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label for="username">Item Name <span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{{ Input::old('name') }}}">
        </div>

         <div class="form-group">
            <label for="username">Description:</label>
            <textarea rows="5" class="form-control" name="description" id="description" >{{ Input::old('email_office') }}</textarea>
        </div>

        <div class="form-group">
            <label for="username">Purchase Price <span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="pprice" id="pprice" value="{{{ Input::old('pprice') }}}">
        </div>

        <div class="form-group">
            <label for="username">Price Rate <span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="sprice" id="sprice" value="{{{ Input::old('sprice') }}}">
        </div>


        <div class="form-group">
            <label for="username">Duration<span style="color:red">*</span> :</label>
            <select name="duration" class="form-control">
                <option value="hour">Per Hour</option>
                <option value="day">Per Day</option>
            </select>
        </div>


        <div class="form-group">
            <label for="username">Store Keeping Unit:</label>
            <input class="form-control" placeholder="" type="text" name="sku" id="sku" value="{{{ Input::old('sku') }}}">
        </div>

        <div class="form-group">
            <label for="username">Tag Id:</label>
            <input class="form-control" placeholder="" type="text" name="tag" id="tag" value="{{{ Input::old('tag') }}}">
        </div>
        
        <div class="form-group">
            <label for="username">Reorder Level:</label>
            <input class="form-control" placeholder="" type="text" name="reorder" id="reorder" value="{{{ Input::old('reorder') }}}">
        </div>

        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create Item</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>

@stop