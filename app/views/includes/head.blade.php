<!DOCTYPE html>
<html>



<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>XARA </title>

    <!-- Core CSS - Include with every page -->

    {{ HTML::style('jquery-ui-1.11.4.custom/jquery-ui.css') }}

    {{ HTML::style('css/bootstrap.min.css') }}
    
   
   {{ HTML::style('font-awesome/css/font-awesome.css') }}
  

    <!-- Page-Level Plugin CSS - Blank -->

    <!-- SB Admin CSS - Include with every page -->
   
    {{ HTML::style('css/sb-admin.css') }}



    <!-- datatables css -->

    {{ HTML::style('media/css/jquery.dataTables.min.css') }}

    {{ HTML::style('datepicker/css/bootstrap-datepicker.css') }}

    <style type="text/css">

   .right-inner-addon {
    position: relative;
   }
   .right-inner-addon input {
    padding-right: 30px;    
   }
   .right-inner-addon i {
    position: absolute;
    right: 0px;
    padding: 10px 12px;
    pointer-events: none;
   }

   .ui-datepicker {
    padding: 0.2em 0.2em 0;
    width: 550px;
   }
   </style>


    <!-- jquery scripts with datatable scripts -->

    
    {{ HTML::script('media/js/jquery.js') }}

    {{ HTML::script('media/js/jquery.dataTables.js') }}

    {{ HTML::script('datepicker/js/bootstrap-datepicker.js') }}

    {{HTML::script('js/price_format.js') }}

    
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

<script type="text/javascript">

$(function(){
$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-60y',
    endDate: '+0d',
    autoclose: true
});
});

</script>

<script type="text/javascript">

$(function(){
$('.datepicker3').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-60y',
    autoclose: true
});
});

</script>

<script type="text/javascript">
$(function(){
$('.datepicker1').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-60y',
    endDate: '-18y',
    autoclose: true
});
});
</script>

<script type="text/javascript">
$(function(){
$('.datepicker2').datepicker({
    format: "m-yyyy",
    startView: "months", 
    minViewMode: "months",
    autoclose: true
});
});
</script>



<script type="text/javascript">
$(function(){
$('.datepicker21').datepicker({
    format: "yyyy-mm-dd",
   
    autoclose: true
});
});
</script>

<script type="text/javascript">
$(function(){
$('.datepicker4').datepicker({
    format: "yyyy-mm-dd",
    startDate: '0y',
    autoclose: true
});
});
</script>

<script type="text/javascript">

$(function(){
$('.datepicker40').datepicker({
    format: 'd/m/yyyy',
    startDate: '-60y',
    endDate: '+0d',
    autoclose: true
});
});

</script>

</head>