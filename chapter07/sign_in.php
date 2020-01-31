<?php
    $correct_id = "123123";
    $correct_pw = "123123";

    $id = $_POST["id"];
    $pw = $_POST["pw"];

    if($id == $correct_id && $pw == $correct_pw){
        echo "<script>alert('welcome!');</script>";
    } else {
        echo "<script>alert('check id and password');</script>";
    }
?>