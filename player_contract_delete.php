<?php
include "config.php";    
include "util.php";      

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$contract_id = $_GET['contract_id'];

//Delete contract
$ret = mysqli_query($conn, "update player_contract set exp_date = NULL, wage = NULL, time = NULL where contract_id = $contract_id");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=player_contract_list.php'>";
}

?>