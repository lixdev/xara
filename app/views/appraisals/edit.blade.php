@extends('layouts.main')

{{HTML::script('media/jquery-1.8.0.min.js') }}

<script type="text/javascript">
 function totalBalance() {
      var score = document.getElementById("score").value;
      var max = document.getElementById("maxscore").value;
      if(parseFloat(score)>parseFloat(max)){
      alert("Employee Score exceeds maximum question rate!");
      document.getElementById("score").value = {{$appraisal->rate}};
      }
}

</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#appraisal_id').change(function(){
        $.get("{{ url('api/score')}}", 
        { option: $(this).val() }, 
        function(data) {
                $('#maxscore').val(data);
            });
        });
   });
</script>

<style type="text/css">
#maxscore,#score{
width:100px;
}
</style>

@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Update Appraisal</h3>

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

		 <form method="POST" action="{{{ URL::to('Appraisals/update/'.$appraisal->id) }}}" accept-charset="UTF-8">
   
    <fieldset>

            <input class="form-control" placeholder="" type="hidden" readonly name="employee_id" id="employee_id" value="{{ $appraisal->employee->id}}"> 

        <div class="form-group">
                        <label for="username">Appraisal <span style="color:red">*</span></label>
                        <select name="appraisal_id" id="appraisal_id" class="form-control">
                           <option></option>
                            @foreach($appraisalqs as $appraisalq)
                            <option value="{{ $appraisalq->id }}"<?= ($appraisal->appraisalquestion_id==$appraisalq->id)?'selected="selected"':''; ?>> {{ $appraisalq->question }}</option>
                            @endforeach
                        </select>
                
                    </div>      


                    <div class="form-group">
                        <label for="username">Performance Rating <span style="color:red">*</span></label>
                        <select name="performance" class="form-control">
                           <option></option>
                            <option value="Outstanding"<?= ($appraisal->performance=='Outstanding')?'selected="selected"':''; ?>>Outstanding</option>
                            <option value="Exceeds Expectations"<?= ($appraisal->performance=='Exceeds Expectations')?'selected="selected"':''; ?>>Exceeds Expectations</option>
                            <option value="Meets Expectations"<?= ($appraisal->performance=='Meets Expectations')?'selected="selected"':''; ?>>Meets Expectations</option>
                            <option value="Needs Improvements"<?= ($appraisal->performance=='Needs Improvements')?'selected="selected"':''; ?>>Needs Improvements</option>
                            <option value="Unsatisfactory"<?= ($appraisal->performance=='Unsatisfactory')?'selected="selected"':''; ?>>Unsatisfactory</option>
                            <option value="Not Applicable"<?= ($appraisal->performance=='Not Applicable')?'selected="selected"':''; ?>>Not Applicable</option>
                        </select>
                
                    </div>        

        <div class="form-group">
            <label for="username">Score<span style="color:red">*</span></label>
            <table>
            <tr>
            <td width="120">
            <input class="form-control maxsize" placeholder="" onkeypress="totalBalance()" onkeyup="totalBalance()" type="text" name="score" id="score" value="{{$appraisal->rate}}">
            </td>
            <td width="60">
            out of
            </td>
            <td>
            <input class="form-control" readonly placeholder="" type="text" name="maxscore" id="maxscore" value="{{Appraisalquestion::getScore($appraisal->appraisalquestion_id)}}">
            </td>
            </tr>
            </table>
        </div>

        <div class="form-group">
            <label for="username">Examiner</label>
            <input class="form-control" readonly placeholder="" type="text" name="examiner" id="examiner" value="{{$user->username}}">
        </div>
        
        <div class="form-group">
            <label for="username">Date </label>
            <input class="form-control" readonly placeholder="" type="text" name="date" id="date" value="{{$appraisal->appraisaldate}}">
        </div>

         <div class="form-group">
            <label for="username">Comment</label>
            <textarea class="form-control" placeholder="" name="comment" id="comment">{{$appraisal->comment}}</textarea>
        </div>
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Update Appraisal</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>


@stop