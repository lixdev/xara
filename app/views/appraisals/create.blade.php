@extends('layouts.main')

{{HTML::script('media/jquery-1.8.0.min.js') }}

<script type="text/javascript">
 function totalBalance() {
      var score = document.getElementById("score").value;
      var max = document.getElementById("maxscore").value;
      if(parseFloat(score)>parseFloat(max)){
      alert("Employee Score exceeds maximum question rate!");
      document.getElementById("score").value = 0;
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
  <h3>New Appraisal</h3>

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

		 <form method="POST" action="{{{ URL::to('Appraisals') }}}" accept-charset="UTF-8">
   
        <fieldset>
         <input class="form-control" placeholder="" type="hidden" name="employee_id" id="employee_id" value="{{$id}}">
                
                    

        <div class="form-group">
                        <label for="username">Appraisal <span style="color:red">*</span></label>
                        <select name="appraisal_id" id="appraisal_id" class="form-control">
                           <option></option>
                            @foreach($appraisals as $appraisal)
                            <option value="{{ $appraisal->id }}"> {{ $appraisal->question }}</option>
                            @endforeach
                        </select>
                
                    </div>      


                    <div class="form-group">
                        <label for="username">Performance Rating <span style="color:red">*</span></label>
                        <select name="performance" class="form-control">
                           <option></option>
                            <option value="Outstanding">Outstanding</option>
                            <option value="Exceeds Expectations">Exceeds Expectations</option>
                            <option value="Meets Expectations">Meets Expectations</option>
                            <option value="Needs Improvements">Needs Improvements</option>
                            <option value="Unsatisfactory">Unsatisfactory</option>
                            <option value="Not Applicable">Not Applicable</option>
                        </select>
                
                    </div>        

        <div class="form-group">
            <label for="username">Score<span style="color:red">*</span></label>
            <table>
            <tr>
            <td width="120">
            <input class="form-control maxsize" placeholder="" onkeypress="totalBalance()" onkeyup="totalBalance()" type="text" name="score" id="score" value="{{{ Input::old('score') }}}">
            </td>
            <td width="60">
            out of
            </td>
            <td>
            <input class="form-control" readonly placeholder="" type="text" name="maxscore" id="maxscore" >
            </td>
            </tr>
            </table>
        </div>

        <div class="form-group">
            <label for="username">Examiner</label>
            <input class="form-control" readonly placeholder="" type="text" name="examiner" id="examiner" value="{{Confide::user()->username}}">
        </div>
        
        <div class="form-group">
            <label for="username">Date </label>
            <input class="form-control" readonly placeholder="" type="text" name="date" id="date" value="{{date('Y-m-d')}}">
        </div>

         <div class="form-group">
            <label for="username">Comment</label>
            <textarea class="form-control" placeholder="" name="comment" id="comment">{{{ Input::old('comment') }}}</textarea>
        </div>
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create Appraisal</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>


@stop