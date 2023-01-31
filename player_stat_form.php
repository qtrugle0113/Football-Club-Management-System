<?
include "player_stat_header.php";
include "config.php";    
include "util.php";      

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("player_id", $_GET)) {
    $player_id = $_GET["player_id"];
    $query =  "select * from player natural join stat where player_id = $player_id";
    $res = mysqli_query($conn, $query);
    $player = mysqli_fetch_array($res);
    if(!$player) {
        msg("Player가 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "player_stat_modify.php";
    
}

?>
    <div class="container">
        <form name="player_stat_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="player_id" value="<?=$player['player_id']?>"/>
            <h3>선수 정보 <?php echo $mode; ?></h3>
            <p>
                <label for="name">Name</label>
                <input type="text" readonly="readonly" placeholder="Name 입력" name="name" id="name" value="<?=$player['name']?>"/>
            </p>
            <p>
                <label for="reg_num">Squad Number</label>
                <input type="number" readonly="readonly" placeholder="Squad Number 입력" name="reg_num" id="reg_num" value="<?=$player['reg_num']?>"/>
            </p>
            <p>
                <label for="apps">Appearance</label>
                <input type="number" placeholder="Appearance 입력" name="apps" id="apps" value="<?=$player['apps']?>"/>
            </p>
            <p>
                <label for="min_play">Minutes Played</label>
                <input type="number" placeholder="Minutes Played 입력" name="min_play" id="min_play" value="<?=$player['min_play']?>"/>
            </p>
            <p>
                <label for="goal">Goal</label>
                <input type="number" placeholder="Goal 입력" name="goal" id="goal" value="<?=$player['goal']?>"/>
            </p>
            <p>
                <label for="assist">Assist</label>
                <input type="number" placeholder="Assist 입력" name="assist" id="assist" value="<?=$player['assist']?>"/>
            </p>
            <p>
                <label for="clean_sheet">Clean Sheet</label>
                <input type="number" placeholder="Clean Sheet 입력" name="clean_sheet" id="clean_sheet" value="<?=$player['clean_sheet']?>"/>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("apps").value == "") {
                        alert ("Appearance를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("min_played").value == "") {
                        alert ("Minutes Played를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("goal").value == "") {
                        alert ("Goal를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("assist").value == "") {
                        alert ("Assist를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("clean_sheet").value == "") {
                        alert ("Clean Sheet를 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>