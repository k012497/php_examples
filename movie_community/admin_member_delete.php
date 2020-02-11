<?php
    session_start();
    include_once "db_connector.php";
    
    if (isset($_SESSION["usernum"])) $user_num = $_SESSION["usernum"];
    else $user_num = "";

    if ( $user_num != 1 )
    {
        echo("
            <script>
            alert('관리자가 아닙니다! 회원 삭제는 관리자만 가능합니다!');
            history.go(-1)
            </script>
        ");
                exit;
    }

    $num   = $_GET["num"];

    // $con = mysqli_connect("localhost", "root", "01240124", "my_page");
    $sql = "delete from members where num = $num";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'admin.php';
	     </script>
	   ";
?>

