<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/greet.css">
    <script type="text/javascript" src="../js/member_form.js"></script>
    <title>MOVEIW | review</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/board.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/review.css">
  </head>
  <body>
    <div id="wrap">
      <header id="header">
          <?php include "header.php"; ?>
      </header>
      <nav id="menu">
        <?php include "nav.php"; ?>
      </nav>
      <section id="content">
        <div id="main_img_bar">
          <img src="./img/review.jpeg" alt="">
        </div>
      

<?php
include_once "db_connector.php";

// 수정, 답변, 새 글
$page = $name = $num = $id = $subject = $content = $day = $hit = "";
$mode="insert";
$checked="";
$disabled="";

if(isset($_SESSION['userid'])){
  $id= $_SESSION['userid'];
}

if(isset($_SESSION['username'])){
  $name = $_SESSION['username'];
}

// $con = mysqli_connect("localhost", "root", "01240124", "my_page");

// 수정, 답변인 경우
if((isset($_GET["mode"]) && $_GET["mode"]=="update")
  ||(isset($_GET["mode"]) && $_GET["mode"]=="response") ){

    if(isset($_GET["page"])){
      $page=$_GET["page"];
    } else {
      $page = 1;
    }
    $mode = $_GET["mode"];
    $num = $_GET["num"];
    $q_num = mysqli_real_escape_string($con, $num);

    // 수정이면 해당된 글, 답변이면 부모의 해당된 글을 가져옴.
    $sql="SELECT * from `review` where num ='$q_num';";
    $result = mysqli_query($con,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($con));
    }
    $row=mysqli_fetch_array($result);

    $id=$row['id'];
    $subject= htmlspecialchars($row['subject']);
    $content= htmlspecialchars($row['content']);
    $subject=str_replace("\n", "<br>",$subject);
    $subject=str_replace(" ", "&nbsp;",$subject);
    $content=str_replace("\n", "<br>",$content);
    $content=str_replace(" ", "&nbsp;",$content);
    $day=$row['regist_day'];
    $is_html=$row['is_html'];
    $checked=($is_html=="y")? ("checked"):("");
    $hit=$row['hit'];
    if($mode == "response"){
      $subject="[re]".$subject;
      $content="re>".$content;
      $content=str_replace("<br>", "<br>▶",$content);
      $disabled="disabled";
    }
    mysqli_close($con);
}
?>
      
        <div id="board_box">
          <h3>리뷰 작성</h3>

         <form name="board_form" action="review_query.php?mode=<?=$mode?>" method="post">
          <input type="hidden" name="num" value="<?=$num?>"> <!--원 글의 num, hit-->
          <input type="hidden" name="hit" value="<?=$hit?>">
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
            </ul>
            <ul class="buttons">
              <!-- 완료버튼 및 목록버튼 -->
              <li><button >완료</button></li>
              <li><a id="btn_list" onclick="location.href ='review.php?page=<?=$page?>';">목록</a></li>
            </ul>
            </div>
         </form>
      </section><!--end of content -->
    </div><!--end of wrap  -->
  </body>
</html>
