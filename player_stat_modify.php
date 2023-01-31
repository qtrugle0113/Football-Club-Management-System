<?php
include "config.php";    
include "util.php";      

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$player_id = $_POST['player_id'];
$apps = $_POST['apps'];
$min_play = $_POST['min_play'];
$goal = $_POST['goal'];
$assist = $_POST['assist'];
$clean_sheet= $_POST['clean_sheet'];

$ret = mysqli_query($conn, "update stat set apps = '$apps', min_play = '$min_play', goal = '$goal', assist = '$assist', clean_sheet = '$clean_sheet' where player_id = '$player_id' ");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=player_stat_list.php'>";
}

?>



