<?php
    session_start();
    include_once "db_connector.php";
    
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
    
    // 모드 검사
    $mode = $_GET["mode"];

    $num = "";
    $page = 1;
    
    if(isset($_GET["num"])){
        // delete, update 모드인 경우 num, page 가져옴
        $num = $_GET["num"];
        $page = $_GET["page"];

        // echo "$num";
    }
    $subject = $_POST["subject"];
    $content = $_POST["content"];

    $upfile_name = "";
    $upfile_type = "";
    $copied_file_name = "";

    switch($mode){
        case 'insert':
            insert_data();
            break;
            
        case 'update':
            update_data();
            break;

        case 'delete':
            delete_data();
            break;

        case 'select':
            break;
    }

    function delete_data(){
        global $num, $page;

        // $con = mysqli_connect("localhost", "root", "01240124", "my_page");
        $sql = "select * from board where num = $num";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
    
        $copied_name = $row["file_copied"];
    
        if($copied_name){
            $file_path = "./data/".$copied_name;
            unlink($file_path); // Deletes a file
        }
    
        $sql = "delete from board where num = $num";
        $result = mysqli_query($con, $sql);
        mysqli_close($con);
        if($result){
            echo "
                <script>
                    location.href = 'board_list.php?page=$page';
                </script>
            ";
        } else {
            echo "mysqli_error($con)";
        }
    }

    function insert_data(){
        global $user_id, $user_name, $subject, $content, $upfile_name, $upfile_type, $copied_file_name;

        check_data_format();

        $regist_day = date("Y-m-d (H:i)");
        
        check_file_uploaded();

        $con = mysqli_connect("localhost", "root", "01240124", "my_page");
        $sql = "insert into board (id, name, subject, content, regist_day, hit, file_name, file_type, file_copied) ";
        $sql .= "values ('$user_id', '$user_name', '$subject', '$content', '$regist_day', 0, ";
        $sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";
    
        mysqli_query($con, $sql);

        echo "<script>
            location.href = 'board_list.php';
            </script>";
    }

    function update_data(){
        global $num, $subject, $content, $upfile_name, $upfile_type, $copied_file_name, $page;
        check_data_format();

        $regist_day = date("Y-m-d (H:i)");

        check_file_uploaded();

        $con = mysqli_connect("localhost", "root", "01240124", "my_page");

        // 파일을 새로 안 올렸으면 파일 정보는 업데이트 안 함
        if($upfile_name){
            $sql = "update board set subject='$subject', content='$content', regist_day='$regist_day', file_name='$upfile_name', file_type='$upfile_type', file_copied='$copied_file_name' ";
        } else {
            $sql = "update board set subject='$subject', content='$content', regist_day='$regist_day' ";
        }
        $sql .= "where num = $num";
        $result = mysqli_query($con, $sql);
        if(!$result){
            echo "".mysqli_error($con);
        }

        echo "<script>
            location.href = 'board_list.php?page=$page';
            </script>";

    }

    function check_data_format(){
        global $subject, $content;

        $subject = htmlspecialchars($subject, ENT_QUOTES);
        $content = htmlspecialchars($content, ENT_QUOTES);

        date_default_timezone_set('Asia/Seoul');
    }

    function check_file_uploaded(){
        global $upfile_name, $upfile_type, $copied_file_name;

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
    
            $new_file_name = date("Y_m_d_H_i_s");
            $new_file_name .= $file_name;
            $copied_file_name = $new_file_name.".".$file_ext;
            $uploaded_file = $upload_dir.$copied_file_name;
    
            if($upfile_size > 1000000){
                echo("<script>
                    alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
                    history.go(-1);
                    </script>");
                exit;
            }
        
            if(!move_uploaded_file($upfile_tmp_name, $uploaded_file)){
                echo("<script>
                    alert('파일을 복사하는 데 실패했습니다. ');
                    history.go(-1);
                    </script>");
                exit;
            }
            
        } else {
            // 파일을 올리지 않은 경우
            $upfile_name = "";
            $upfile_type = "";
            $copied_file_name = "";
        }
    }
    
        

?>