<html >



<head>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style type="text/css">

table {
  max-width: 100%;
  background-color: transparent;
}
th {
  text-align: left;
}
.table {
  width: 100%;
  margin-bottom: 50px;
}
hr {
  margin-top: 1px;
  margin-bottom: 2px;
  border: 0;
  border-top: 2px dotted #eee;
}

body {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 12px;
  line-height: 1.428571429;
  color: #333;
  background-color: #fff;
}



 @page { margin: 170px 30px; }
 .header { position: top; left: 0px; top: -150px; right: 0px; height: 150px;  text-align: center; }
 .content {margin-top: -100px; margin-bottom: -150px}
 .footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 50px;  }
 .footer .page:after { content: counter(page, upper-roman); }



</style>

</head>

<body>

  <div class="header" style="margin-top:-150px">
     <table >

      <tr>

<td style="width:150px">

            
    
        </td>


        <td>
        <strong>

          {{ strtoupper($organization->name)}}
          </strong><br>
          {{ $organization->phone}}<br>
          {{ $organization->email}}<br>
          {{ $organization->website}}<br>
          {{ $organization->address}}
       

        </td>
        

      </tr>


        <td>
          

        </td>
        

      </tr>


      <tr>

        <hr>
      </tr>



    </table>
   </div>


<br>
<div class="footer">
     <p class="page">Page <?php $PAGE_NUM ?></p>
   </div>







	<div class="content" style="margin-top:-70px">


     



   <div align="center"><strong>Employee List Report</strong></div><br>



    <table class="table table-bordered">

      <tr>
        


        <td><strong>Number </strong></td>
        <td><strong>Employee Name</strong></td>
        <td><strong>Leave Type</strong></td>
        <td><strong>Start Date</strong></td>
        <td><strong>End Date</strong></td>
        <td><strong>Leave Days</strong></td>
       
       </tr>
       <?php $i =1;?>

      @foreach($leaveapplications as $leave)
      @if($leave->is_approved)
      <tr>
       <td>{{$i}}</td>
        <td>{{$leave->employee->name}}</td>
        <td>{{$leave->leavetype->name}}</td>
        <td>{{$leave->actualstart_date}}</td>
        <td>{{$leave->actualend_date}}</td>
        <td>{{$leave->leave_days}}</td>
        </tr>

      <?php $i++; ?>
   @endif
    @endforeach

    
     


    </table>

<br><br>

    





   
</div>


</body>

</html>
