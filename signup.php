<!DOCTYPE html>
<html>
<body>
    
    
    <?php
    if($_POST[type]=="investor"){
        header("Location:signupin.php");
        exit;
    } else if($_POST[type] == "entrepreneurs"){
        header("Location: signupen.php");
        exit;
    }
    
    ?>

</body>

</html>