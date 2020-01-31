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
        $num = count($_POST["hobby"]);

        echo "you may like ";

        for($i = 0 ; $i < $num ; $i++){
            echo $_POST["hobby"][$i];

            if($i != $num - 1){
                echo ", ";
            }
        }
    ?>
</body>
</html>