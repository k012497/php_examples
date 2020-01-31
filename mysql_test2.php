<?php
$conn = mysqli_connect("localhost","root","01240124");
if (mysqli_connect_errno()){
echo "MySQL 연결오류: " . mysqli_connect_error();
}
$sql = "CREATE DATABASE test2"; 
if (mysqli_query($conn,$sql)){
echo "성공적으로 test2 가만들어졌습니다.";
}else {
echo "데이터베이스만들기오류: " . mysqli_error($conn);
}
?>
