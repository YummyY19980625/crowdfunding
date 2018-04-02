<?php
      session_start();
?>
<!DOCTYPE html>
<html>
<body>
<h2>Start Project</h2>
  <ul>
    <form name="display" action="startproject.php" method="POST" >
      <li>Project ID:</li>
      <li><input type="text" name="projectid" /></li>
      <li>Title:</li>
      <li><input type="text" name="title" /></li>
      <li>Start Date</li>
      <li><input type="text" name="startdate" /></li>
      <li>Description:</li>
      <li><input type="text" name="description" /></li>
      <li>Expected Investment:</li>
      <li><input type="text" name="expected" /></li>
      <li>Type:</li>
      <li><input type="text" name="type" /></li>
      <li>Enterprise ID:</li>
      <li><input type="text" name="enid" /></li>
      <li><input type="submit" name="submit" /></li>
    </form>
  </ul>
    <?php
    $db = pg_connect("host=localhost port=5432 dbname=Crowdfunding user=postgres password=980412");
    if(!$db){
        echo "connection failed?";
    }
	if(isset($_POST['submit'])){
	   $query = "insert into start_project values('$_POST[projectid]','$_POST[title]','$_POST[startdate]','true','$_POST[description]','0','$_POST[expected]','$_POST[type]','$_POST[enid]')";
	   $result = pg_query($db, $query);
	   if(!$result){
		   echo "Failed!";
	   }else{
		   echo "Successful!";
	   }
    }    
    ?>
</body>
</html>