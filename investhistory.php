<?php
    $db = pg_connect("host=localhost port=5432 dbname=Crowdfunding user=postgres password=980412");
    if(!$db){
        echo "connection failed?";
    }
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title> invest history</title>
    </head>
    
    <body>
        
            <table style = 'text-align:left;' border= '1'>
                <tr><th>in_id</th><th>project_id</th><th>date</th><th>round</th><th>amount</th></tr>
        <?php
            $sql = "select * from invest where in_id = '$_SESSION[userid]' ";
            $result = pg_query($db,$sql);
            $datarow = pg_num_rows($result);
            for($i = 0; $i<$datarow; $i = $i + 1){
                $row = pg_fetch_assoc($result);
                $in_id = $row['in_id'];
                $project_id = $row['p_id'];
                $date = $row['invest_date'];
                $round = $row['round'];
                $amount = $row['amount'];
                echo "<tr><td>$in_id</td><td>$project_id</td><td>$date</td><td>$round</td><td>$amount</td></tr>";
            }
                echo "<tr><td>$datarow</td><td>$_SESSION[userid]</td><td>0</td><td>0</td><td>0</td></tr>";

        ?>
        </table>            
    </body>
</html>