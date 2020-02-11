<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/board.css">
    <link rel="stylesheet" href="./css/review.css">
    <link rel="stylesheet" href="./css/main.css">
    <title>MOVIEW |review</title>
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
            <img src="./img/review.jpeg">
        </div>
        <div id="review_box">
            <h3 id="review_title">
                리뷰 > 목록
            </h3>  
<?php
    include_once "db_connector.php";
    define('SCALE', 10);

    // $con = mysqli_connect("localhost", "root", "01240124", "my_page");

    if(isset($_GET["mode"]) && $_GET["mode"]=="search"){
        // 제목 or 내용 or 아이디
        $find = $_POST["find"];
        $search = $_POST["search"];
        $r_search = mysqli_real_escape_string($con, $search);
        $sql="SELECT * from `review` where $find like '%$r_search%' order by num asc;";
    } else {
        $sql="SELECT * FROM `review` order by `group_num` desc, `order` asc;";
    }
      
      
    $result = mysqli_query($con, $sql);
    if(!$result){
        echo mysqli_error($con);
        exit;
    }
    $total_record = mysqli_num_rows($result);
    $total_page = ($total_record % SCALE == 0 ) ? ($total_record/SCALE) : (ceil($total_record/SCALE));
?>          
            <!-- <ul> -->
            <form action="review.php?mode=search" method="post">
                <div id="list_search">
                 <div id="list_search1">총 <?=$total_record?>개의 게시물이 있습니다.</div>
                 <div id="list_search2">
                   <select  name="find">
                     <option value="subject">제목</option>
                     <option value="content">내용</option>
                     <option value="name">글쓴이</option>
                   </select>
                 </div><!--end of list_search3  -->
                 <div id="list_search3"><input type="text" name="search"></div>
                 <div id="list_search4"> <input type="button" value="🔍"></div>
               </div><!--end of list_search  -->
            </form>
            <!-- </ul>    -->
            <ul id="review_list">
                <li>
                    <span class="col1">번호</span>
                    <span class="col2">제목</span>
                    <span class="col3">글쓴이</span>
                    <span class="col5">등록일</span>
                    <span class="col6">조회</span>
                </li>
                
                <?php
                    if(isset($_GET["page"])){
                        $page = (int)$_GET["page"];
                    } else if(empty($_GET["page"])) {
                        $page = 1;
                    }

                    // $con = mysqli_connect("localhost", "root", "01240124", "my_page");
                    // $sql = "select * from review order by num desc";
                    // $result = mysqli_query($con, $sql);
                    // $total_record = mysqli_num_rows($result);

                    // $scale = 10;

                    if($total_record % SCALE == 0){
                        // 0으로 나누어 떨어지는 경우 그 몫이 곧 토탈 페이지
                        $total_page = floor($total_record / SCALE);
                    } else {
                        // 그렇지 않은 경우 나머지 글들을 위한 한 페이지 더 !
                        $total_page = floor($total_record / SCALE) + 1;
                    }

                    // 표시할 페이지($page)에 따라 $previous_articles 계산  
                    $previous_articles = ($page - 1) * SCALE;

                    $start_number = $total_record - $previous_articles;

                    // 마지막 페이지에선 scale만큼 꽉 안 찰 수 있으니까 && $i < $total_record로 제한
                    // for($i = $previous_articles ; $i < $previous_articles + $scale && $i < $total_record ; $i++ ){
                    //     mysqli_data_seek($result, $i);

                    //     $row = mysqli_fetch_array($result);
                    //     $num = $row["num"];
                    //     $id = $row["id"];
                    //     $name = $row["name"];
                    //     $subject = $row["subject"];
                    //     $regist_day = $row["regist_day"];
                    //     $hit = $row["hit"];

                    //     if($row["file_name"]){
                    //         $file_image = "<img src='./img/file.gif'>";
                    //     } else {
                    //         $file_image = " ";
                    //     }   
                        for ($i = $previous_articles ; $i < $previous_articles + SCALE && $i < $total_record ; $i++){
                            mysqli_data_seek($result, $i);
                            $row = mysqli_fetch_array($result);
                            $num = $row['num'];
                            $id = $row['id'];
                            $name = $row['name'];
                            $hit = $row['hit'];
                            $date = substr($row['regist_day'],0,10);
                            $subject = $row['subject'];
                            $subject = str_replace("\n", "<br>",$subject);
                            $subject = str_replace(" ", "&nbsp;",$subject);
                            $depth = (int)$row['depth']; // 공간을 몆 칸을 띄워야할지 결정하는 숫자임
                            $space = "";
                            for($j = 0 ; $j < $depth ; $j++){
                                $space = "&nbsp;&nbsp;".$space;
                            }
                    ?>
                            <li>
                                <span class="col1"><?=$start_number?></span>
                                <span class="col2"><a href="review_view.php?num=<?=$num?>&page=<?=$page?>&hit=<?=$hit?>"><?=$space?><?=$subject?></a></span>
                                <span class="col3"><?=$name?></span>
                                <span class="col5"><?=$date?></span>
                                <span class="col6"><?=$hit?></span>
                            </li>
                    <?php
                            $start_number--;
                        }
                        // mysqli_close($con);
                    ?>

            </ul>
            <ul id="page_num">
            <?php
                // previous page
                if($total_page >= 2 && $page >= 2){
                    $new_page = $page - 1;
                    echo "<li><a href = review.php?page=$new_page'>◀️ 이전</a><li>";
                } else {
                    echo "<li>&nbsp;</li>";
                }

                for($i = 1 ; $i <= $total_page ; $i++){
                    if($page == $i){
                        echo "<li><b> $i </b></li>"; // 현재 보고있는 페이지의 경우 링크 안 달고 굵은 글씨
                    } else {
                        echo "<li><a href=review.php?page=$i'> $i&nbsp </li>";
                    }
                }

                // next page
                if($total_page >= 2 && $page != $total_page){
                    $new_page = $page + 1;
                    echo "<li><a href = review.php?page=$new_page'>▶️ 다음</a></li>";
                } else {
                    echo "<li>&nbsp</li>";
                }
            ?>
            </ul>
            <ul class="buttons">
                <?php
                    if($user_id){
                ?>
                        <button onclick="location.href='write_edit_form.php?mode=insert'">글쓰기</button>
                <?php
                    }
                ?>
                </li>
            </ul>
        </div>
    </section>
    <footer>
        <?php include "footer.php";?>
    </footer>
</body>
</html>