<?php
include "config.php";   
include "util.php";    

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$name = $_POST['name'];
$dob = $_POST['dob'];
$pos_id = $_POST['pos_id'];
$nationality = $_POST['nationality'];
$club = 'A Football Club';

echo "insert into staff (name, dob, pos_id, nationality, club) values ('$name', '$dob', '$pos_id', '$nationality', '$club')";

$ret = mysqli_query($conn, "insert into staff (name, dob, pos_id, nationality, club) values ('$name', '$dob', '$pos_id', '$nationality', '$club')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}

//Insert new staff contract
$query = "select max(staff_id) as newest_id from staff;";
$res = mysqli_query($conn, $query);
if (!$res) {
die('Query Error : ' . mysqli_error());
}

$row = mysqli_fetch_array($res);
$staff_id = $row['newest_id'];

echo "insert into staff_contract (staff_id, time) values ('$staff_id', NULL)";

$ret = mysqli_query($conn, "insert into staff_contract (staff_id, time) values ('$staff_id', NULL)");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=staff_list.php'>";
}
?>


