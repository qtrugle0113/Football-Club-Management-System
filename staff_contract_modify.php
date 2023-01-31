<?php
include "config.php";    
include "util.php";      

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$contract_id = $_POST['contract_id'];
$exp_date = $_POST['exp_date'];
$salary = $_POST['salary'];

$ret = mysqli_query($conn, "update staff_contract set exp_date = '$exp_date', salary = '$salary', time = NOW() where contract_id = $contract_id");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=staff_contract_list.php'>";
}

?>



