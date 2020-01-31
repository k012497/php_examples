<?php
    $id = $_POST["id"];
    $pw = $_POST["pw"];

    $con = mysqli_connect("localhost", "root", "01240124", "my_page");
    $sql = "select * from members where id = '$id'";
    $result = mysqli_query($con, $sql);
    
    $num_match = mysqli_num_rows($result);

    if(!$num_match){
        // 해당 아이디의 데이터가 없을 경우
        echo("
            <script>
                window.alert('check your id!');
                history.go(-1);
            </script>
        ");
    } else {
        $row = mysqli_fetch_array($result);
        $db_pw = $row["pw"];

        mysqli_close($con);

        if($pw != $db_pw){
            // 비밀번호가 틀렸을 경우
            echo("
                <script>
                    window.alert('check your password!');
                    history.go(-1);
                </script>
            ");
            exit;
        } else {
            session_start();
            $_SESSION["usernum"] = $row["num"];
            $_SESSION["userid"] = $row["id"];
            $_SESSION["username"] = $row["name"];

            echo("
              <script>
                location.href = 'index.php';
              </script>
            ");
        }
    }

?>