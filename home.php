<?php 
/*session_start();
if($_SESSION['krishi_login']==1){
}else{
 echo "<script>location='index.php'</script>";	
}*/
?>

<?php

if(isset($_POST['pk'])){
      $url_delete = 'https://krishi-udyog.herokuapp.com/delete_subcategory/';
      $options_delete = array(
        'http' => array(
          'header'  => array(
                  'PK: '.$_POST['pk'],
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
$url3 = 'https://krishi-udyog.herokuapp.com/get_unverified_subcategories/';
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
    height: 400px;       /* Just for the demo          */
    overflow-y: auto;    /* Trigger vertical scroll    */
    overflow-x: hidden;  /* Hide the horizontal scroll */
}


</style>
<script type="text/javascript">
    
function set1(){
    document.getElementById("import_remove").value = "Import";
};
    
function set2(){
	document.getElementById("import_remove").value = "Remove";
};


</script>
<a href="logout.php">Logout</a>

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

<table>
<thead>
  <tr>
    <th>Category</th>
    <th>Sub Category</th>
    <th>Action</th>
  </tr>
</thead>
<tbody>
<?php 
for ($x = 0; $x < count($arr3['results']); $x++) { ?>

  <tr>
    <td><?php echo $arr3['results'][$x]['category']; ?></td>
    <td><?php echo $arr3['results'][$x]['sub_category']; ?></td>
    <td>
    <form method="post" action="home.php">
        <input type="hidden" name="pk" value="<?php echo $arr3['results'][$x]['pk']; ?>"></input>
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