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
            
            
            $_SESSION['status'] = 1;
            $_SESSION['userid'] = $id;
            $_SESSION['password'] = $password;
            $row = pg_fetch_assoc($result);
            echo"$row[isentre]";
            echo "<script>alert('login success $row[isentre]  $_SESSION[userid]');</script>";
            
            if($row['isentre'] == 't'){
                header("Location: profile_ent.php");
                exit;
            } else if($row['isentre'] == 'f'){
                header("Location: profile_inv.php");
                exit;
            }
            
             
        } else {
        
            echo "<script>alert('Unmatched username and password');</script>";
            
            
        }
    ?>

</body>

</html>
