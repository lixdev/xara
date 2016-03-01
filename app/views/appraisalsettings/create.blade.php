@extends('layouts.hr')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>New Appraisal Question</h3>

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

		 <form method="POST" action="{{{ URL::to('AppraisalSettings') }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
                        <label for="username">Category <span style="color:red">*</span></label>
                        <select name="category" class="form-control">
                           <option></option>
                            <option value="Attendance and Punctuality">Attendance and Punctuality</option>
                            <option value="Communication">Communication</option>
                            <option value="Dependability">Dependability</option>
                            <option value="Individual Effectiveness">Individual Effectiveness</option>
                            <option value="Initiative">Initiative</option>
                            <option value="Job Knowledge">Job Knowledge</option>
                            <option value="Judgement and Decision Making">Judgement and Decision Making</option>
                            <option value="Ongoing Skill Improvement">Ongoing Skill Improvement</option>
                            <option value="Quality of Work">Quality of Work</option>
                            <option value="Safe Work Practise">Safe Work Practise</option>
                            <option value="Service Focus">Service Focus</option>
                            <option value="Team Building">Team Building</option>
                            <option value="Other Criteria">Other Criteria</option>
                        </select>
                
                    </div>        

        <div class="form-group">
            <label for="username">Question<span style="color:red">*</span> </label>
            <textarea class="form-control" name="question" id="question">{{{ Input::old('question') }}}</textarea>
        </div>

        <div class="form-group">
            <label for="username">Rate<span style="color:red">*</span></label>
            <input class="form-control" placeholder="" type="text" name="rate" id="rate" value="{{{ Input::old('rate') }}}">
        </div>
        
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create Appraisal Question</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>

@stop