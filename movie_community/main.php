        <div id="main_img_bar">
            <img src="./img/main_img.jpeg">
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