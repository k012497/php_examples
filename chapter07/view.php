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

    define("NAME", "sojin");
    echo "welcome ".NAME;
?>

    <ul>
        <li>id:<?=$id?></li>
        <li>password:<?=$password?></li>
    </ul>
</body>
</html>