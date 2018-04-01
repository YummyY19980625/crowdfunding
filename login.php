<!DOCTYPE html>
<html>
<body>
    
    
    <?php
    
    
        session_start();
        $_SESSION['status'] = 0;
        $con = pg_connect("host=localhost port=5432 dbname=Crowdfunding user=postgres password=980412");
        $id = $_POST["username"];
        $password = $_POST["password"];
    
    
        $q = "SELECT * from users where id = '$id' and password = '$password'";
        
        $result = pg_query($con, $q);
        $num = pg_num_rows($result);
        
        if ($num) {
            
            echo "<script>alert('login success');</script>";
            $_SESSION['status'] = 1;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
             
        } else {
        
            echo "<script>alert('Unmatched username and password');</script>";
            
            
        }
    ?>

</body>

</html>
