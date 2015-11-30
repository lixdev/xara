<!DOCTYPE html>
<html>



<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>XARA </title>

    <!-- Core CSS - Include with every page -->
    {{ HTML::style('css/bootstrap.min.css') }}
    
   
   {{ HTML::style('font-awesome/css/font-awesome.css') }}
  

    <!-- Page-Level Plugin CSS - Blank -->

    <!-- SB Admin CSS - Include with every page -->
   
    {{ HTML::style('css/sb-admin.css') }}


    <!-- datatables css -->

    {{ HTML::style('media/css/jquery.dataTables.min.css') }}


    <!-- jquery scripts with datatable scripts -->

    
     {{ HTML::script('media/js/jquery.js') }}

    {{ HTML::script('media/js/jquery.dataTables.js') }}

    
   <script type="text/javascript">

  $(document).ready(function() {
    $('#users').DataTable();
    $('#mobile').DataTable();
    $('#rejected').DataTable();
    $('#app').DataTable();
    $('#disbursed').DataTable();
    $('#amended').DataTable();

	} );

 
  

</script>



</head>