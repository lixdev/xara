@extends('layouts.erp')
@section('content')

<br><div class="row">
	<div class="col-lg-12">
  <h3>Update Item</h3>

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

		 <form method="POST" action="{{{ URL::to('itemcategories/update/'.$itemcategory->id) }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label for="username">Category Name <span style="color:red">*</span> :</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{$itemcategory->name}}" required>
        </div>

         

        <div class="form-group">
            <label for="username">Category <span style="color:red">*</span> :</label>
            <select name="category" class="form-control" required>
                <option value="{{$itemcategory->category}}">{{$itemcategory->category}}</option>
                <option value="VISUAL">Visual</option>
                <option value="AUDIO">Audio</option>
                <option value="STAGING">Staging</option>
                <option value="LIGHTING">Lighting</option>
            </select>
            
        </div>

        

       
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Update Category</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>

@stop