<?php
echo "MySql connection Test<br>"; // html화 하는 명령어
$db = mysqli_connect("localhost", "root", "01240124", "test");

if($db){
    echo "connect : succeed<br>";
} else {
    echo "disconnect : error<br>";
}
$result = mysqli_query($db, 'SELECT VERSION() as VERSION');
$data = mysqli_fetch_assoc($result);
echo $data['VERSION'];
?>