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

<script>
function myFunction2() {
  /*alert('hi');*/
    var s_f= document.getElementById('fees').value;
    var rgx_f = /[^\d.]|\.(?=.*\.)/g;
    var x_f= rgx_f.test(s_f);
   
    if(x_f == true){
        alert('Enter value between 00.00 - 99.99');
      
    }
    else{
      document.getElementById("update_fees").click();
    }
}
</script>


<form method="post" action="verified.php">
            <input type="number" min="00.00" max="99.99" step="0.01" name="fees" id="fees" value="" placeholder="00.00-99.99 %"></input>
             <button style="display:none;visibility:hidden" name="update_fees" id="update_fees" type="submit">Update Fees</button>
            </div>
</form>
<button onclick="myFunction2()">Update Fees</button>

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


<script>
function myFunction3(k) {
    var s_c= document.getElementById('commission'+k).value;
    var rgx_c = /[^\d.]|\.(?=.*\.)/g;
    var x_c= rgx_c.test(s_c);
     /*alert(x); */
   
    if(x_c == true){
      /*alert('true');*/
        alert('Enter value between 00.00 - 99.99');
      
    }
    else{
      document.getElementById("update_commission"+k).click();
    }
}
</script>
          <form method="post" action="verified.php">
                 <input type="hidden" name="pk_commission" value="<?php echo $arr3['results'][$x]['pk']; ?>"></input>
                  <input type="number" min="00.00" max="99.99" step="0.01" style="width:50%" id="commission<?php echo $x; ?>" name="commission" value="" placeholder="00.00-99.99 %" required></input>
                   <button style="display:none;visibility:hidden" name="update_commission" id="update_commission<?php echo $x; ?>" type="submit">Update Commission</button>
                  </div>
          </form>
          <button onclick="myFunction3('<?php echo $x; ?>')">Update Commission</button>
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