<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/board.css">
    <link rel="stylesheet" href="./css/main.css">
    <title>MOVIEW | BOARD</title>
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
        <div id="board_box">
            <h3 id="board_title">
                게시판 > 목록
            </h3>     
            <ul id="board_list">
                <li>
                    <span class="col1">번호</span>
                    <span class="col2">제목</span>
                    <span class="col3">글쓴이</span>
                    <span class="col4">첨부</span>
                    <span class="col5">등록일</span>
                    <span class="col6">조회</span>
                </li>
                
                <?php

                    if(isset($_GET["page"])){
                        $page = $_GET["page"];
                    } else if(empty($_GET["page"])) {
                        $page = 1;
                    }

                    $con = mysqli_connect("localhost", "root", "01240124", "my_page");
                    $sql = "select * from board order by num desc";
                    $result = mysqli_query($con, $sql);
                    $total_record = mysqli_num_rows($result);

                    $scale = 10;

                    if($total_record % $scale == 0){
                        // 0으로 나누어 떨어지는 경우 그 몫이 곧 토탈 페이지
                        $total_page = floor($total_record / $scale);
                    } else {
                        // 그렇지 않은 경우 나머지 글들을 위한 한 페이지 더 !
                        $total_page = floor($total_record / $scale) + 1;
                    }

                    // 표시할 페이지($page)에 따라 $previous_articles 계산  
                    $previous_articles = ($page - 1) * $scale;

                    $start_number = $total_record - $previous_articles;

                    // 마지막 페이지에선 scale만큼 꽉 안 찰 수 있으니까 && $i < $total_record로 제한
                    for($i = $previous_articles ; $i < $previous_articles + $scale && $i < $total_record ; $i++ ){
                        mysqli_data_seek($result, $i);

                        $row = mysqli_fetch_array($result);
                        $num = $row["num"];
                        $id = $row["id"];
                        $name = $row["name"];
                        $subject = $row["subject"];
                        $regist_day = $row["regist_day"];
                        $hit = $row["hit"];

                        if($row["file_name"]){
                            $file_image = "<img src='./img/file.gif'>";
                        } else {
                            $file_image = " ";
                        }   
                    ?>
                            <li>
                                <span class="col1"><?=$start_number?></span>
                                <span class="col2"><a href="board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span>
                                <span class="col3"><?=$name?></span>
                                <span class="col4"><?=$file_image?></span>
                                <span class="col5"><?=$regist_day?></span>
                                <span class="col6"><?=$hit?></span>
                            </li>
                    <?php
                            $start_number--;
                        }
                        mysqli_close($con);
                    ?>

            </ul>
            <ul id="page_num">
            <?php
                // previous page
                if($total_page >= 2 && $page >= 2){
                    $new_page = $page - 1;
                    echo "<li><a href = 'board_list.php?page=$new_page'>◀️ 이전</a><li>";
                } else {
                    echo "<li>&nbsp;</li>";
                }

                for($i = 1 ; $i <= $total_page ; $i++){
                    if($page == $i){
                        echo "<li><b> $i </b></li>"; // 현재 보고있는 페이지의 경우 링크 안 달고 굵은 글씨
                    } else {
                        echo "<li><a href='board_list.php?page=$i'> $i </li>";
                    }
                }

                // next page
                if($total_page >= 2 && $page != $total_page){
                    $new_page = $page + 1;
                    echo "<li><a href = 'board_list.php?page=$new_page'>▶️ 다음</a></li>";
                } else {
                    echo "<li>&nbsp</li>";
                }
            ?>
            </ul>
            <ul class="buttons">
                <li><button onclick="location.href='board_list.php'">목록</button></li>
                <li>
                <?php
                    if($user_id){
                ?>
                        <button onclick="location.href='board_form.php?mode=insert'">글쓰기</button>
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