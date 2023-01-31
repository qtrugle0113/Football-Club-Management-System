<?php
include "config.php";   
include "util.php";      

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$staff_id = $_POST['staff_id'];
$name = $_POST['name'];
$dob = $_POST['dob'];
$pos_id = $_POST['pos_id'];
$nationality = $_POST['nationality'];

$ret = mysqli_query($conn, "update staff set name = '$name', dob = '$dob', pos_id = '$pos_id', nationality = '$nationality' where staff_id = $staff_id");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=staff_list.php'>";
}

?>



