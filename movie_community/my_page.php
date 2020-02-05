<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" href="./css/join_style.css">
    <link rel="stylesheet" href="./css/common.css">
    <!-- <link rel="stylesheet" href="./css/main.css"> -->
    <script src="./js/member_update.js"></script>
    <style>
        #idMsg {
            display: inline-block;
            width: 350px;
        }

        #sign-up-form #id {
            width: 350px;
        }
    </style>
    <title>MOVIEW | my page</title>
</head>
<body>
    <header>
        <?php include "header.php"; ?>
    </header>
    <nav>
        <?php include "nav.php"; ?>
    </nav>

    <section>
        <!-- <div id="main_img_bar">
            <img src="./img/message.jpeg" width="1000px">
        </div> -->
        <?php include "member_select.php"?>
        <div id="sign-up">
            <h3><i> my page </i></h3>
            <br />
            <form id="sign-up-form" name="member_update" method="POST" action="member_update.php?userId=<?=$user_id?>">
                <label for="id">id</label>
                <input id="id" class="required" name="id" type="text" value="<?=$user_id?>" disabled="true" required>
                <br />
                <span class="warning-msg" id="idMsg"></span><br />
        
                <label for="password">password</label>
                <input id="password" class="required" name="password" type="password" required>
                <span class="warning-msg" id="password1Msg"></span><br />
        
                <label for="password2">check password</label>
                <input id="password2" class="required" name="passwordCheck" type="password" required>
                <span class="warning-msg" id="password2Msg"></span><br />
        
                <label for="name">name</label>
                <input id="name" class="required" name="name" value="<?=$user_name?>" type="text" required>
                <span class="warning-msg" id="nameMsg"></span><br />
        
                <label for="dob">date of birth</label>
                <input id="dob" class="required" name="dob" value="<?=$user_birthday?>" type="text" disabled="true" required>
                <span class="warning-msg" id="dobMsg"></span><br />
        
                <label for="gender">gender</label>
                <input id="gender" class="required" name="gender" value="<?=$user_gender?>" type="text" disabled="true" required>
                <span class="warning-msg"></span><br />
        
                <label for="email">email(option)</label>
                <input id="email" name="email" value="<?=$user_email?>"type="text">
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
                <input id="mobile-num" class="required" name="mobile" type="text" value="<?=$user_mobile?>" required>
                <input id="btn-code" type="button" value="인증번호 받기"><br />
                <input id="code" name="code" type="text"  placeholder="인증번호">
                <span class="warning-msg" id="mobileMsg"></span><br />
    
                <input id="btn-save" type="submit" value="save" onsubmit="console.log('완ㄹ뇨!');">
            </form>
        </div>
    </section>
    
    <footer>
        <?php include "footer.php"; ?>
    </footer>
</body>
</html>