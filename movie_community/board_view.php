<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MOVIEW | board</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/board.css">
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <header>
        <?php include "header.php";?>
    </header>
    <nav>
        <?php include "nav.php";?>
    </nav>
    <section>
    <div id="main_img_bar">
        <img src="./img/message.jpeg">
    </div>
    <div>
        <div id="board_box">
            <h3 class="title">
                뉴스 > 내용보기
            </h3>
            <?php
            include_once "db_connector.php";

            $num = $_GET["num"];
            $page = $_GET["page"];

            // $con = mysqli_connect("localhost", "root", "01240124", "my_page");
            $sql = "select * from board where num = $num";
            $result = mysqli_query($con, $sql);

            $row = mysqli_fetch_array($result);
            $id = $row["id"];
            $name = $row["name"];
            $regist_day = $row["regist_day"];
            $subject = $row["subject"];
            $content = $row["content"];
            $file_name = $row["file_name"];
            $file_type = $row["file_type"];
            $file_copied = $row["file_copied"];
            $hit = $row["hit"];

            $content = str_replace(" ", "&nbsp;", $content);
	        $content = str_replace("\n", "<br>", $content);

            $new_hit = $hit + 1;
            $sql = "update board set hit = $new_hit where num=$num";
            mysqli_query($con, $sql);
            ?>

            <ul id="view_content">
                <li>
                    <span class="col1"><b>제목 :</b><?=$subject?></span>
                    <span class="col2"><?=$name?> | <?=$regist_day?></span>
                </li>
                <li>
                    <?php
                    if($file_name){
                        $real_name = $file_copied;
                        $file_path = "./data/".$real_name;
                        $file_size = filesize($file_path);

                        echo "📁첨부파일 : $file_name($file_size Byte) &nbsp;&nbsp;
                        <a href='board_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br><br>"; 
                    }
                    ?>
                    <?=$content?>
                </li>
            </ul>
            <ul class="buttons">
                <?php
                    if(isset($_SESSION) && $_SESSION['userid'] === $id){
                ?>
                    <li><button onclick="location.href='board_form.php?mode=update&num=<?=$num?>&page=<?=$page?>'">수정</button></li>
                    <li><button onclick="location.href='board_query.php?mode=delete&num=<?=$num?>&page=<?=$page?>'">삭제</button></li>

                <?php
                    }
                ?>
                <li><button onclick="location.href='board_form.php'">글쓰기</button></li>
                <li><button onclick="location.href='board_list.php?page=<?=$page?>'">목록</button></li>
            </ul>
        </div>
    </div>
    </section>
    <footer>
        <?php include "footer.php";?>
    </footer>
</body>
</html>