<?
include "header.php";
include "config.php";    
include "util.php";      

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$query =  "select * from club";
$res = mysqli_query($conn, $query);
$club= mysqli_fetch_array($res);
if(!$club) {
	msg("Club 정보가 존재하지 않습니다.");
}
$action = "club_info_modify.php";

?>
    <div class="container">
        <form name="club_info_form" action="<?=$action?>" method="post" class="fullwidth">
            <h3>Club Info Edit</h3>
            <p>
                <label for="name">Name</label>
                <input type="text" readonly="readonly" placeholder="Name 입력" name="name" id="name" value="<?=$club['name']?>"/>
            </p>
            <p>
                <label for="founded">Founded Year</label>
                <input type="number" placeholder="Founded Year 입력" name="founded" id="founded" value="<?=$club['founded']?>"/>
            </p>
            <p>
                <label for="stadium">Stadium</label>
                <input type="text" placeholder="Stadium 입력" name="stadium" id="stadium" value="<?=$club['stadium']?>"/>
            </p>
            <p>
                <label for="capacity">Capacity</label>
                <input type="number" placeholder="Capacity 입력" name="capacity" id="capacity" value="<?=$club['capacity']?>"/>
            </p>
            <p>
                <label for="phone">Phone Number</label>
                <input type="number" placeholder="Phone Number 입력" name="phone" id="phone" value="<?=$club['phone']?>"/>
            </p>
            <p>
                <label for="email">Email</label>
                <input type="text" placeholder="Email 입력" name="email" id="email" value="<?=$club['email']?>"/>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();">Edit</button></p>

            <script>
                function validate() {
                    if(document.getElementById("founded").value == "") {
                        alert ("Founded Year를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("stadium").value == "") {
                        alert ("Stadium를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("capacity").value == "") {
                        alert ("Capacity를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("phone").value == "") {
                        alert ("Phone Number를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("email").value == "") {
                        alert ("Email를 입력해 주십시오"); return false;
                    }                    
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>