<?php
date_default_timezone_set('Asia/Singapore');
$db = pg_connect("host=localhost port=5432 dbname=Crowdfunding user=postgres password=980412");
    if(!$db){
        echo "connection failed?";
    }
session_start();
?>

<!DOCTYPE html>

<body>
    <h2>invest</h2>
    
    <?php
    
    $id = $_SESSION['userid'];
    $date = date("Y-m-d");
    
    $flag = false;
    $flag_1 = false;
    $flag_2 = false;
    
    echo "<ul><form acction=invest.php method='POST' >  
    	<li>project_id:</li>  
    	<li><input type='text' name='pid'/></li>  
    	<li>amount:</li>  
    	<li><input type='number' name='amount'/></li>  
    	<li>start_date: '$date'</li>
        <li>your id: '$id'</li>
    	<li><input type='submit' name='new' /></li> 
    	</form>  
    	</ul>";
    
    if(isset($_POST['new'])){
        $sql_1 = "select * from start_project
                where project_id = '$_POST[pid]'";
        $result_1= pg_query($db,$sql_1);
        $row_1 = pg_fetch_assoc($result_1);
        if(!$result_1){
            echo "<script>alert('project not exist!');</script>";
        } else if($row_1['state'] =='f'){
            echo "<script>alert('project is closed!');</script>";
        }else{
            $flag = true;
        }
        //---------------------------------------------------------
        $sql_2 = "select asset  from investor_is where i_id = '$id'";
        $result_2 = pg_query($db,$sql_2);
        $row_2 = pg_fetch_assoc($result_2);
        if($row_2['asset'] >= $_POST['amount'] && $_POST['amount']>=0){
            $flag_2 = true;
        } else{
            echo "<script>alert(' $id $row_2[asset]! ');</script>";
        }
        //------------------------------------------------------------
        $sql_3 = "select count(*) as current
             from invest
             group by in_id, p_id
             having in_id = '$id' and p_id = '$_POST[pid]'";
        $result_3 = pg_query($db,$sql_3);
        $row_3 = pg_fetch_assoc($result_3);
        $round = $row_3['current'] + 1;
        //-------------------------------------------------------------
        $sql_4 = "select sum(amount) as total
                  from invest
                  group by in_id,p_id
                  where in_id = '$id' and p_id ='$_POST[pid]'";
        $result_s = pg_query($db,$sql_4);
        $row_s = pg_fetch_assoc($result_s);
        $sum = $row_s['total'];
        if($_POST['amount']<0 && $sum + $_POST['amount']>=0){
            $flag_2 = true;
        } else{
            echo "<script>alert(' cannot retrieve! ');</script>";
        }
        //-------------------------------------------------------------
        if($flag == true && $flag_2 == true){
            $sql_insert = "insert into invest values('$date', '$_POST[amount]', $round,'$id','$_POST[pid]')";  
            $result_4 = pg_query($db,$sql_insert);
            //----------------------------------------------
            $sql_updatei = "update investor_is
                            set asset = asset - $_POST[amount]
                            where i_id = '$id'";
            $result_5 = pg_query($db,$sql_updatei);
            //----------------------------------------------
            $sql_updatep = "update start_project set current_invest = current_invest + $_POST[amount] where project_id = '$_POST[pid]'";
            $result_6 = pg_query($db,$sql_updatep);
            //----------------------------------------------
            echo "<script>alert('invest successful!');</script>";
            
        }    
    }
    
    ?>
    <a href="investhistory.php">invest history</a>
    <a href="logout.php">log out</a>
</body>
</html>