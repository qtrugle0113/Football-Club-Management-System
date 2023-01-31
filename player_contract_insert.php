<?php
include "config.php";    
include "util.php";      

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$name = $_POST['name'];
$dob = $_POST['dob'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$reg_num = $_POST['reg_num'];
$pos_id = $_POST['pos_id'];
$nationality = $_POST['nationality'];
$club = 'A Football Club';
$exp_date = $_POST['exp_date'];
$wage = $_POST['wage'];

//Insert new player info
echo "insert into player (name, dob, height, weight, reg_num, pos_id, nationality, club) values ('$name', '$dob', '$height', '$weight', '$reg_num', '$pos_id', '$nationality', '$club')";

$ret = mysqli_query($conn, "insert into player (name, dob, height, weight, reg_num, pos_id, nationality, club) values ('$name', '$dob', '$height', '$weight', '$reg_num', '$pos_id', '$nationality', '$club')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}

//Insert new player stat
$query = "select max(player_id) as newest_id from player;";
$res = mysqli_query($conn, $query);
if (!$res) {
die('Query Error : ' . mysqli_error());
}

$row = mysqli_fetch_array($res);
$player_id = $row['newest_id'];

echo "insert into stat (player_id, apps, min_play, goal, assist, clean_sheet) values ('$player_id', '0', '0', '0', '0', '0')";

$ret = mysqli_query($conn, "insert into stat (player_id, apps, min_play, goal, assist, clean_sheet) values ('$player_id', '0', '0', '0', '0', '0')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}

//Insert new player contract
echo "insert into player_contract (player_id, exp_date, wage, time) values ('$player_id', '$exp_date', '$wage', NOW())";

$ret = mysqli_query($conn, "insert into player_contract (player_id, exp_date, wage, time) values ('$player_id', '$exp_date', '$wage', NOW())");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=player_contract_list.php'>";
}
?>


