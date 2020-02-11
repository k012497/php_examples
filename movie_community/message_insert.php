<meta charset='utf-8'>
<?php
	include_once "db_connector.php";
    $send_id = $_GET["send_id"];

    $rv_id = $_POST['rv_id'];
    $subject = $_POST['subject'];
	$content = $_POST['content'];
	$subject = htmlspecialchars($subject, ENT_QUOTES); // 따옴표를 html 엔티티(&quot;)로 변환 
	$content = htmlspecialchars($content, ENT_QUOTES);
	date_default_timezone_set('Asia/Seoul');
	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

	// $con = mysqli_connect("localhost", "root", "01240124", "my_page");
	$sql = "select * from members where id='$rv_id'";
	$result = mysqli_query($con, $sql);
	$num_record = mysqli_num_rows($result);

	if($num_record){
		$sql = "insert into message (send_id, rv_id, subject, content, regist_day) ";
		$sql .= "values('$send_id', '$rv_id', '$subject', '$content', '$regist_day')";
		$result = mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행

		echo "
	   		<script>
	   		 location.href = 'message_box.php?mode=send';
	   		</script>
		";

		exit;
	} else {
		echo("
			<script>
			alert('수신 아이디가 잘못 되었습니다!');
			history.go(-1)
			</script>
			");
		exit;
		// ajax로 하기!!!!!!
	}

	mysqli_close($con); // DB 연결 끊기
	
?>

  
