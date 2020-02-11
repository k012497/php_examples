<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/message.css">
    <link rel="stylesheet" href="./css/main.css">
    <title>MOVIEW | message</title>
</head>
<body>
    <header>
        <?php include "header.php";?>
    </header>
    <section>
        <div id="main_img_bar">
            <img src="./img/message.jpeg" width="1000px">
        </div>
        <div id="message_box">
            <h3 class="title">
                <?php
                include_once "db_connector.php";
                $mode = $_GET["mode"];
                $num = $_GET["num"];

                // $con = mysqli_connect("localhost", "root", "01240124", "my_page");
                $sql = "select * from message where num = $num";
                $result = mysqli_query($con, $sql);

                if($result){
                    $row = mysqli_fetch_array($result);

                    $send_id = $row["send_id"];
                    $rv_id = $row["rv_id"];
                    $regist_day = $row["regist_day"];
                    $subject = $row["subject"];
                    $content = $row["content"];

                    $content = str_replace(" ", "&nbsp;", $content);
                    $content = str_replace("\n", "<br />", $content);

                    if($mode === "send"){
                        // 보낸 쪽지함일 경우, 받는 사람의 이름을 가져온다
                        $result_name = mysqli_query($con, "select name from members where id = '$rv_id'");
                    } else {
                        // 받은 쪽지함일 경우, 보낸 사람의 이름을 가져온다
                        $result_name = mysqli_query($con, "select name from members where id = '$rv_id'");
                    }

                    $record = mysqli_fetch_array($result_name);
                    $msg_name = $record["name"];

                    if($mode === "send"){
                        echo "보낸 쪽지함 >  내용 보기";
                    } else {
                        echo "받은 쪽지함 > 내용 보기";
                    }
                } // end of if(get으로 받은 message num이 존재하는 경우)
                ?>
            </h3>
            <ul id="view_content">
                <li>
                    <span class="col1"><b>제목 : </b><?=$subject?></span>
                    <span class="col2"><?=$msg_name?> | <?=$regist_day?></span>
                </li>
                <li>
                    <?=$content?>
                </li>
            </ul>
            <?php
                if($mode === "send"){
            ?>
            <ul class="buttons">
                 <!-- 내가 보낸 쪽지일 경우 답장 불가 -->
				<li><button onclick="location.href='message_box.php?mode=rv'">받은 쪽지함</button></li>
				<li><button onclick="location.href='message_box.php?mode=send'">보낸 쪽지함</button></li>
				<li><button onclick="location.href='message_delete.php?num=<?=$num?>&mode=<?=$mode?>'">삭제</button></li>
            </ul>
            <?php
                } else {
                    ?>
            <ul class="buttons">
                <li><button onclick="location.href='message_box.php?mode=rv'">받은 쪽지함</button></li>
				<li><button onclick="location.href='message_box.php?mode=send'">보낸 쪽지함</button></li>
                <li><button onclick="location.href='message_response_form.php?num=<?=$num?>'">답장 보내기</button></li>
				<li><button onclick="location.href='message_delete.php?num=<?=$num?>&mode=<?=$mode?>'">삭제</button></li>
            </ul>
            <?php
                }
            ?>
        </div>
    </section>
    <footer>
        <?php include "footer.php";?>
    </footer>
</body>
</html>