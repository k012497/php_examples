<?php
    include_once "db_connector.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/board.css">
    <title>MOVIEW | board</title>
</head>
<script>
    function check_input(){
        if(!document.board_form.subject.value){
            alert("제목을 입력하세요!");
            document.board_form.subject.focus();
        }
        if(!document.board_form.content.value){
            alert("내용을 입력하세요!");
            document.board_form.content.focus();
        } else {
            document.board_form.submit();
        }
    }
</script>
<body>
    <header>
        <?php include "header.php"?>
    </header>
    <nav>
        <?php include "nav.php"?>
    </nav>
    <div id="main_img_bar">
        <img src="./img/message.jpeg" alt="">
    </div>
    <div id="board_box">
        <h3 id="board_title">
            뉴스 > 글 쓰기
        </h3>
        <?php 
            $num = $_GET["num"];
            $page = $_GET["page"];

            $con = mysqli_connect("localhost", "root", "01240124", "my_page");
            $sql = "select * from board where num = $num";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);
            $name = $row["name"];
            $subject = $row["subject"];
            $content = $row["content"];
            $file_name = $row["file_name"];
        ?>

        <form name="board_form" method="post" action="board_modify.php?num=<?=$num?>&page=<?=$page?>">
            <ul id="board_form">
                <li>
                    <span class="col1">이름 : </span>
                    <span class="col2"><?=$name?></span>
                </li>
                <li>
                    <span class="col1">제목 : </span>
                    <span class="col2"><input type="text" name="subject" value="<?=$subject?>"></span>
                </li>
                <li>
                    <span class="col1">내용 : </span>
                    <span class="col2"><textarea name="content"><?=$content?></textarea></span>
                </li>
                <li>
                    <span class="col1">첨부 파일 : </span>
                    <!-- <span class="col2"><textarea name="content"><?=$file_name?></textarea></span> -->
                    <span class="col2"><input type="file" name="upfile" value="<?=$file_name?>"></span>
                </li>
            </ul>
        </form>
    </div>
    <footer>
        <?php include "footer.php";?>
    </footer>
</body>
</html>