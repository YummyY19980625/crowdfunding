<!DOCTYPE html>  
<head>
  <title>Pearsonal Information Edit</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>li {list-style: none;}</style>
</head>
<body>
  <h2>Personal Information</h2>

  <?php

    $id = $_SESSION['userid'];
  	// Connect to the database. Please change the password in the following line accordingly
    $db     = pg_connect("host=localhost port=5432 dbname=Crowdfunding user=postgres password=980412");	
    $result = pg_query($db, "SELECT * FROM investor_is where i_id = '$_SESSION[userid]'");// Query template
    if($result){
        echo "<script>alert('get info $SESSION[userid]');</script>";
    }
    $row    = pg_fetch_assoc($result);		// To store the result row
      
      echo "<ul><form name='update' action='profile_inv.php' method='POST' >  
    	<li>Name:</li>  
    	<li><input type='text' name='Name_updated' value='$row[name]' /></li>  
    	<li>Email:</li>  
    	<li><input type='text' name='Email_updated' value='$row[email]' /></li>  
    	<li>Contact number:</li><li><input type='text' name='Contact_number_updated' value='$row[contact_number]' /></li>    
    	<li><input type='submit' name='new' /></li>  
    	</form>  
    	</ul>";

    if (isset($_POST['new'])) {	// Submit the update SQL command
        $result = pg_query($db, "UPDATE investor_is SET name = '$_POST[Name_updated]',  
    email = '$_POST[Email_updated]',contact_number = '$_POST[Contact_number_updated]'");
        if (!$result) {
            echo "Update failed!!";
        } else {
            echo "Update successful!";
        }
    }
    ?>  
</body>
</html>
