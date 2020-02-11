<?php
    include_once "db_connector.php";
    $user_id = $_GET["userId"];

    $new_pw = $_POST["password"];
    $new_name = $_POST["name"];
    $new_email = $_POST["email"];
    $new_mobile = $_POST["mobile"];

    // $con = mysqli_connect("localhost", "root", "01240124", "my_page");
    $sql = "update members set pw = '{$new_pw}', name = '{$new_name}', email = '{$new_email}', mobile = '{$new_mobile}' where id = '{$user_id}';";

    $result = mysqli_query($con, $sql);

    if ( !$result ){
        echo("쿼리오류 발생: " . mysqli_error($con));
    } else {
        echo "
            <script>
                location.href = 'index.php';
            </script>
        ";
    }

    mysqli_close($con);

?>