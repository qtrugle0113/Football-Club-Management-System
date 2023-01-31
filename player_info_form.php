<?
include "player_info_header.php";
include "config.php";    
include "util.php";      

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "player_info_insert.php";

if (array_key_exists("player_id", $_GET)) {
    $player_id = $_GET["player_id"];
    $query =  "select * from player where player_id = $player_id";
    $res = mysqli_query($conn, $query);
    $player = mysqli_fetch_array($res);
    if(!$player) {
        msg("Player가 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "player_info_modify.php";

}

$positions = array();

$query = "select * from player_pos";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $positions[$row['pos_id']] = $row['pos_name'];
}

?>
    <div class="container">
        <form name="player_info_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="player_id" value="<?=$player['player_id']?>"/>
            <h3>선수 정보 <?php echo $mode; ?></h3>
            <p>
                <label for="name">Name</label>
                <input type="text" placeholder="Name 입력" name="name" id = "name" value="<?=$player['name']?>"/>
            </p>
            <p>
                <label for="dob">Date Of Birth (yyyy.mm.dd)</label>
                <input type="text" placeholder="Date Of Birth 입력" name="dob" id="dob" value="<?=$player['dob']?>"/>
            </p>
            <p>
                <label for="height">Height</label>
                <input type="number" placeholder="Height 입력" name="height"  id="height" value="<?=$player['height']?>"/>
            </p>
            <p>
                <label for="weight">Weight</label>
                <input type="number" placeholder="Weight 입력" name="weight" id="weight" value="<?=$player['weight']?>"/>
            </p>
            <p>
                <label for="reg_num">Squad Number</label>
                <input type="number" placeholder="Squad Number 입력" name="reg_num" id="reg_num" value="<?=$player['reg_num']?>"/>
            </p>
            <p>
                <label for="pos_id">Position</label>
                <select name="pos_id" id="pos_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($positions as $id => $name) {
                            if($id == $player['pos_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="nationality">Nationality</label>
                <input type="text" placeholder="Nationality 입력" name="nationality" id="nationality" value="<?=$player['nationality']?>"/>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("pos_id").value == "-1") {
                        alert ("Position를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("name").value == "") {
                        alert ("Name를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("dob").value == "") {
                        alert ("D.O.B를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("height").value == "" || document.getElementById("height").value == "0") {
                        alert ("Height를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("weight").value == "" || document.getElementById("weight").value == "0") {
                        alert ("Weight를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("reg_num").value == "" || document.getElementById("reg_num").value == "0") {
                        alert ("Squad Number를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("nationality").value == "") {
                        alert ("Nationality를 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>