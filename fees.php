<?php 
session_start();
if($_SESSION['krishi_login']==1){
}else{
 echo "<script>location='index.php'</script>";  
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

<html>
<body>

<a href="home.php">Back</a>

<h4>Fees: <?php echo $f1; ?></h4>

<form method="post" action="fees.php">
            <input type="text" name="fees" value="" placeholder="0-100 %"></input>
             <button name="update_fees" id="update_fees" type="submit">Update Fees</button>
            </div>
</form>
	
</body>
</html>