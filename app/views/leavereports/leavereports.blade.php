@extends('layouts.leave')
@section('content')
<br/>





<div class="row">
    <div class="col-lg-12">
  <h3>Leave Reports</h3>

<hr>
</div>  
</div>


<div class="row">
    <div class="col-lg-12">

    <ul>

       <li>
            <a href="{{ URL::to('leaveReports/selectApplicationPeriod') }}" target="_blank"> Leave Application</a>
       </li>

       <li>
          <a href="{{ URL::to('leaveReports/selectApprovedPeriod') }}" target="_blank">Leaves Approved</a>
       </li>

       <li>
          <a href="{{ URL::to('leaveReports/selectRejectedPeriod') }}" target="_blank">Leaves Rejected</a>
       </li>

       <li>
          <a href="{{ URL::to('leaveReports/selectLeave') }}" target="_blank">Leaves Balances</a>
       </li>
    
       <li>
          <a href="{{ URL::to('leaveReports/selectLeaveType') }}" target="_blank"> Employees on Leave</a>
       </li>  

       <li>
         <a href="{{ URL::to('leaveReports/selectEmployee') }}" target="_blank"> Individual Employee </a>     
       </li>  

       <li>
        <a href="reports/blank" target="_blank">Blank report template</a>
      </li>
    </ul>

  </div>

</div>

@stop