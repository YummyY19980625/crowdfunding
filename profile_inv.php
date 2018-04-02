<!DOCTYPE html>

<html>

<body>

    

    <h2>Profile</h2>

    <?php
    session_start();
    $db = pg_connect("host=localhost port=5432 dbname=Crowdfunding user=postgres password=980412");
    if(!$db){
        echo "connection failed?<br>";
    }
    
    $id = $_SESSION["userid"];
    
    $sql1 = "select * from Investor_Is where i_id = '$id'";
    $result1 = pg_query($db,$sql1);
    $name = pg_fetch_assoc($result1);
    echo "<br>Name: $name[name] <br>";
    echo "<br>Email: $name[email] <br>";
    echo "<br>Contact number: $name[contact_number] <br>";
    echo "<br>Current asset: $name[asset] <br>";
    ?>



</body>



</html>