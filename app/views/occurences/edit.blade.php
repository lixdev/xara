@extends('layouts.main')
@section('content')
<br/>

<div class="row">
    <div class="col-lg-12">
  <h3>Update Occurence</h3>

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

         <form method="POST" action="{{{ URL::to('occurences/update/'.$occurence->id) }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label for="username">Occurence Brief <span style="color:red">*</span> </label>
            <input class="form-control" placeholder="" type="text" name="brief" id="brief" value="{{{ $occurence->occurence_brief }}}">
        </div>
       
      <input class="form-control" placeholder="" type="hidden" readonly name="employee" id="employee" value="{{ $occurence->employee->id }}"> 

        <div class="form-group">
                        <label for="username">Occurence Type: <span style="color:red">*</span></label>
                        <select name="type" class="form-control">
                           <option></option>
                           <option value="Absentism/Abandonment"<?= ($occurence->occurence_type=='Absentism/Abandonment')?'selected="selected"':''; ?>> Absentism/Abandonment</option>
                           <option value="Abuse of Office"<?= ($occurence->occurence_type=='Abuse of Office')?'selected="selected"':''; ?>> Abuse of Office</option>
                           <option value="Assessment"<?= ($occurence->occurence_type=='Assessment')?'selected="selected"':''; ?>> Assessment </option>
                           <option value="Corruption"<?= ($occurence->occurence_type=='Corruption')?'selected="selected"':''; ?>> Corruption </option>
                           <option value="Emergency Drill"<?= ($occurence->occurence_type=='Emergency Drill')?'selected="selected"':''; ?>> Emergency Drill </option>
                           <option value="Incompetence"<?= ($occurence->occurence_type=='Incompetence')?'selected="selected"':''; ?>> Incompetence </option>
                           <option value="Initiative"<?= ($occurence->occurence_type=='Initiative')?'selected="selected"':''; ?>> Initiative </option>
                           <option value="Innovation"<?= ($occurence->occurence_type=='Innovation')?'selected="selected"':''; ?>> Innovation </option>
                           <option value="Insubordination"<?= ($occurence->occurence_type=='Insubordination')?'selected="selected"':''; ?>> Insubordination </option>
                           <option value="Intoxication"<?= ($occurence->occurence_type=='Intoxication')?'selected="selected"':''; ?>> Intoxication </option>
                           <option value="Meeting"<?= ($occurence->occurence_type=='Meeting')?'selected="selected"':''; ?>> Meeting </option>
                           <option value="Promotion"<?= ($occurence->occurence_type=='Promotion')?'selected="selected"':''; ?>> Promotion </option>
                           <option value="Team Building"<?= ($occurence->occurence_type=='Team Building')?'selected="selected"':''; ?>> Team Building </option>
                           <option value="Theft"<?= ($occurence->occurence_type=='Theft')?'selected="selected"':''; ?>> Theft </option>
                           <option value="Training"<?= ($occurence->occurence_type=='Training')?'selected="selected"':''; ?>> Training </option>
                           <option value="Violence"<?= ($occurence->occurence_type=='Violence')?'selected="selected"':''; ?>> Violence </option>
                        </select>
                
                    </div>     
        
        <div class="form-group">
            <label for="username">Occurence Narrative </label>
            <textarea class="form-control" name="narrative">{{{ $occurence->narrative }}}</textarea>
        </div>

        <div class="form-group">
                        <label for="username">Occurence Date <span style="color:red">*</span></label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker"  readonly="readonly" placeholder="" type="text" name="date" id="date" value="{{{ $occurence->occurence_date }}}">
                        </div>
                        </div>

        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Edit Occurence</button>
        </div>

    </fieldset>
</form>
        

  </div>

</div>
























@stop