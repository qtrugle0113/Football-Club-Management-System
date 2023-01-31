<?
include "player_info_header.php";
include "config.php";    
include "util.php";      
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from player natural join player_pos";
    
    if (array_key_exists("search_keyword", $_POST)) {  
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where name like '%$search_keyword%' or pos_name like '%$search_keyword%' or dob like '%$search_keyword%' or height like '%$search_keyword%' 
        	or weight like '%$search_keyword%' or nationality like '%$search_keyword%' or reg_num like '%$search_keyword%'";
    
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
            <th>D.O.B</th>
            <th>Nationality</th>
            <th>Height(cm)</th>
            <th>Weight(kg)</th>
            <th>Position</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row['reg_num']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['dob']}</td>";
            echo "<td>{$row['nationality']}</td>";
            echo "<td>{$row['height']}</td>";
            echo "<td>{$row['weight']}</td>";
            echo "<td>{$row['pos_name']}</td>";
            echo "<td width='17%'>
                <a href='player_info_form.php?player_id={$row['player_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['player_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
        }
        echo "<tr>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td width='17%'>
            <a href='player_info_form.php'><button class='button add small'>등록</button></a>
            </td>";
        echo "</tr>";
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(player_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "player_info_delete.php?player_id=" + player_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
