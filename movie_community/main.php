<!-- 전체 틀 -->
<div class="slideshow">
    <!-- 이미지 -->
    <div class="slideshow_slides">
        <a href="#">
            <img src="./img/parasite.jpeg" width="1100" alt="slide1">
        </a>
        <a href="#">
            <img
                src="https://drraa3ej68s2c.cloudfront.net/wp-content/uploads/2020/02/09212823/96a1307775c2fd03cbe39f0580389a1b9ba6c9bd25dba0969b38a75126bdae8b-2048x2048.jpg"
                width="1100"
                alt="slide1">
        </a>
        <a href="#">
            <img src="./img/image-2.jpeg" width="1100" alt="slide2">
        </a>
        <a href="#">
            <img src="./img/image-3.jpeg" width="1100" alt="slide3">
        </a>
        <a href="#">
            <img src="./img/image-4.jpeg" width="1100" alt="slide4">
        </a>
    </div>

    <!-- 이전 / 다음 선택 버튼 -->
    <div class="slideshow_nav">
        <a href="#" class="prev"></a>
        <a href="#" class="next"></a>
    </div>

    <!-- 움직일 때마다 -->
    <div class="slideshow_indicator">
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
    </div>
</div>
<div id="main_content">
    <!-- 최근 게시글 -->
    <div id="latest" class="main_left">
        <h4>&nbsp;&nbsp;📰 요즘 어떤 일이?</h4>
        <ul>

    <?php
    include_once "db_connector.php";

    $sql = "select * from board order by num desc limit 5";
    $result = mysqli_query($con, $sql);

    if(!$result){
        echo "게시글이 없습니다.";
    }else{
        while($row = mysqli_fetch_array($result)){
            $regist_day = substr($row["regist_day"], 0, 10);
?>

            <li>
                <span><a href="board_view.php?num=<?=$row["num"]?>&page=1"><?=$row["subject"]?></a></span>
                <span><?=$row["name"]?></span>
                <span><?=$regist_day?></span>
            </li>

            <?php
        }
    }
?>

        </ul>
    </div>

    <!-- 최근 게시글2 -->
    <div id="latest" class="main_right">
        <h4>&nbsp;&nbsp;✍🏻 최근 등록된 리뷰</h4>
        <ul>

        <?php
    $con = mysqli_connect("localhost", "root", "01240124", "my_page");
    $sql = "select * from review order by num desc limit 5";
    $result = mysqli_query($con, $sql);

    if(!$result){
        echo "게시글이 없습니다.";
    }else{
        while($row = mysqli_fetch_array($result)){
            $regist_day = substr($row["regist_day"], 0, 10);
?>

            <li>
                <span><a href="review_view.php?num=<?=$row["num"]?>&page=1"><?=$row["subject"]?></a></span>
                <span><?=$row["name"]?></span>
                <span><?=$regist_day?></span>
            </li>

            <?php
        }
    }
?>
        </ul>
    </div>
</div>