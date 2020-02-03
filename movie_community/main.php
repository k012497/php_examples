        <!-- 전체 틀 -->
        <div class="slideshow">
            <!-- 이미지 -->
            <div class="slideshow_slides">
            <a href="#"> <img src="./img/image-1.jpeg" width="1100" alt="slide1"> </a>
            <a href="#"> <img src="./img/image-2.jpeg" width="1100" alt="slide2"> </a>
            <a href="#"> <img src="./img/image-3.jpeg" width="1100" alt="slide3"> </a>
            <a href="#"> <img src="./img/image-4.jpeg" width="1100" alt="slide4"> </a>
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
            </div>
        </div>
        <div id="main_content">
            <!-- 최근 게시글 -->
                <div id="latest">
                    <h4>최근 게시글(15장)</h4>
                    <ul>

<?php
    $con = mysqli_connect("localhost", "root", "01240124", "my_page");
    $sql = "select * from board order by num desc limit 5";
    $result = mysqli_query($con, $sql);

    if(!$result){
        echo "게시글이 없습니다.";
    }else{
        while($row = mysqli_fetch_array($result)){
            $regist_day = substr($row["regist_day"], 0, 10);
?>

            <li>
                <span><?=$row["subject"]?></span>
                <span><?=$row["name"]?></span>
                <span><?=$regist_day?></span>
            </li>

<?php
        }
    }
?>

        </div>