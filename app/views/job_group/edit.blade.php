@extends('layouts.hr')

<script type="text/javascript">
$(document).ready(function() {
  
    $('#order').change(function(){
     
        $.get("{{ url('api/benefits')}}", 
        { option: $(this).val() }, 
        function(data) {
          console.log('hi');
                $('#amountdue').val(data);
            });
        });
   });
</script>


@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Update Job Group</h3>

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

		 <form method="POST" action="{{{ URL::to('job_group/update/'.$jobgroup->id) }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
            <label for="username">Job Group Name <span style="color:red">*</span></label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{ $jobgroup->job_group_name}}">
        </div>

        <div class="form-group">
            <label for="username">Benefits</label><label for="username" style="margin-left:150px">Amount</label>
            <?php $i = 1; ?>
            @foreach($benefits as $benefit)
            <table>
            <tr><td width="200">
            <input type="checkbox" name="benefitid[]"<?= ($jobgroup->id==$benefit->jobgroup_id)?'checked="checked"':''; ?> id="{{'benefitid_'.$i}}" value="{{$benefit->id}}">
                             {{$benefit->benefit_name}}
            </td>
            <td>
            <input class="form-control" placeholder="" type="text" name="amount[]" id="{{'amount_'.$i}}" value="{{$jobgroup->employeebenefit->amount}}">
          
            </td>
            </tr>
            
            </table>

            <script type="text/javascript">
            $(document).ready(function(){
            $("#amount_"+<?php echo $i;?>).show();
            $('#benefitid_'+<?php echo $i;?>).click(function(){

            if($('#benefitid_'+<?php echo $i;?>).is(":checked")){
            $('#benefitid_'+<?php echo $i;?>+':checked').each(function(){

            $("#amount_"+<?php echo $i;?>).show();
            $("#amount_"+<?php echo $i;?>).val('0.00');
            });
            }else{
             $("#amount_"+<?php echo $i;?>).hide();
            }
            });
            $("#amount_"+<?php echo $i;?>).priceFormat();
            });
            </script>

            <?php $i++; ?>
            @endforeach
            </div>

        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Update Job Group</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>


@stop