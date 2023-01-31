<?
include "staff_header.php";
include "config.php";    
include "util.php";      

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "staff_insert.php";

if (array_key_exists("staff_id", $_GET)) {
    $staff_id = $_GET["staff_id"];
    $query =  "select * from staff where staff_id = $staff_id";
    $res = mysqli_query($conn, $query);
    $staff = mysqli_fetch_array($res);
    if(!$staff) {
        msg("물품이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "staff_modify.php";

}

$positions = array();

$query = "select * from staff_pos";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $positions[$row['pos_id']] = $row['pos_name'];
}

?>
    <div class="container">
        <form name="staff_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="staff_id" value="<?=$staff['staff_id']?>"/>
            <h3>상품 정보 <?php echo $mode; ?></h3>
            <p>
                <label for="name">Name</label>
                <input type="text" placeholder="Name 입력" name="name" id="name" value="<?=$staff['name']?>"/>
            </p>
            <p>
                <label for="dob">Date Of Birth (yyyy.mm.dd)</label>
                <input type="text" placeholder="Date Of Birth 입력" name="dob" id="dob" value="<?=$staff['dob']?>"/>
            </p>
            <p>
                <label for="nationality">Nationality</label>
                <input type="text" placeholder="Nationality 입력" name="nationality" id="nationality" value="<?=$staff['nationality']?>"/>
            </p>            
            <p>
                <label for="pos_id">Position</label>
                <select name="pos_id" id="pos_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($positions as $id => $name) {
                            if($id == $staff['pos_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
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
                        alert ("Date Of Birth를 입력해 주십시오"); return false;
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