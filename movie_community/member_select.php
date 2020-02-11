<?php
    include_once "db_connector.php";

    // $con = mysqli_connect("localhost", "root", "01240124", "my_page");
	$sql = "select * from members where id='$user_id'";
    $result = mysqli_query($con, $sql);
    $user_info = mysqli_fetch_array($result);

    $user_email = $user_info["email"];
    $user_birthday = $user_info["dob"];
    $user_gender = $user_info["gender"];
    $user_mobile = $user_info["mobile"];
?>