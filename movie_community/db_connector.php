<?php
date_default_timezone_set("Asia/Seoul");

define('DB_NAME', 'my_page');
$servername = "localhost";
$username = "root";
$password = "01240124";
$dbflag = "NO";

$con = mysqli_connect($servername, $username, $password);
if (!$con){ die("Connection failed: " . mysqli_connect_error());}

$sql = "show databases";
$result=mysqli_query($con, $sql) or die('Error: '.mysqli_error($con));

while ($row=mysqli_fetch_row($result)) {
  if($row[0] === 'my_page'){
    $dbflag = "OK";
    break;
  }
}

if($dbflag === "NO"){
  $sql = "create database ".DB_NAME;
  
  if(mysqli_query($con, $sql)){
    echo "<script>alert(".DB_NAME."' 디비 생성되었습니다.');</script> ";
  }else{
    echo "실패: ".mysqli_error($con);
  }
}

$dbcon = mysqli_select_db($con, DB_NAME) or die('Error: '.mysqli_error($con));

function test_input($data) {
  $data = trim($data); // 공백 없애기
  $data = stripslashes($data); // 슬래쉬 없애기
  $data = htmlspecialchars($data); //escaping
  return $data;
}

?>
