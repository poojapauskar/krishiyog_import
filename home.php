<?php 
session_start();
if($_SESSION['krishi_login']==1){
}else{
 echo "<script>location='index.php'</script>";	
}
?>

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