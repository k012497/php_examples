<?php
    include_once "db_connector.php";
    
    $sum = $_GET["num"];
    $page = $_GET["page"];

    $subject = $_POST["subject"];
    $content = $_POST["content"];

    // $con = mysqli_connect("localhost", "root", "01240124", "my_page");
    $sql = "update board set subject='$subject', content='$content' ";
    $sql .= "where num = $num";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "<script>
        location.href = 'board_list.php?page=$page';
    <script>";
?>