<?php 
session_start();
if($_SESSION['krishi_login']==1){
}else{
 echo "<script>location='index.php'</script>";  
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

<h3 style="text-align:center;margin-top:5%">Verified Subcategories</h3>
<table align="center">
<thead>
  <tr>
    <th>Category</th>
    <th>Sub Category</th>
    <!-- <th>Action</th> -->
  </tr>
</thead>
<tbody>
<?php 
for ($x = 0; $x < count($arr3['results']); $x++) { ?>

  <tr>
    <td><?php echo $arr3['results'][$x]['category']; ?></td>
    <td><?php echo $arr3['results'][$x]['sub_category']; ?></td>
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