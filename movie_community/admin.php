<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/admin.css">
    <title>MOVIEW | administrator</title>
</head>
<body>
    <header>
        <?php include "header.php";?>
    </header>
    <nav>
        <?php include "nav.php";?>
    </nav>
    <section>
        <div id="admin_box">
            <h3 id="member_title">관리자 모드 > 회원 관리</h3>
            <ul id="member_list">
                <li>
                    <span class="col1">번호</span>
                    <span class="col2">아이디</span>
                    <span class="col3">이름</span>
                    <span class="col4">이메일</span>
                    <span class="col5">생년월일</span>
                    <span class="col6">전화번호</span>
                    <span class="col7">수정</span>
                    <span class="col8">삭제</span>
                </li>

<?php
    include_once "db_connector.php";
    
	$sql = "select * from members order by num desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 회원 수

	$number = $total_record;

   while ($row = mysqli_fetch_array($result))
   {
      $num = $row["num"];
	  $id = $row["id"];
	  $name = $row["name"];
      $gender = $row["gender"];
	  $dob = $row["dob"];
      $email = $row["email"];
      $mobile = $row["mobile"];
?>

        <li>
            <form action="admin_member_update.php?num=<?=$num?>" method="post">
                <span class="col1"><?=$number?></span>
                <span class="col2"><?=$id?></span>
                <span class="col3"><?=$name?></span>
                <span class="col4"><input class="col4" type="text" name="email" value="<?=$email?>"></span>
                <span class="col5"><?=$dob?></span>
                <span class="col6"><?=$mobile?></span>
                <span class="col7"><button type="submit">수정</button></span>
                <span class="col8"><button type="button" onclick="location.href='admin_member_delete.php?num=<?=$num?>'">삭제</button></span>
            </form>
        </li>
<?php
        $number--;
   }
?>
            </ul>
            <h3 id="board_title">관리자 모드 > 게시판 관리</h3>
            <ul id="board_list">
                <li class="title">
                    <span class="col1">선택</span>
			        <span class="col2">번호</span>
			        <span class="col3">이름</span>
			        <span class="col4">제목</span>
			        <span class="col5">첨부파일명</span>
			        <span class="col6">작성일</span>
                </li>
            <form action="admin_board_delete.php" method="post">

<?php
    $con = mysqli_connect("localhost", "root", "01240124", "my_page");
    $sql = "select * from board order by num desc";
    $result = mysqli_query($con, $sql);
    $total_record = mysqli_num_rows($result);

    $number = $total_record;

    while($row = mysqli_fetch_array($result)){
        $num = $row["num"];
        $name = $row["name"];
        $subject = $row["subject"];
        $file_name = $row["file_name"];
        $regist_day = $row["regist_day"];
        $regist_day = substr($regist_day, 0, 10);
?>
            <li>
                <span class="col1"><input type="checkbox" name="item[]" value="<?=$num?>"></span>
                <span class="col2"><?=$number?></span>
                <span class="col3"><?=$name?></span>
			    <span class="col4"><?=$subject?></span>
			    <span class="col5"><?=$file_name?></span>
			    <span class="col6"><?=$regist_day?></span>
            </li>
<?php
            $number--;
    }
    mysqli_close($con);
?>
                <button type="submit">선택한 글 삭제</button>
            </form>
        </ul>
    </div>
<footer>
    <?php include "footer.php"?>
</footer>
</section>
</body>
</html>