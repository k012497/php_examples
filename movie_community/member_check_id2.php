<?php
  include_once "db_connector.php";
  $id = $_POST["id"];

  // $con = mysqli_connect("localhost", "root", "01240124", "my_page");
  $sql = "select * from members where id = '$id'";

  $result = mysqli_query($con, $sql);
  $result_record = mysqli_num_rows($result);

  if($result_record){
    echo "exists";
  }else{
    echo "none";
  }

  mysqli_close($con);

 ?>
