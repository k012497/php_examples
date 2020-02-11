<?php
session_start();
include_once "db_connector.php";
?>

<meta charset="utf-8">

<?php
$content= $r_content = $sql= $result = $userid="";
$group_num = 0;

$userid = $_SESSION['userid'];
$username = $_SESSION['username'];

// insert
if(isset($_GET["mode"]) && $_GET["mode"]=="insert"){
    $content = trim($_POST["content"]);
    $subject = trim($_POST["subject"]);
    if(empty($content) || empty($subject)){
      echo "<script>
        alert('제목과 내용을 입력해주세요!');
        history.go(-1);
      </script>";
      exit;
    }
    
    $subject = $_POST["subject"];
    $content = $_POST["content"];
    $userid = $userid;
    $hit = 0;
    $is_html=(!isset($_POST["is_html"]))?('n'):('y');
    $r_subject = mysqli_real_escape_string($con, $subject);
    $r_content = mysqli_real_escape_string($con, $content);
    $r_userid = mysqli_real_escape_string($con, $userid);
    $regist_day=date("Y-m-d (H:i)");

    // 그룹 번호, 들여쓰기 기본값
    $group_num = 0;
    $depth=0;
    $ord=0;

    $sql="INSERT INTO `review` VALUES (null,$group_num,$depth,$ord,'$r_userid','$username','$r_subject','$r_content','$regist_day',0,'$is_html');";
    $result = mysqli_query($con,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($con));
    }

    //방금 넣은 레코드의 num(num 최대값)을 가져와서 그룹번호로 저장하기
    $sql="SELECT max(num) from review;";
    $result = mysqli_query($con,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($con));
    }
    $row=mysqli_fetch_array($result);
    $max_num=$row['max(num)'];
    $sql="UPDATE `review` SET `group_num`= $max_num WHERE `num`=$max_num;";
    $result = mysqli_query($con,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($con));
    }
    mysqli_close($con);

    echo "<script>location.href='./review.php';</script>";
}else if(isset($_GET["mode"]) && $_GET["mode"]=="delete"){
  //  삭제할 경우
  $num = $_GET["num"];
  $r_num = mysqli_real_escape_string($con, $num);

  $sql ="DELETE FROM `review` WHERE num=$r_num";
  $result = mysqli_query($con, $sql);
  if (!$result) {
    die('Error: ' . mysqli_error($con));
  }

  mysqli_close($con);
  echo "<script>location.href='./review.php?page=1';</script>";

}else if(isset($_GET["mode"])&&$_GET["mode"]=="update"){
  // 수정할 경우
  $content = trim($_POST["content"]);
  $subject = trim($_POST["subject"]);
  if(empty($content) || empty($subject)){
    echo "<script>alert('내용이나제목입력요망!');history.go(-1);</script>";
    exit;
  }
  $subject = $_POST["subject"];
  $content = $_POST["content"];
  $userid = $userid;
  $num = $_POST["num"];
  $hit = $_POST["hit"];
  $is_html=(!isset($_POST["is_html"]))?('n'):('y');
  $r_subject = mysqli_real_escape_string($con, $subject);
  $r_content = mysqli_real_escape_string($con, $content);
  $r_userid = mysqli_real_escape_string($con, $userid);
  $r_num = mysqli_real_escape_string($con, $num);
  $regist_day=date("Y-m-d (H:i)");

  $sql="UPDATE `review` SET `subject`='$r_subject', `content`='$r_content', `regist_day`='$regist_day',`is_html` ='$is_html' WHERE `num`=$r_num;";
  $result = mysqli_query($con,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($con));
  }
  echo "<script>location.href='./review.php?num=$num&hit=$hit';</script>";

}else if(isset($_GET["mode"]) && $_GET["mode"]=="response"){
  // 답변일 경우

  $content = trim($_POST["content"]);
  $subject = trim($_POST["subject"]);

  if(empty($content)||empty($subject)){
    echo "<script>
      alert('내용, 제목 입력 요망!');
      history.go(-1);
    </script>";

    exit;
  }

  $subject = $_POST["subject"];
  $content = $_POST["content"];
  $userid = $userid;
  $num = $_POST["num"];
  // $hit = test_input($_POST["hit"]);
  $hit =0;
  $is_html=(!isset($_POST["is_html"]))?('n'):('y'); // 체크박스
  $r_subject = mysqli_real_escape_string($con, $subject);
  $r_content = mysqli_real_escape_string($con, $content);
  $r_userid = mysqli_real_escape_string($con, $userid);
  $r_num = mysqli_real_escape_string($con, $num);
  $regist_day=date("Y-m-d (H:i)");

  $sql="SELECT * from review where num =$r_num;";
  $result = mysqli_query($con,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($con));
  }
  $row=mysqli_fetch_array($result);

  // 현재 그룹넘버값을 가져와서 저장한다.
  $group_num = (int)$row['group_num'];

  // 현재 들여쓰기값을 가져와서 증가한후 저장한다.
  $depth = (int)$row['depth'] + 1;

  // 현재 순서값을 가져와서 증가한후 저장한다.
  $ord = (int)$row['order'] + 1;

  //현재 그룹넘버가 같은 모든 레코드를 찾아서 현재 $ord값보다 같거나 큰 레코드에 $ord 값을 1을 증가시켜 저장한다.
  $sql="UPDATE `review` SET `order`=`order`+1 WHERE `group_num` = $group_num and `order` >= $ord";
  $result = mysqli_query($con,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($con));
  }

  $sql="INSERT INTO `review` VALUES (null,$group_num,$depth,$ord,
    '$r_userid','$username','$r_subject','$r_content','$regist_day',$hit,'$is_html');";
  $result = mysqli_query($con,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($con));
  }

  $sql = "SELECT max(num) from review;";
  $result = mysqli_query($con,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($con));
  }
  $row = mysqli_fetch_array($result);
  $max_num = $row['max(num)'];

  echo "<script>location.href='./review_view.php?num=$max_num&hit=$hit';</script>";

}//end of if insert
// Header("Location: p260_score_list.php");
?>
