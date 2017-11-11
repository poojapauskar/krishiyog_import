<?php 
session_start();
if($_SESSION['krishi_login']==1){
}else{
 echo "<script>location='index.php'</script>";	
}
?>


<?php

/*if(isset($_POST['pk'])){
      $url_delete = 'https://krishi-udyog.herokuapp.com/delete_a_produce/';
      $options_delete = array(
        'http' => array(
          'header'  => array(
                  'PRODUCE-ID: '.$_POST['pk'],
                ),
          'method'  => 'GET',
        ),
      );
      $context_delete = stream_context_create($options_delete);
      $output_delete = file_get_contents($url_delete, false,$context_delete);

      $arr_delete = json_decode($output_delete,true);
}*/

?>

<?php
$url3 = 'https://krishi-udyog.herokuapp.com/get_farmers_produce/';
$options3 = array(
  'http' => array(
    'method'  => 'GET',
  ),
);
$context3 = stream_context_create($options3);
$output3 = file_get_contents($url3, false,$context3);
/*echo $output3;*/
$arr3 = json_decode($output3,true);
// echo $arr3['data'][0]['location_details']['taluka'];

?>

<style type="text/css">
  thead,td,th{
      border: 1px solid #1976D2 ;
      
  }
    
th, td {
    width: 220px;
    text-align:left;
}

th{font-size: 18px}
td{font-size: 15px}

thead, tbody { display: block; }

tbody {
    height: 433px;       /* Just for the demo          */
    overflow-y: auto;    /* Trigger vertical scroll    */
    overflow-x: hidden;  /* Hide the horizontal scroll */
}


</style>

<a href="home.php">Back</a>

<h3 style="text-align:center;margin-top:5%">Produce List</h3>
<table align="center">
<thead>
  <tr>
    <!-- <th>Seller</th> -->
    <th>Category</th>
    <th>Sub Category</th>
   <!--  <th>Product Type</th> -->
    <th>Quality</th>
    <th>Quantity</th>
    <th>Rate</th>
    <th>Minimum Order Quantity</th>
    <th>Available Quantity</th>
    <th>Availability Date</th>
    <th>Available Upto</th>
  <!--   <th>Description</th> -->
    <th>Location</th>
    <th>Action</th>
  </tr>
</thead>
<tbody>
<?php 
for ($x = 0; $x < count($arr3['data']); $x++) { ?>

  <tr>
    <!-- <td><?php echo $arr3['data'][$x]['seller']['name']; ?></td> -->
    <td><?php echo $arr3['data'][$x]['category']['c_type']; ?></td>
    <td><?php echo $arr3['data'][$x]['sub_category_details']['sc_type']; ?></td>
   <!--  <td><?php echo $arr3['data'][$x]['product_details']['p_type']; ?></td> -->
    <td><?php echo $arr3['data'][$x]['product_details']['quality']; ?></td>
    <td><?php echo $arr3['data'][$x]['product_details']['quantity']." ".$arr3['data'][$x]['product_details']['q_unit']; ?></td>
    <td><?php echo $arr3['data'][$x]['product_details']['rate']." ".$arr3['data'][$x]['product_details']['r_unit']; ?></td>
    <td><?php echo $arr3['data'][$x]['product_details']['min_order_quantity']." ".$arr3['data'][$x]['product_details']['mq_unit']; ?></td>
    <td><?php echo $arr3['data'][$x]['product_details']['available_quantity']." ".$arr3['data'][$x]['product_details']['aq_unit']; ?></td>
    <td><?php echo $arr3['data'][$x]['product_details']['availability_date']; ?></td>
    <td><?php echo $arr3['data'][$x]['product_details']['available_upto']; ?></td>
   <!--  <td><?php echo $arr3['data'][$x]['product_details']['description']; ?></td> -->
    <td><?php echo $arr3['data'][$x]['location_details']['city']; ?></td>
    <td>
        <form method="post" action="produce.php">
            <input type="hidden" name="pk" value="$arr3['data'][$x]['product_details']['pk'];"></input>
            <button type="button" onclick="myFunction('<?php echo $x ?>');" style="margin-top:6% !important">Delete</button>
            <div style="visibility:hidden">
             <button class="hid1" name="submit<?php echo $x ?>" id="submit<?php echo $x ?>" type="submit"><button>
            </div>
        </form>
    </td>
<?php  } 
?>
<tbody>  
</table>

<script>
function myFunction(x) {
    var txt;
    var r = confirm("Do you want to delete the entry.");
    if (r == true) {
      document.getElementById("submit"+x).click();
    } else {
        
    }
}
</script>