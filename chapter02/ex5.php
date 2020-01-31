<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table, td, th {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 3px;
            text-align: center;
        }

    </style>
</head>
<body>
    <?php 
        $name = "sojin";
        $mobile = "010-1234-1234";
        $address = "Seoul, South Korea";
        $email = "aaa@gmail.com";

        echo "<table>";
        
        echo "<tr>";
        echo "<th>이름</th>";
        echo "<th>휴대폰 번호</th>";
        echo "<th>주소</th>";
        echo "<th>이메일</th>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>{$name}</td>";
        echo "<td>{$mobile}</td>";
        echo "<td>{$address}</td>";
        echo "<td>{$email}</td>";
        echo "</tr>";

        echo "</table>";
    ?>
</body>
</html>
