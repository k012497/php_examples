<?php
    include_once "db_connector.php";

    $num = $_GET["num"];
    $page = $_GET["page"];

    // $con = mysqli_connect("localhost", "root", "01240124", "my_page");
    $sql = "select * from board where num = $num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $copied_name = $row["file_copied"];

    if($copied_name){
        $file_path = "./data/".$copied_name;
        unlink($file_path); // Deletes a file
    }

    $sql = "delete from board where num = $num";
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
    if($result){
        echo "
            <script>
                location.href = 'board_list.php?page=$page';
            </script>
        ";
    } else {
        echo "mysqli_error($con)";
    }

?>