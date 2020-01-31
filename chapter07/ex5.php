<?=
    $table = $_GET["table"];

    if($table == "free"){
        echo "<h1>자유게시판</h1>";
    }else {
        echo "<h1>공지사항</h1>";
    }
?>