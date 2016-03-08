@extends('layouts.main')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>New Occurence</h3>

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

		 <form method="POST" action="{{{ URL::to('occurences') }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label for="username">Occurence Brief <span style="color:red">*</span> </label>
            <input class="form-control" placeholder="" type="text" name="brief" id="brief" value="{{{ Input::old('brief') }}}">
        </div>
       
       <input class="form-control" placeholder="" type="hidden" readonly name="employee" id="employee" value="{{ $id }}"> 

        <div class="form-group">
                        <label for="username">Occurence Type: <span style="color:red">*</span></label>
                        <select name="type" class="form-control">
                           <option></option>
                           <option value="Absentism/Abandonment"> Absentism/Abandonment</option>
                           <option value="Abuse of Office"> Abuse of Office</option>
                           <option value="Assessment"> Assessment </option>
                           <option value="Corruption"> Corruption </option>
                           <option value="Emergency Drill"> Emergency Drill </option>
                           <option value="Incompetence"> Incompetence </option>
                           <option value="Initiative"> Initiative </option>
                           <option value="Innovation"> Innovation </option>
                           <option value="Insubordination"> Insubordination </option>
                           <option value="Intoxication"> Intoxication </option>
                           <option value="Meeting"> Meeting </option>
                           <option value="Promotion"> Promotion </option>
                           <option value="Team Building"> Team Building </option>
                           <option value="Theft"> Theft </option>
                           <option value="Training"> Training </option>
                           <option value="Violence"> Violence </option>
                        </select>
                
                    </div>     
        
        <div class="form-group">
            <label for="username">Occurence Narrative </label>
            <textarea class="form-control" name="narrative">{{{ Input::old('narrative') }}}</textarea>
        </div>

        <div class="form-group">
                        <label for="username">Occurence Date <span style="color:red">*</span></label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker"  readonly="readonly" placeholder="" type="text" name="date" id="date" value="{{{ Input::old('date') }}}">
                        </div>
                        </div>

        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create Occurence</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>
























@stop