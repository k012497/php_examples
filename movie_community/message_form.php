<?php
    include_once "db_connector.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>MOVIEW | message</title>
        <link rel="stylesheet" type="text/css" href="./css/common.css">
        <link rel="stylesheet" type="text/css" href="./css/message.css">
        <link rel="stylesheet" type="text/css" href="./css/main.css">
        <script>
            function check_input() {
                if (!document.message_form.rv_id.value) {
                    alert("수신 아이디를 입력하세요!");
                    document.message_form.rv_id.focus();
                    return;
                } else if (!document.message_form.subject.value) {
                    alert("제목을 입력하세요!");
                    document.message_form.subject.focus();
                    return;
                } else if (!document.message_form.content.value) {
                    alert("내용을 입력하세요!");
                    document.message_form.content.focus();
                    return;
                }
                console.log("본애기");
                document.message_form.submit();
            }
        </script>
    </head>
    <body>
        <header>
            <?php include "header.php";?>
        </header>
        <nav>
            <?php include "nav.php";?>
        </nav>
        <?php
            if (!$user_id )
            {
                echo("<script>
                        alert('로그인 후 이용해주세요!');
                        history.go(-1);
                        </script>
                    ");
                exit;
            }
        ?>
        <section>
            <div id="main_img_bar">
                <img src="./img/message.jpeg" width="1000px">
            </div>
            <div id="message_box">
                <h3 id="write_title">쪽지 보내기</h3>
                <ul class="top_buttons">
                    <li>
                        <span><a href="message_box.php?mode=rv">📩받은 쪽지함</a></span>
                    </li>
                    <li>|</li>
                    <li>
                        <span><a href="message_box.php?mode=send">📝보낸 쪽지함</a></span>
                    </li>
                </ul>
                <form
                    name="message_form"
                    method="post"
                    action="message_insert.php?send_id=<?=$user_id?>">
                    <div id="write_msg">
                        <ul>
                            <li>
                                <span class="col1">보내는 사람 :</span>
                                <span class="col2"><?=$user_id?></span>
                            </li>
                            <li>
                                <span class="col1">수신 아이디 :</span>
                                <span class="col2"><input name="rv_id" type="text"></span>
                            </li>
                            <li>
                                <span class="col1">제목 :</span>
                                <span class="col2"><input name="subject" type="text"></span>
                            </li>
                            <li id="text_area">
                                <span class="col1">내용 :</span>
                                <span class="col2">
                                    <textarea name="content"></textarea>
                                </span>
                            </li>
                        </ul>
                        <button type="button" onclick="check_input()">보내기</button>
                    </div>
                </form>
            </div>
        </section>
        <footer>
            <?php include "footer.php";?>
        </footer>
    </body>
</html>