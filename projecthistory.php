<?php
    $db = pg_connect("host=localhost port=5432 dbname=Crowdfunding user=postgres password=1234");
    if(!$db){
        echo "connection failed?";
    }
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title> project history</title>
    </head>
    <body>
        <?php
		    $query = "select * from start_project where en_id = '$_SESSION[userid]' ";
            $result = pg_query($db,$query);
            $rownum = pg_num_rows($result);		
		for($i = 0; $i < $rownum; $i = $i + 1){
			$row = pg_fetch_assoc($result);
			$p_id = $row['project_id'];
			$p_name = $row['title'];
			$p_invest = $row['current_invest'];
			$p_state = $row['state'];
			echo "<li>$p_name</li>";
            $query2 = "select * from invest where p_id = '$p_id' ";
            $result2 = pg_query($db, $query2);
            $rownum2 = pg_num_rows($result2);
			if($rownum2 == 0){
			   echo"No Investment!";	
			}else{
		       echo"<table style = 'text-align:left;' border= '1'>
                 <tr><th>in_id</th><th>date</th><th>round</th><th>amount</th></tr>";
              for($j = 1; $j < $rownum+1; $j = $j + 1){
                 $row2 = pg_fetch_assoc($result2);
                 $in_id = $row2['in_id'];
                 $date = $row2['invest_date'];
                 $amount = $row2['amount'];
                 $round = $row2['round'];
               echo "<tr><td>$in_id</td><td>$date</td><td>$round</td><td>$amount</td></tr>";
            }
               echo"</table>";
			}
			if($p_state){
			   echo"<br><input type='submit' name='new' value = 'close'/></br> ";
			   if($_POST['new']){
		        $query3 = "update start_project set state = false where project_id = $p_id";
                $result3 = pg_query($db,$sql_updatep);
			   }
			}
			
		}
        ?>        
    </body>
</html>