@extends('layouts.payroll')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <h3>Update Employee Earning</h3>

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

		 <form method="POST" action="{{{ URL::to('other_earnings/update/'.$earning->id) }}}" accept-charset="UTF-8">
   
    <fieldset>
        <div class="form-group">
                       <div class="form-group">
            <label for="username">Employee</label>
            <input class="form-control" placeholder="" type="text" readonly name="employee" id="employee" value="{{ $earning->first_name.' '.$earning->last_name }}">
        </div> 
                
                    </div>


                    <div class="form-group">
                        <label for="username">Earning Type <span style="color:red">*</span></label>
                        <select name="earning" class="form-control">
                            <option></option>
                            <option value="Bonus"<?= ($earning->earnings_name=='Bonus')?'selected="selected"':''; ?>>Bonus</option>
                            <option value="Commission"<?= ($earning->earnings_name=='Commission')?'selected="selected"':''; ?>>Commission</option>
                            <option value="Others"<?= ($earning->earnings_name=='Others')?'selected="selected"':''; ?>>Others</option>
                        </select>
                
                    </div>

        <div class="form-group">
            <label for="username">Narrative <span style="color:red">*</span></label>
            <input class="form-control" placeholder="" type="text" name="narrative" id="narrative" value="{{ $earning->narrative}}">
        </div>


        <div class="form-group">
            <label for="username">Amount <span style="color:red">*</span></label>
            <input class="form-control" placeholder="" type="text" name="amount" id="amount" value="{{ $earning->earnings_amount}}">
            <script type="text/javascript">
           $(document).ready(function() {
           $('#amount').priceFormat();
           });
           </script>
        </div>

        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Update Employee Earning</button>
        </div>

    </fieldset>
</form>
		

  </div>

</div>
























@stop