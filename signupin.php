<?php
      session_start();
?>
<!DOCTYPE html>
<html>
<body>
    
    <?php
    $db = pg_connect("host=localhost port=5432 dbname=Crowdfunding user=postgres password=980412");
    if(!$db){
        echo "connection failed?";
    }
    
    ?>
    <?php 
        
        echo "<ul><form action = 'signupin.php' method='POST' >  
    	<li>id:</li>  
    	<li><input type='text' name='id'/></li>  
    	<li>password:</li>  
    	<li><input type='text' name='password'/><li>  
    	<li>name:</li>
        <li><input type='text' name='name' /></li>  
    	<li>email:</li>  
    	<li><input type='text' name='email'/></li>
        <li>phone number:</li>
        <li><input type='text' name='phone_number'/></li>  
        <li>asset:</li>
        <li><input type='number' name='asset'/></li>  
    	<li><input type='submit' name='new' /></li>  
    	</form>  
    	</ul>";
    
    if (isset($_POST['new'])) {	// Submit the update SQL command
        $sql = "insert into investor_is
                values('$_POST[id]','$_POST[name]','$_POST[email]','$_POST[phone_number]',$_POST[asset])";
        $sql_2 = "insert into users
                values('$_POST[id]','$_POST[password]',false)";
        
        $result_2 = pg_query($db, $sql_2);
        if (!$result_2) {
            header("Location: sighup.html");
            echo "<script>alert('step 1 failed');</script>";
            
            exit;
        } else {
            $result = pg_query($db, $sql);
            if(!result){
                header("Location: sighup.html");
                echo "<script>alert('step 2 failed');</script>";
                
                exit;
            } else{
                header("Location: login.html");
                echo "<script>alert('sign up successful');</script>";
                
                exit;
            }
        }
    
        
    }
     
    ?>
    
    

</body>

</html>
