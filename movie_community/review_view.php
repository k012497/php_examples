<?php
include "db_connector.php";

if(!isset($_GET['page'])){
    $page=1;
} else {
  $page=$_GET['page'];
}

$con = mysqli_connect("localhost", "root", "01240124", "my_page");

if(isset($_GET["num"]) && isset($_GET["hit"])){
    $num = $_GET["num"];
    $hit = $_GET["hit"];
    $r_num = mysqli_real_escape_string($con, $num);

    $sql="UPDATE `review` SET `hit`=$hit WHERE `num`=$r_num;";
    $result = mysqli_query($con, $sql);
    if(!$result){
        die('error: ' . mysqli_error($con));
    }

    $sql="SELECT * from `review` where num ='$r_num';";
    $result = mysqli_query($con, $sql);
    if(!$result){
        die('error: ' . mysqli_error($con));
    }

    $row = mysqli_fetch_array($result);
    $id = $row['id'];
    $subject = htmlspecialchars($row['subject']);
    $content = htmlspecialchars($row['content']);
    $subject = str_replace("\n", "<br>",$subject);
    $subject = str_replace(" ", "&nbsp;",$subject);
    $content = str_replace("\n", "<br>",$content);
    $content = str_replace(" ", "&nbsp;",$content);
    $day = $row['regist_day'];
    $hit = $row['hit'];
    mysqli_close($con);
}

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
    <link rel="stylesheet" href="./css/review.css">
    <title>MOVIEW | review</title>

    <script>
    function check_delete(num, page) {
      var result = confirm("삭제하시겠습니까?");
        if(result){
              window.location.href='./review_query.php?mode=delete&num=' + num + '&page=' + page;
        }
    }
</script>
</head>
<body>
    <div id="wrap">
        <header>
            <?php include"header.php";?>
        </header>
        <nav>
            <?php include"nav.php";?>
        </nav>
        <section id="content">
            <div id="main_img_bar">
                <img src="./img/review.jpeg">
            </div>
            <div id="board_box">
                <h3 class="title">영화 리뷰</h3>
                
                <?php
                $num = $_GET["num"];
                if(isset($_GET["page"])){
                    $page = $_GET["page"];
                }

                $con = mysqli_connect("localhost", "root", "01240124", "my_page");
                $sql = "select * from review where num = $num";
                $result = mysqli_query($con, $sql);

                $row = mysqli_fetch_array($result);
                $id = $row["id"];
                $name = $row["name"];
                $regist_day = $row["regist_day"];
                $subject = $row["subject"];
                $content = $row["content"];
                $hit = $row["hit"];

                $content = str_replace(" ", "&nbsp;", $content);
	            $content = str_replace("\n", "<br>", $content);

                $new_hit = $hit + 1;
                $sql = "update review set hit = $new_hit where num=$num";
                mysqli_query($con, $sql);
                ?>

                <ul id="view_content">
                <li>
                    <span class="col1"><b>제목 :</b><?=$subject?></span>
                    <span class="col2"><?=$name?> | <?=$regist_day?></span>
                </li>
                <li>
                    <?=$content?>
                </li>
            </ul>
            <ul class="buttons">
                <?php
                // 본인이 쓴 글은 수정 및 삭제 가능
                if(isset($_SESSION['userid'])){
                    if($_SESSION['userid'] == $id){
                ?>
                    <li><button onclick="location.href='write_edit_form.php?mode=update&num=<?=$num?>&page=<?=$page?>'">수정</button></li>
                    <li><button onclick="check_delete(<?=$num?>, <?=$page?>)">삭제</button></li>
                      
                <?php
                    }
                }
                // 세션값이 존재하면 답변기능과 글쓰기 기능부여하기
                if(!empty($_SESSION['userid'])){
                ?>
                        <li><button onclick="location.href = 'write_edit_form.php?mode=response&num=<?=$num?>'">답변</button></li>
                        <li><button onclick="location.href = 'review.php?page=<?=$page?>'">목록</button></li>
               
                <?php
                }

                ?>

            </ul>
            </div>
        </section>
    </div>
</body>
</html>