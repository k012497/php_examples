<?php
    include_once "db_connector.php";
    session_start();
    if(isset($_SESSION["usernum"])){
        $user_num = $_SESSION["usernum"];
    } else {
        $user_num = "";
    }

    if($user_num != 1){
        echo("<script>
            console.log($user_num);
            alert('관리자만 가능합니다.');
            history.go(-1);
        </script>");
        exit;
    }

    if(isset($_POST["item"])){
        $num_item = count($_POST["item"]);
    } else {
        echo("<script>
            alert('삭제할 게시글을 선택해주세요!');
        </script>");
    }
    
        // $con = mysqli_connect("localhost", "root", "01240124", "my_page");

        for($i = 0 ; $i < count($_POST["item"]) ; $i++){
            $num = $_POST["item"][$i];

            $sql = "select * from board where num = $num";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);

            $copied_name = $row["file_copied"];

            if($copied_name){
                $file_path = "./data/".$copied_name;
                unlink($file_path);
            }

            $sql = "delete from board where num = $num";
            $result = mysqli_query($con, $sql);
            if(!$result){
                echo "mysqli_error($con)";
            }
        }

        mysqli_close($con);

        echo"
            <script>
                location.href = 'admin.php';
            </script>";
?>