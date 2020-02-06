<?php
    session_start();
    if(isset($_SESSION["userid"])){
        $user_id = $_SESSION["userid"];
    } else {
        $user_id = "";
    }

    if(isset($_SESSION["username"])){
        $user_name = $_SESSION["username"];
    }else {
        $user_name = "";
    }

    $subject = $_POST["subject"];
    $content = $_POST["content"];

    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);

    $regist_day = date("Y-m-d (H:i)");

    $upload_dir = './data/';// 상대 경로로 지정 !

    $upfile_name = $_FILES["upfile"]["name"];
    $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
    $upfile_type = $_FILES["upfile"]["type"];
    $upfile_size = $_FILES["upfile"]["size"];
    $upfile_error = $_FILES["upfile"]["error"];

    if ($upfile_name && !$upfile_error){
        // 파일을 올렸고(파일 이름이 있고) 에러가 없는 경우
        $file = explode(".", $upfile_name);
        $file_name = $file[0];
        $file_ext = $file[1];

        date_default_timezone_set('Asia/Seoul');
        $new_file_name = date("Y_m_d_H_i_s");
        $new_file_name .= $file_name;
        $copied_file_name = $new_file_name.".".$file_ext;
        $uploaded_file = $upload_dir.$copied_file_name;

        if($upfile_size > 1000000){
            echo("<script>
                alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
                // history.go(-1)
                </script>");
            exit;
        }
    
        if(!move_uploaded_file($upfile_tmp_name, $uploaded_file)){
            echo("<script>
                alert('파일을 복사하는 데 실패했습니다. ');
                // history.go(-1)
                </script>");
            exit;
        }
        
    } else {
        // 파일을 올리지 않은 경우
        $upfile_name = "";
        $upfile_type = "";
        $upfile_file_name = "";
    }

        $con = mysqli_connect("localhost", "root", "01240124", "my_page");
        $sql = "insert into board (id, name, subject, content, regist_day, hit, file_name, file_type, file_copied) ";
        $sql .= "values ('$user_id', '$user_name', '$subject', '$content', '$regist_day', 0, ";
        $sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";
    
        $result = mysqli_query($con, $sql);
        if(!$result){
            echo "mysqli_error ".mysqli_error($con);
        }
        mysqli_close($con);
    
        echo "<script>
            location.href = 'board_list.php';
            </script>";

?>