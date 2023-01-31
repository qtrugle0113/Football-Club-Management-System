<?
include "staff_contract_header.php";
include "config.php";    
include "util.php";     
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from staff natural join staff_contract";
    
    if (array_key_exists("search_keyword", $_POST)) {  
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where name like '%$search_keyword%' or exp_date like '%$search_keyword%' or salary like '%$search_keyword%' or time like '%$search_keyword%'";
    
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
            <th>Salary</th>
            <th>Expiration Date</th>
            <th>Signed Date</th>
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
            echo "<td>{$row['salary']}</td>";
            echo "<td>{$row['exp_date']}</td>";
            if($row['time'] == NULL) echo "<td>Not Signed</td>";
            else echo "<td>{$row['time']}</td>";
            echo "<td width='17%'>
                <a href='staff_contract_form.php?contract_id={$row['contract_id']}'><button class='button primary small'>New Contract</button></a>
                 <button onclick='javascript:deleteConfirm({$row['contract_id']})' class='button danger small'>Cancel</button>
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
            <a href='staff_contract_form.php'><button class='button add small'>New Staff Contract</button></a>
            </td>";
        echo "</tr>";
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(contract_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "staff_contract_delete.php?contract_id=" + contract_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
