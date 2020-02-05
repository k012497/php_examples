<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/message.css">
    <title>MOVIEW | message</title>
</head>
<script>
function check_input() {
    const form = document.message_form;
      if (!form.subject.value){
        alert("제목을 입력하세요!");
        form.subject.focus();
      } else if (!form.content.value){
        alert("내용을 입력하세요!");    
        form.content.focus();
      } else {
        form.submit();
      }
   }
</script>
<body>
    <header>
        <?php include "header.php";?>
    </header>
    <section>
        <div id="main_img_bar">
            <img src="./img/message.jpeg" alt="">
        </div>
        <div id="message_box">
            <h3 id="write_title">답장 보내기</h3>
            <?php
            $num = $_GET["num"];

            $con = mysqli_connect("localhost", "root", "01240124", "my_page");
            $sql = "select * from message where num = $num";
            $result = mysqli_query($con, $sql);

            $row = mysqli_fetch_array($result);
            $send_id = $row["send_id"];
            $rv_id = $row["rv_id"];
            $subject = $row["subject"];
            $content = $row["content"];

            $subject = "RE: ".$subject;

            $content = "> ".$content;
            $content = str_replace("\n", "\n>", $content);
            $content = "\n\n\n―――――――――――――――――――――――――――――――――――――――――――――\n".$content;

            $result_name = mysqli_query($con, "select name from members where id = '$send_id'");
            $record = mysqli_fetch_array($result_name);
            $send_name = $record["name"];
            ?>
            
            <form name="message_form" method="post" action="message_insert.php?send_id=<?=$user_id?>">
                <input type="hidden" name="rv_id" value="<?=$send_id?>">
                <div id="write_msg">
                    <ul>
                        <li>
                            <span class="col1">보내는 사람 : </span>
					        <span class="col2"><?=$user_id?></span>
                        </li>
                        <li>
                            <span class="col1">수신 아이디 : </span>
					        <span class="col2"><?=$send_name?>(<?=$send_id?>)</span>
                        </li>
                        <li>
	    			        <span class="col1">제목 : </span>
	    			        <span class="col2"><input name="subject" type="text" value="<?=$subject?>"></span>
	    		        </li>	    	
                        <li>
                            <span class="col1">글 내용 : </span>
                            <span class="col2">
                                <textarea name="content"><?=$content?></textarea>
                            </span>
                        </li>
                    </ul>
                    <button type="button" onclick="check_input()">보내기</button>
                </div>
            </form>
        </div>
    </section>
    <footer>
        <?php include "footer.php"?>
    </footer>
</body>
</html>