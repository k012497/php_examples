<?php
    include "db_connector.php";
    $id = $_POST["id"];
    $pw = $_POST["pw"];

    // $con = mysqli_connect("localhost", "root", "01240124", "my_page");
    $sql = "select * from members where id = '$id'";
    $result = mysqli_query($con, $sql);
    
    $num_match = mysqli_num_rows($result);

    if(!$num_match){
        // 해당 아이디의 데이터가 없을 경우
        // echo("
        //     <script>
        //         window.alert('check your id!');
        //         history.go(-1);
        //     </script>
        // ");
        echo("등록되지 않은 아이디입니다.");
    } else {
        $row = mysqli_fetch_array($result);
        $db_pw = $row["pw"];

        mysqli_close($con);

        if($pw != $db_pw){
            // 비밀번호가 틀렸을 경우
            // echo("
            //     <script>
            //         window.alert('check your password!');
            //         history.go(-1);
            //     </script>
            // ");
            echo("비밀번호가 옳지 않습니다.");
            exit;
        } else {
            session_start();
            $_SESSION["usernum"] = $row["num"];
            $_SESSION["userid"] = $row["id"];
            $_SESSION["username"] = $row["name"];

            // echo("
            //   <script>
            //     location.href = 'index.php';
            //   </script>
            // ");
        }
    }

?>