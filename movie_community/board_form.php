<?php
    include_once "db_connector.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>MOVIEW | board</title>
        <link rel="stylesheet" type="text/css" href="./css/common.css">
        <link rel="stylesheet" type="text/css" href="./css/board.css">
        <link rel="stylesheet" type="text/css" href="./css/main.css">
        <style>
            .hidden {
                display: none;
            }
        </style>
		<script>
            function insert_data(){
                if(check_input()){
                    // document.board_form.action = "board_query.php?mode=insert";
                    document.board_form.submit();
                }
            }

            function update_data(){
                if(check_input()){
                    // document.board_form.action = "board_query.php?mode=update&num=";
                    document.board_form.submit();
                }
            }

            function check_input() {
                if (!document.board_form.subject.value) {
                    alert("제목을 입력하세요!");
                    document.board_form.subject.focus();
                    return false;
                } else if(!document.board_form.content.value) {
                    alert("내용을 입력하세요!");
                    document.board_form.content.focus();
                    return false;
                } else {
                    return true;
                }
            }
            
            function choose_file(){
                
                const fileChooser = document.getElementById("input-file");
                fileChooser.classList.remove("hidden");
                fileChooser.click();

                // a태그는 숨기기
                document.getElementById("origin_file").classList.add("hidden");
            }

            function check_file(){
                // 파일을 선택하지 않은 경우 다시 히든
                const originFile = document.getElementById("origin_file");
                const fileChooser = document.getElementById("input-file");
                const file = fileChooser.value;

                console.log(file);
                if(!file){
                    console.log("안 바꿨네");
                    originFile.classList.remove("hidden");
                    fileChooser.classList.add("hidden");

                }

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
			if(!$user_id){
				echo"<script>
					alert('로그인 후 사용하실 수 있습니다.')
					history.go(-1)
				</script>";
				exit;
            }

            // 모드 인식
            $mode = $_GET["mode"];
            if($mode === "update"){
                // 수정하는 경우, 해당 글의 정보를 가져옴
                $num = $_GET["num"];
                $page = $_GET["page"];

                // $con = mysqli_connect("localhost", "root", "01240124", "my_page");
                $sql = "select * from board where num = $num";
                $result = mysqli_query($con, $sql);

                $row = mysqli_fetch_array($result);
                $name = $row["name"];
                $subject = $row["subject"];
                $content = $row["content"];
                $file_name = $row["file_name"];
            } else {
                $num = "";
                $page = "";
            }

		?>
        <section>
            <div id="main_img_bar">
                <img src="./img/message.jpeg" width="1000px">
            </div>
            <div id="board_box">
                <h3 id="board_title">
                    <?php 
                        if($mode === "insert"){
                            echo "뉴스 > 글 쓰기";
                        } else if($mode === "update"){
                            echo "뉴스 > 글 수정";
                        }
                    ?>
                </h3>
                <form
                    name="board_form"
                    method="post"
                    action="board_query.php?mode=<?=$mode?>&num=<?=$num?>&page=<?=$page?>"
                    enctype="multipart/form-data">
                    <ul id="board_form">
                        <li>
                            <span class="col1">이름 :</span>
                            <span class="col2"><?=$user_name?></span>
                        </li>
                        <li>
                            <span class="col1">제목 :</span>
                            <span class="col2"><input name="subject" type="text"
                            <?php
                                if($mode === "update"){
                                    echo "value='$subject'";
                                }
                            ?>
                            ></span>
                        </li>
                        <li id="text_area">
                            <span class="col1">내용 :</span>
                            <span class="col2">
                            <?php
                                if($mode === "update"){
                                    echo "<textarea name='content'>$content</textarea>";
                                }else {
                                    echo "<textarea name='content'></textarea>";
                                }
                            ?>
                            </span>
                        </li>
                        <li>
                            <span class="col1">첨부 파일</span>
                            <span class="col2">
                            <?php
                                if($mode === "update"){
                                    echo "<input id='input-file' class='hidden' type='file' name='upfile' onblur='check_file();'>";
                                    echo "<a id='origin_file' style='cursor:pointer' onclick='choose_file();'>$file_name</a>";
                                } else {
                                    // input file 태그 바로 보여주기
                                    echo "<input type='file' name='upfile'>";
                                }

                            ?>
                            </span>
                        </li>
                    </ul>
                    <ul class="buttons">
                        <li>
                            <?php 
                                if($mode === "insert"){
                                    ?>
                                    <button type="button" onclick="insert_data()">등록</button>
                            <?php
                                } else {
                            ?>
                                    <button type="button" onclick="update_data()">수정</button>
                            <?php
                                }
                            ?>
                            
                        </li>
                        <li>
                            <button type="button" onclick="location.href='board_list.php'">목록</button>
                        </li>
                    </ul>
                </form>
            </div>
        </section>
        <footer>
            <?php include "footer.php";?>
        </footer>
    </body>
</html>