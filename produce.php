<?php 
session_start();
if($_SESSION['krishi_login']==1){
}else{
 echo "<script>location='index.php'</script>";	
}
?>

<body>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<?php

if(isset($_POST['pk_delete'])){
      $url_delete = 'https://krishi-udyog.herokuapp.com/delete_a_produce/';
      $options_delete = array(
        'http' => array(
          'header'  => array(
                  'PRODUCE-ID: '.$_POST['pk_delete'],
                ),
          'method'  => 'GET',
        ),
      );
      $context_delete = stream_context_create($options_delete);
      $output_delete = file_get_contents($url_delete, false,$context_delete);

      $arr_delete = json_decode($output_delete,true);
}

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
    <th>Details</th>
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
            <input type="hidden" name="pk_delete" value="<?php echo $arr3['data'][$x]['product_details']['pk']; ?>"></input>
            <button type="button" onclick="myFunction('<?php echo $x ?>');" style="margin-top:6% !important">Delete</button>
            <div style="visibility:hidden">
             <button class="hid1" name="submit<?php echo $x ?>" id="submit<?php echo $x ?>" type="submit"><button>
            </div>
        </form>
    </td>
  
  <td>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal<?php echo $x ?>">Details</button>
  </td>
  <!-- Modal -->
  <div class="modal fade" id="myModal<?php echo $x ?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         
         <div style="text-align:center">
          <img style="max-height:250px;" src="<?php echo $arr3['data'][$x]['image_details']; ?>"></img>
         </div>

          <h3 style="font-weight:bold;text-align:center">Produce Details</h3>
          <p><b><b>Category</b></b> : <?php echo $arr3['data'][$x]['category']['c_type']; ?></p>
          <p><b>Sub Category</b> : <?php echo $arr3['data'][$x]['sub_category_details']['sc_type']; ?></p>
          <p><b>Product Type</b> : <?php echo $arr3['data'][$x]['product_details']['p_type']; ?></p>
          <p><b>Quality</b> : <?php echo $arr3['data'][$x]['product_details']['quality']; ?></p>
          <p><b>Quantity</b> : <?php echo $arr3['data'][$x]['product_details']['quantity']." ".$arr3['data'][$x]['product_details']['q_unit']; ?></p>
          <p><b>Available Quantity</b> : <?php echo $arr3['data'][$x]['product_details']['available_quantity']." ".$arr3['data'][$x]['product_details']['aq_unit']; ?></p>
          <p><b>Minimum Order Quantity</b> : <?php echo $arr3['data'][$x]['product_details']['min_order_quantity']." ".$arr3['data'][$x]['product_details']['mq_unit']; ?></p>
          <p><b>Rate</b> : <?php echo $arr3['data'][$x]['product_details']['rate']." ".$arr3['data'][$x]['product_details']['r_unit']; ?></p>
          <p><b>Availability Date</b> : <?php echo $arr3['data'][$x]['product_details']['availability_date']; ?></p>
          <p><b>Available Upto</b> : <?php echo $arr3['data'][$x]['product_details']['available_upto']; ?></p>
          <p><b>Description</b> : <?php echo $arr3['data'][$x]['product_details']['description']; ?></p>
          <p><b>CGST</b> : <?php echo $arr3['data'][$x]['product_details']['cgst']; ?></p>
          <p><b>SGST</b> : <?php echo $arr3['data'][$x]['product_details']['sgst']; ?></p>
          <p><b>IGST</b> : <?php echo $arr3['data'][$x]['product_details']['igst']; ?></p>
          <p><b>GST Description</b> : <?php echo $arr3['data'][$x]['product_details']['gst_description']; ?></p>
          <p><b>Chapter Head</b> : <?php echo $arr3['data'][$x]['product_details']['chap_head_subhead_tarrif']; ?></p>
          <p><b>Water Source</b> : <?php echo $arr3['data'][$x]['product_details']['water_source']; ?></p>
          <p><b>Type Of Farming</b> : <?php echo $arr3['data'][$x]['product_details']['type_of_farming']; ?></p>
          
          <h3 style="font-weight:bold;text-align:center">Location Details</h3>
          <p><b>State</b> : <?php echo $arr3['data'][$x]['location_details']['state']; ?></p>
          <p><b>District</b> : <?php echo $arr3['data'][$x]['category']['district']; ?></p>
          <p><b>City</b> : <?php echo $arr3['data'][$x]['category']['city']; ?></p>
          <p><b>Taluka</b> : <?php echo $arr3['data'][$x]['category']['taluka']; ?></p>
          <p><b>Pin Code</b> : <?php echo $arr3['data'][$x]['category']['pin_code']; ?></p>

          <h3 style="font-weight:bold;text-align:center">Seller Details</h3>
          <p><b>Name</b> : <?php echo $arr3['data'][$x]['seller']['name']; ?></p>
          <p><b>Email</b> : <?php echo $arr3['data'][$x]['seller']['email']; ?></p>
          <p><b>Mobile</b> : <?php echo $arr3['data'][$x]['seller']['mobile']; ?></p>
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>



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

</body>