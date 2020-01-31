<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
    $id = $_POST["id"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $dateOfBirth = $_POST["dob"];
    $gender = $_POST["gender"];
    $moblie = $_POST["mobile"];

?>
    <ul>
            <li>id : <?=$id?></li>
            <li>password : <?=$password?></li>
            <li>name : <?=$name?></li>
            <li>dateOfBirth : <?=$dateOfBirth?></li>
            <li>gender : <?=$gender?></li>
            <li>moblie : <?=$moblie?></li>
    </ul>
</body>
</html>