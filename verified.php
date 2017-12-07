<?php 
session_start();
if($_SESSION['krishi_login']==1){
}else{
 echo "<script>location='index.php'</script>";  
}
?>

<?php

if(isset($_POST['update_commission'])){
      $url_commission = 'https://krishi-udyog.herokuapp.com/update_commission/';
      $options_commission = array(
        'http' => array(
          'header'  => array(
                  'PK: '.$_POST['pk_commission'],
                  'COMMISSION: '.$_POST['commission'],
                ),
          'method'  => 'GET',
        ),
      );
      $context_commission = stream_context_create($options_commission);
      $output_commission = file_get_contents($url_commission, false,$context_commission);

      $arr_commission = json_decode($output_commission,true);
}

?>

<?php

if(isset($_POST['update_fees'])){
      $url_fees = 'https://krishi-udyog.herokuapp.com/fees/';
      $options_fees = array(
        'http' => array(
          'header'  => array(
                  'FEES: '.$_POST['fees'],
                ),
          'method'  => 'GET',
        ),
      );
      $context_fees = stream_context_create($options_fees);
      $output_fees = file_get_contents($url_fees, false,$context_fees);

      $arr_fees = json_decode($output_fees,true);
}

?>

<?php
$url3 = 'https://krishi-udyog.herokuapp.com/get_fees/';
$options3 = array(
  'http' => array(
    'method'  => 'GET',
  ),
);
$context3 = stream_context_create($options3);
$output3 = file_get_contents($url3, false,$context3);
/*echo $output3;*/
$arr3 = json_decode($output3,true);

if($arr3['fees'] == ""){
  $f1= "0%";
}else{
  $f1= $arr3['fees']."%";
}

?>

<?php
$url3 = 'https://krishi-udyog.herokuapp.com/get_verified_subcategories/';
$options3 = array(
  'http' => array(
    'method'  => 'GET',
  ),
);
$context3 = stream_context_create($options3);
$output3 = file_get_contents($url3, false,$context3);

$arr3 = json_decode($output3,true);

?>

<style type="text/css">
  thead,td{
      border-top: 1px solid #1976D2 ;
      border-left: 1px solid #1976D2 ;
      border-right: 1px solid #1976D2 ;
      
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

<script type="text/javascript">
    
function set1(){
    document.getElementById("import_remove").value = "Import";
};
    
function set2(){
  document.getElementById("import_remove").value = "Remove";
};


</script>
<form enctype="multipart/form-data" action="upload.php" method="post" >
  
  <!-- <label style="margin-left:2%" class="form-label span3" for="file">Import Students</label><br><br>
   -->
   <input style="margin-top:2%" type="file" name="file" id="file" required />
   <input name="import_remove" id="import_remove" type="hidden"></input>
  
  
  <br><br>
  <button onClick="set1()" id="imp_btn" class="btn btn-success" style="color:white;background-color:green;width:100px;height:40px" type="submit">
    Import
    </button>

  <button onClick="set2()" id="rem_btn" class="btn btn-success" style="color:white;background-color:green;width:100px;height:40px" type="submit">
    Remove
    </button>


</form>

<h4>Fees: <?php echo $f1; ?></h4>

<form method="post" action="verified.php">
            <input type="number" min="-100" max="100" name="fees" value="" placeholder="0-100 %"></input>
             <button name="update_fees" id="update_fees" type="submit">Update Fees</button>
            </div>
</form>

<h3 style="text-align:center;margin-top:5%">Admin Added Categories</h3>
<table align="center">
<thead>
  <tr>
    <th>Category</th>
    <th>Sub Category</th>
    <th>Commission</th>
    <th>Update Commission</th>
  </tr>
</thead>
<tbody>
<?php 
for ($x = 0; $x < count($arr3['results']); $x++) { ?>

  <tr>
    <td><?php echo $arr3['results'][$x]['category']; ?></td>
    <td><?php echo $arr3['results'][$x]['sub_category']; ?></td>
    <td><?php echo $arr3['results'][$x]['commission']; echo " %"; ?></td>
    <td>
          <form method="post" action="verified.php">
                 <input type="hidden" name="pk_commission" value="<?php echo $arr3['results'][$x]['pk']; ?>"></input>
                  <input type="number" min="-100" max="100" style="width:50%" name="commission" value="" placeholder="0-100 %" required></input>
                   <button name="update_commission" id="update_commission" type="submit">Update Commission</button>
                  </div>
          </form>
    </td>
    <!-- <td>
    <form method="post" action="home.php">
        <input type="hidden" name="pk" value="<?php echo $arr3['results'][$x]['pk']; ?>"></input>
        <button type="button" onclick="myFunction('<?php echo $x ?>');" style="margin-top:6% !important">Delete</button>
        <div style="visibility:hidden">
         <button class="hid1" name="submit<?php echo $x ?>" id="submit<?php echo $x ?>" type="submit"><button>
        </div>
    </form>
    </td> -->

<?php  } 
?>
<tbody>  
</table>