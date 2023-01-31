<?
include "player_contract_header.php";
include "config.php";    
include "util.php";      

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "player_contract_insert.php";

if (array_key_exists("contract_id", $_GET)) {
    $contract_id = $_GET["contract_id"];
    $query =  "select * from player natural join player_contract natural join player_pos where contract_id = $contract_id";
    $res = mysqli_query($conn, $query);
    $contract = mysqli_fetch_array($res);
    if(!$contract) {
        msg("Player가 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "player_contract_modify.php";

}

$positions = array();

$query = "select * from player_pos";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $positions[$row['pos_id']] = $row['pos_name'];
}

if($mode == "입력")
	$title = "New Player Contract";
else
	$title = "New Contract";
?>
    <div class="container">
        <form name="player_contract_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="contract_id" value="<?=$contract['contract_id']?>"/>
            <h3><?php echo $title; ?></h3>
            <p>
                <label for="name">Name</label>
                <input type="text" <? if ($mode == "수정") { ?> readonly="readonly" <? } ?> placeholder="Name 입력" name="name" id="name" value="<?=$contract['name']?>"/>
            </p>
            <p>
                <label for="dob">Date Of Birth (yyyy.mm.dd)</label>
                <input type="text" <? if ($mode == "수정") { ?> readonly="readonly" <? } ?> placeholder="Date Of Birth 입력" name="dob" id="dob" value="<?=$contract['dob']?>"/>
            </p>
            <p>
                <label for="height">Height</label>
                <input type="number" <? if ($mode == "수정") { ?> readonly="readonly" <? } ?> placeholder="Height 입력" name="height" id="height" value="<?=$contract['height']?>"/>
            </p>
            <p>
                <label for="weight">Weight</label>
                <input type="number" <? if ($mode == "수정") { ?> readonly="readonly" <? } ?> placeholder="Weight 입력" name="weight" id="weight" value="<?=$contract['weight']?>"/>
            </p>
            <p>
                <label for="reg_num">Squad Number</label>
                <input type="number" <? if ($mode == "수정") { ?> readonly="readonly" <? } ?> placeholder="Squad Number 입력" name="reg_num" id="reg_num" value="<?=$contract['reg_num']?>"/>
            </p>
            
            <? if ($mode == "수정") { ?> 
            <p>
                <label for="pos_id">Position</label>
                <input type="text" readonly="readonly" placeholder="Position 입력" name="pos_id" id="pos_id" value="<?=$contract['pos_name']?>"/>
            </p>            
            <? } else { ?>
            <p>
                <label for="pos_id">Position</label>
                <select name="pos_id" id="pos_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($positions as $id => $name) {
                            if($id == $contract['pos_id']){
                                echo "<option value='{$id}'  selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <? } ?>
            
            <p>
                <label for="nationality">Nationality</label>
                <input type="text" <? if ($mode == "수정") { ?> readonly="readonly" <? } ?> placeholder="Nationality 입력" name="nationality" id="nationality" value="<?=$contract['nationality']?>"/>
            </p>
            <p>
                <label for="exp_date">Expiration Date (yyyy.mm.dd)</label>
                <input type="text" placeholder="Expiration Date 입력" name="exp_date" id="exp_date" value="<?=$contract['exp_date']?>"/>
            </p>
            <p>
                <label for="wage">Weekly Wage</label>
                <input type="number" placeholder="Wage 입력" name="wage" id="wage" value="<?=$contract['wage']?>"/>
            </p>            

            <p align="center"><button class="button primary large" onclick="javascript:return validate();">Sign</button></p>

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
                    else if(document.getElementById("exp_date").value == "") {
                        alert ("Expiration Date를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("wage").value == "" || document.getElementById("wage").value == "0") {
                        alert ("Wage를 입력해 주십시오"); return false;
                    }                    
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>