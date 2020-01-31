<?php
    session_start();
    if(isset($_SESSION["userid"])){
        $user_id = $_SESSION["userid"];
    }else{
        $user_id = "";
    }

    if(isset($_SESSION["username"])){
        $user_name = $_SESSION["username"];
    }else{
        $user_name = "";
    }

    if(isset($_SESSION["usernum"])){
        $user_num = $_SESSION["usernum"];
    }else{
        $user_num = "";
    }
?>

            <div id="top">
                <h3>
                    <a href="index.php">MOVIEW</a>
                </h3>
                <ul id="top_menu">

<?php
    if(!$user_id){
?>
                <li><a href="sign_up_form.php">sign up</a></li>
                <li> | </li>
                <li><a href="sign_in_form.php">sign in</a></li>
<?php
    } else {
        $logged = $user_name."(".$user_id.") 감독님 ";
?>
        <li><?= $logged ?></li>
        <li> | </li>
        <li><a href="sign_out.php">sign out</a></li>
        <li> | </li>
        <li><a href="my_page.php">my page</a></li>
<?php
    }

    if($user_num == 1){
?>
        <li> | </li>
        <li><a href="admin.php">admin mode</a></li>
<?php
    }
?>
            </ul>   
        </div>