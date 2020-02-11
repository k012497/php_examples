<?php
    session_start();
    include_once "db_connector.php";
    
    if (isset($_SESSION["usernum"])) $user_num = $_SESSION["usernum"];
    else $user_num = "";

    if ( $user_num != 1 )
    {
        echo("
            <script>
            alert('관리자가 아닙니다! 회원정보 수정은 관리자만 가능합니다!');
            history.go(-1)
            </script>
        ");
        exit;
    }

    $num = $_GET["num"];
    $email = $_POST["email"];

    // $con = mysqli_connect("localhost", "root", "01240124", "my_page");
    echo $email;

    $sql = "update members set email = '$email' where num = $num";
    $result = mysqli_query($con, $sql);

    if(!$result){
        echo mysqli_error($con);
    } else {
        mysqli_close($con);
    
        // header() is used to send a raw HTTP header.
        header('Location: admin.php');
        exit;
    }

?>

