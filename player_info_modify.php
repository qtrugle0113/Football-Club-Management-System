<?php
include "config.php";    
include "util.php";     

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$player_id = $_POST['player_id'];
$name = $_POST['name'];
$dob = $_POST['dob'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$reg_num = $_POST['reg_num'];
$pos_id = $_POST['pos_id'];
$nationality = $_POST['nationality'];

$ret = mysqli_query($conn, "update player set name = '$name', dob = '$dob', height = '$height', weight = '$weight', reg_num = '$reg_num', pos_id = '$pos_id', nationality = '$nationality' where player_id = $player_id");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=player_info_list.php'>";
}

?>



