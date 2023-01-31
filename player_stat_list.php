<?
include "player_stat_header.php";
include "config.php";    
include "util.php";     
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from player natural join stat";
    
    if (array_key_exists("search_keyword", $_POST)) { 
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where apps like '%$search_keyword%' or min_play like '%$search_keyword%' or goal like '%$search_keyword%' or assist like '%$search_keyword%' 
        or clean_sheet like '%$search_keyword%' or name like '%$search_keyword%' or reg_num like '%$search_keyword%'";
    
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
        	<th>Number</th>
            <th>Name</th>
            <th>Appearance</th>
            <th>Minutes Played</th>
            <th>Goal</th>
            <th>Assist</th>
            <th>Clean Sheet (GK)</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row['reg_num']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['apps']}</td>";
            echo "<td>{$row['min_play']}</td>";
            echo "<td>{$row['goal']}</td>";
            echo "<td>{$row['assist']}</td>";
            echo "<td>{$row['clean_sheet']}</td>";
            echo "<td width='17%'>
                <a href='player_stat_form.php?player_id={$row['player_id']}'><button class='button primary small'>수정</button></a>
                </td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(player_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "player_stat_delete.php?player_id=" + player_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
