<?php
include "config.php";    
include "util.php";     

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$player_id = $_GET['player_id'];

//Delete player contract
$ret = mysqli_query($conn, "delete from player_contract where player_id = $player_id");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}

//Delete player info
$ret = mysqli_query($conn, "delete from player where player_id = $player_id");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}

//Delete player stat
$ret = mysqli_query($conn, "delete from stat where player_id = $player_id");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=player_info_list.php'>";
}

?>