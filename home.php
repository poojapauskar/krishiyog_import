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

if(isset($_POST['approve_btn'])){
      $url_approve = 'https://krishi-udyog.herokuapp.com/approve_unverified_subcategory/';
      $options_approve = array(
        'http' => array(
          'header'  => array(
                  'PK: '.$_POST['pk_approve'],
                ),
          'method'  => 'GET',
        ),
      );
      $context_approve = stream_context_create($options_approve);
      $output_approve = file_get_contents($url_approve, false,$context_approve);

      $arr_approve = json_decode($output_approve,true);
}

?>

<?php

if(isset($_POST['disapprove_btn'])){
      $url_approve = 'https://krishi-udyog.herokuapp.com/disapprove_unverified_subcategory/';
      $options_approve = array(
        'http' => array(
          'header'  => array(
                  'PK: '.$_POST['pk_disapprove'],
                ),
          'method'  => 'GET',
        ),
      );
      $context_approve = stream_context_create($options_approve);
      $output_approve = file_get_contents($url_approve, false,$context_approve);

      $arr_approve = json_decode($output_approve,true);
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

<a href="logout.php">Logout</a>
<br>
<br>

  <button onClick="window.location.href = 'verified.php';" class="btn btn-success" style="color:white;background-color:green;width:205px;height:40px">
    Admin Added Categories
    </button>

 <!--  <button onClick="window.location.href = 'fees.php';" class="btn btn-success" style="color:white;background-color:green;width:100px;height:40px">
    Fees
    </button> -->

  <button onClick="window.location.href = 'produce.php';" class="btn btn-success" style="color:white;background-color:green;width:100px;height:40px">
    Produce
    </button>

  <br><br>

<h2>User Added Categories</h2>
<table>
<thead>
  <tr>
    <th>Category</th>
    <th>Sub Category</th>
    <th>Commission</th>
    <th>Approved</th>
    <th>Approve</th>
    <th>Update Commission</th>
    <th>Delete</th>
  </tr>
</thead>
<tbody>
<?php 
for ($x = 0; $x < count($arr3['results']); $x++) { ?>

  <tr>
    <td><?php echo $arr3['results'][$x]['category']; ?></td>
    <td><?php echo $arr3['results'][$x]['sub_category']; ?></td>
    <td><?php echo $arr3['results'][$x]['commission']; echo " %"; ?></td>

    <?php if($arr3['results'][$x]['approved'] == "1"){ ?>
      <td>Yes</td>
    <?php } ?>
    <?php if($arr3['results'][$x]['approved'] == "0"){ ?> 
      <td>No</td>
    <?php } ?>

    <td>
      <?php if($arr3['results'][$x]['approved'] == "0"){ ?> 
        <form method="post" action="home.php">
            <input type="hidden" name="pk_approve" value="<?php echo $arr3['results'][$x]['pk']; ?>"></input>
             <button name="approve_btn" id="approve_btn" type="submit">Approve</button>
            </div>
        </form>
      <?php } ?>
      <?php if($arr3['results'][$x]['approved'] == "1"){ ?>
        <form method="post" action="home.php">
            <input type="hidden" name="pk_disapprove" value="<?php echo $arr3['results'][$x]['pk']; ?>"></input>
             <button name="disapprove_btn" id="disapprove_btn" type="submit">Disapprove</button>
            </div>
        </form>
      <?php } ?>

    </td>
    <td>

<script type="text/javascript">
  function validate() {
    s= document.getElementById('commission');
    var rgx = /^[0-9]*\.?[0-9]*$/;
    alert(s.match(rgx));
}
</script>

<script>
function myFunction1() {
    var s= document.getElementById('commission').value;
    var rgx = /[^\d.]|\.(?=.*\.)/g;
    var x= rgx.test(s);
     /*alert(x); */
   
    if(x == true){
      /*alert('true');*/
        alert('Enter value between 00.00 - 99.99');
      
    }
    /*else if(s < 00.00 || s > 99.99){
       alert('Enter value between 00.00 - 99.99');
    }*/
    else{
      document.getElementById("update_commission").click();
    }

    /* }else{
      alert('false');
       alert('Enter value between 00.00 - 99.99');
       event.stopPropagation();
    }
    /*alert("hello");*/
   /* alert(/^[0-9]*\.?[0-9]*$/.test('abc'));*/
}
</script>
          <form method="post" action="home.php">
                 <input type="hidden" name="pk_commission" value="<?php echo $arr3['results'][$x]['pk']; ?>"></input>
                  <input type="number" pattern="^[0-9]([.])?$" min="00.00" max="99.99" step="0.01" style="width:50%" id="commission" name="commission" value="" placeholder="00.00-99.99 %" required></input>
                   <button style="display:none;visibility:hidden" onclick="myFunction1()" name="update_commission" id="update_commission" type="submit"></button>
                  </div>
          </form>
          <button onclick="myFunction1()">Update Commission</button>
                   
    </td>
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