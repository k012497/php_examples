<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" href="./css/join_style.css">
    <link rel="stylesheet" href="./css/common.css">
    <script src="./js/sign_up2.js"></script>
    <style>
        #idMsg {
            display: inline-block;
            width: 350px;
        }
    </style>
    <title>MOVIEW | sign up</title>
</head>
<body>
    <header style="background: transparent;">
        <?php include "header.php"; ?>
    </header>
    <div id="sign-up">
        <h3>✱<i> welcome! </i>✱</i></h3>
        <br />
        <form id="sign-up-form" name="signUp" method="POST" action="member_insert.php">
            <label for="id">id</label>
            <input id="id" class="required" name="id" type="text" required>
            <input id="btn-id-check" type="button" value="check" disabled=true>
            <span class="warning-msg" id="idMsg"></span><br />
    
            <label for="password">password</label>
            <input id="password" class="required" name="password" type="password" required>
            <span class="warning-msg" id="password1Msg"></span><br />
    
            <label for="password2">check password</label>
            <input id="password2" class="required" name="passwordCheck" type="password" required>
            <span class="warning-msg" id="password2Msg"></span><br />
    
            <label for="name">name</label>
            <input id="name" class="required" name="name" type="text" required>
            <span class="warning-msg" id="nameMsg"></span><br />
    
            <label for="dob">date of birth</label>
            <input id="dob" class="required" name="birthday" type="date" required>
            <span class="warning-msg" id="dobMsg"></span><br />
    
            <label for="gender">gender</label>
            <select name="gender">
                <option value="female">female</option>
                <option value="male">male</option>
             </select>
             <span class="warning-msg"></span><br />
    
            <label for="email">email(option)</label>
            <input id="email" name="email" type="text">
            <span class="warning-msg" id="emailMsg"></span><br />
    
            <label for="mobile">mobile</label>
            <select name="country">
                <option value="korea">대한민국 +82</option>
                <option value="greece">그리스 +30</option>
                <option value="korea">미국 +82</option>
                <option value="korea">뉴질랜드 +82</option>
                <option value="korea">스페인 +82</option>
                <option value="korea">캐나다 +82</option>
                <option value="korea">호주 +82</option>
             </select>
            <input id="mobile-num" class="required" name="mobile" type="text" required>
            <input id="btn-code" type="button" value="인증번호 받기"><br />
            <input id="code" name="code" type="text"  placeholder="인증번호">
            <span class="warning-msg" id="mobileMsg"></span><br />

            <label for="chptcha">captcha</label>
            <div id="captcha">
                <div id="captcha-canv"></div>
                <input id="cpatchaTextBox" class="required" type="text" placeholder="captcha" required/>
                <input id="btnCaptchaChk" type="button" value="validate" onclick="validateCaptcha();"/>
            </div>

            <input id="btn-sign-up" type="button" value="sign up" onclick="submitForm()">
        </form>
    </div>
    
    <footer>
        <?php include "footer.php"; ?>
    </footer>
</body>
</html>