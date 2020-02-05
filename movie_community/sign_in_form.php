<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MOVIEW | sign in</title>
    <link rel="stylesheet" href="./css/join_style.css?ver=1.1">
    <link rel="stylesheet" href="./css/common.css">
    <script>
        function switchIpSecurity(){
            const switchValue = document.querySelector("#ip-security-switch");
            if(switchValue.innerHTML === "ON"){
                switchValue.innerHTML = "OFF"
                alert("IP 보안을 해제합니다.");
            }else{
                switchValue.innerHTML = "ON"
                alert("IP 보안을 적용합니다.");
        }
}
    </script>
</head>
<body>
    <header style="background: transparent;">
        <?php include "header.php" ?>
    </header>

    <div id="sign-in">
        <h3><i> MOVIEW </i></h3>
        <form id="sign-in-form" method="post" action="sign_in.php">
            <input type="text" name="id" placeholder="ID"><br/>
            <input type="password" name="pw" placeholder="PASSWORD"><br/>
            <input id="btn-sign-in" type="submit" value="SIGN IN">
        </form>
        <div id="option">
            <form action="#">
                <div id="option-top">
                    <div id="login-status-chk">
                        <input type="checkbox"> 로그인 상태 유지
                    </div>
                    <div id="security">
                        IP 보안 <a id="ip-security-switch" href="#" onclick="switchIpSecurity();">ON</a> | 
                        <a href="#">일회용 로그인</a>
                    </div>
                </div>
                <div id="help">
                    <a href="#">아이디 찾기</a> | 
                    <a href="#">비밀번호 찾기</a> | 
                    <a href="sign_up_form.html">회원가입</a>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <?php include "footer.php" ?>
    </footer>
</body>
</html>