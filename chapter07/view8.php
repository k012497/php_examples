<?php
    echo('<!DOCTYPE html>
    <html lang=\"en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>');
    $file_dir = "/Applications/mampstack-7.3.13-0/apache2/htdocs/chapter07";
    $upload = $_FILES["upload"];
    $img_path = "";

    echo $upload["tmp_name"];

    if(move_uploaded_file($upload["tmp_name"], $file_dir.$upload["name"])){
        $img_path = "./data/".$upload["name"]; // e.g) ./data/kkk.jpg
?>
        <ul>
            <li><img src = "<?= $img_path?>"></li>
            <li><?= $_POST["comment"] ?></li>
        </ul>
<?php
    }
    
    echo('</body>
    </html>');

?>