<?
include "staff_header.php";
include "config.php";   
include "util.php";     
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from staff natural join staff_pos";
    
    if (array_key_exists("search_keyword", $_POST)) {  
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where name like '%$search_keyword%' or pos_name like '%$search_keyword%' or dob like '%$search_keyword%' or nationality like '%$search_keyword%'";
    
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
        	<th>No.</th>
            <th>Name</th>
            <th>D.O.B</th>
            <th>Nationality</th>
            <th>Position</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['dob']}</td>";
            echo "<td>{$row['nationality']}</td>";
            echo "<td>{$row['pos_name']}</td>";
            echo "<td width='17%'>
                <a href='staff_form.php?staff_id={$row['staff_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['staff_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        echo "<tr>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td width='17%'>
            <a href='staff_form.php'><button class='button add small'>등록</button></a>
            </td>";
        echo "</tr>";
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(staff_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "staff_delete.php?staff_id=" + staff_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
