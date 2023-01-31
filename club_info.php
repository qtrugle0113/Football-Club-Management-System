<? include ("header.php");
include "config.php";    
include "util.php";

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$query = "select * from club;";
$res = mysqli_query($conn, $query);
if (!$res) {
die('Query Error : ' . mysqli_error());
}

$row = mysqli_fetch_array($res);

?>
    <div class='container'>
        <h3>Welcome to <? echo $row['name']; ?>! </h3>
        <p><? echo $row['name']; ?> is a professional football club based in Islington, London, England.</p>
        <p>The club was founded in <? echo $row['founded']; ?>.</p>
        <p>The <? echo $row['stadium']; ?> Stadium is the home of AFC, with a capacity of <? echo $row['capacity']; ?>.</p>
        <p>Contact Information:</p>
        <li>Phone: <? echo $row['phone']; ?>.</li>
		<li>Email: <? echo $row['email']; ?>.</li>
		<a href='club_info_form.php'><button class='button primary small'>Edit Club Info</button></a>
    </div>
<? include ("footer.php"); ?>