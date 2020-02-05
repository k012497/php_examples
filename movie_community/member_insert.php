<?php
    $id = $_POST["id"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $birthday = $_POST["birthday"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $mobile  = $_POST["mobile"];
              
    $con = mysqli_connect("localhost", "root", "01240124", "my_page");

	$sql = "insert into members ";
    $sql .= "values(null, '$id', '$password', '$name', '$birthday', '$email', '$gender', '$mobile')";

	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	";
?>

   
