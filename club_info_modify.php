<?php
include "config.php";    
include "util.php";      

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$name = $_POST['name'];
$founded = $_POST['founded'];
$stadium = $_POST['stadium'];
$capacity = $_POST['capacity'];
$phone = $_POST['phone'];
$email = $_POST['email'];

$ret = mysqli_query($conn, "update club set founded = '$founded', stadium = '$stadium', capacity = '$capacity', phone = '$phone', email = '$email' where name = '$name' ");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=club_info.php'>";
}

?>



