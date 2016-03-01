@extends('layouts.hr')
@section('content')
<br/>

<div class="row">
    <div class="col-lg-12">
  <h3>Update Appraisal Question</h3>

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

         <form method="POST" action="{{{ URL::to('AppraisalSettings/update/'.$appraisal->id) }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
                        <label for="username">Category <span style="color:red">*</span></label>
                        <select name="category" class="form-control">
                           <option></option>
                            <option value="Attendance and Punctuality"<?= ($appraisal->category=='Attendance and Punctuality')?'selected="selected"':''; ?>>Attendance and Punctuality</option>
                            <option value="Communication"<?= ($appraisal->category=='Communication')?'selected="selected"':''; ?>>Communication</option>
                            <option value="Dependability"<?= ($appraisal->category=='Dependability')?'selected="selected"':''; ?>>Dependability</option>
                            <option value="Individual Effectiveness"<?= ($appraisal->category=='Individual Effectiveness')?'selected="selected"':''; ?>>Individual Effectiveness</option>
                            <option value="Initiative"<?= ($appraisal->category=='Initiative')?'selected="selected"':''; ?>>Initiative</option>
                            <option value="Job Knowledge"<?= ($appraisal->category=='Job Knowledge')?'selected="selected"':''; ?>>Job Knowledge</option>
                            <option value="Judgement and Decision Making"<?= ($appraisal->category=='Judgement and Decision Making')?'selected="selected"':''; ?>>Judgement and Decision Making</option>
                            <option value="Ongoing Skill Improvement"<?= ($appraisal->category=='Ongoing Skill Improvement')?'selected="selected"':''; ?>>Ongoing Skill Improvement</option>
                            <option value="Quality of Work"<?= ($appraisal->category=='Quality of Work')?'selected="selected"':''; ?>>Quality of Work</option>
                            <option value="Safe Work Practise"<?= ($appraisal->category=='Safe Work Practise')?'selected="selected"':''; ?>>Safe Work Practise</option>
                            <option value="Service Focus"<?= ($appraisal->category=='Service Focus')?'selected="selected"':''; ?>>Service Focus</option>
                            <option value="Team Building"<?= ($appraisal->category=='Team Building')?'selected="selected"':''; ?>>Team Building</option>
                            <option value="Other Criteria"<?= ($appraisal->category=='Other Criteria')?'selected="selected"':''; ?>>Other Criteria</option>
                        </select>
                
                    </div>        

        <div class="form-group">
            <label for="username">Question<span style="color:red">*</span> </label>
            <textarea class="form-control" name="question" id="question">{{$appraisal->question}}</textarea>
        </div>

        <div class="form-group">
            <label for="username">Rate<span style="color:red">*</span></label>
            <input class="form-control" placeholder="" type="text" name="rate" id="rate" value="{{$appraisal->rate}}">
        </div>
        
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Update Appraisal Question</button>
        </div>

    </fieldset>
</form>
        

  </div>

</div>

@stop