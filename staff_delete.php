<?php
include "config.php";   
include "util.php";      

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$staff_id = $_GET['staff_id'];

//Delete staff contract
$ret = mysqli_query($conn, "delete from staff_contract where staff_id = $staff_id");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}

//Delete staff info
$ret = mysqli_query($conn, "delete from staff where staff_id = $staff_id");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=staff_list.php'>";
}

?>