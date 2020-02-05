let idPass = false;
let pwPass = false;
let namePass = false;
let datePass = false;
let emailPass = true;
let validated = false;

function submitForm() { 
    if(validated){
        document.signUp.submit();
        console.log("validated");
        location.href = "sign_in_form.php";
    } else {
        console.log("not validated");
        alert("자동가입방지(captcha) 테스트를 완료해주세요!");
        document.getElementById("cpatchaTextBox").focus();
    }
}

function createCaptcha() {
    //clear the contents of captcha div first 
    document.getElementById('captcha-canv').innerHTML = "";
    
    var charsArray =
    "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!#$%^&*";
    var lengthOtp = 6;
    var captcha = [];
    for (var i = 0; i < lengthOtp; i++) {
      //below code will not allow Repetition of Characters
      var index = Math.floor(Math.random() * charsArray.length + 1); //get the next character from the array
      if (captcha.indexOf(charsArray[index]) == -1){
        captcha.push(charsArray[index]);
      } else {
        i--;
      }
    }
    var canv = document.createElement("canvas");
    canv.id = "captcha";
    canv.height = 50;
    var context = canv.getContext("2d");
    context.font = "34px Georgia";
    context.strokeText(captcha.join(""), 0, 30);
    //storing captcha so that can validate you can save it somewhere else according to your specific requirements
    code = captcha.join("");
    document.getElementById("captcha-canv").prepend(canv); // adds the canvas to the body element
}

function validateCaptcha() {
    if (document.getElementById("cpatchaTextBox").value == code) {
      alert("확인되었습니다.")
      validated = true;
    } else {
      alert("자동방지 문자를 다시 확인해주세요.");
      createCaptcha();
      validated = false;
    }
}

// function checkIdExisting(){
//     window.open("member_check_id.php?id=" + document.signUp.id.value,
//          "IDcheck",
//           "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
// }

function init() {  
    createCaptcha();
}

$(document).ready(function () {
    init();

    const inputId = $("#id"), idMsg = $("#idMsg");
    const btnIdCheck = $("#btn-id-check");
    const inputPw1 = $("#password"), inputPw2 = $("#password2"), pwMsg = $("#password2Msg");
    const inputDate = $("#dob"), dateMsg = $("#dobMsg");
    const inputName = $("#name"), nameMsg = $("#nameMsg");
    const inputEmail = $("#email"), emailMsg = $("#emailMsg");
    const inputMobile = $("#mobile-num"), mobileMsg = $("#mobileMsg"); 
    const btnSignUp = $("#btn-sign-up");

    // check id
    inputId.keyup(function (){
        const idValue = inputId.val();
        const regExp = /^[a-z]{1}[a-zA-Z0-9]{6,11}$/;

        if(idValue === "") {
            // 아이디 입력 안 할 경우
            idMsg.text('아이디를 입력해주세요.');
            idPass = false;
        } else if(!regExp.test(idValue)) {
            // 형식에 어긋날 경우
            idMsg.text("숫자, 영문 소문자로 6~12자, 첫 글자는 영문만 가능합니다.");
            idPass = false;
        } else {
            idMsg.text("아이디 중복 체크를 해주세요.");
            btnIdCheck.attr("disabled", false);
        }

        isAllPass();
    });

    // check if the id aleady exists (using ajax)
    btnIdCheck.click(function (){
        const idValue = inputId.val();

        $.ajax({
            type: "post",
            url: "member_check_id2.php",
            data: {"id" : idValue},
            success: function (response) {
                if(response === "exists"){
                    idMsg.text("이미 사용중인 아이디입니다.");
                    idPass = false;
                } else if(response === "none"){
                    idMsg.text("사용 가능한 아이디입니다.");
                    idPass = true;
                }
                isAllPass();
            }
        });
    });

    // check pw
    inputPw2.keyup(function(){
        const pwValue1 = inputPw1.val(), pwValue2 = inputPw2.val();
        const regExp = /^[a-zA-Z0-9]{8,20}$/;
    
        if(pwValue1 === "" || pwValue2 === "") {
            // 비밀번호 입력 안 할 경우
            pwMsg.text('비밀번호를 입력해주세요.');
            pwPass = false;
        } else if(!regExp.test(pwValue1)) {
            pwMsg.text("숫자, 영문으로 8~20자만 가능합니다.");
            pwPass = false;
        } else if(pwValue1 !== pwValue2) {
            pwMsg.text("비밀번호가 일치하지 않습니다.");
            pwPass = false;
        } else {
            pwMsg.text("");
            pwPass = true;
        }

        isAllPass();
    });

    // check birthday
    inputDate.change(function(){
        let dateValue = inputDate.val();

        let today = new Date();
        const year = String(today.getFullYear());
        const month = today.getMonth()+1 < 10 ? ("0" + String(today.getMonth() + 1)) : String(today.getMonth() + 1);
        const day = today.getDate()+1 < 10 ? ("0" + String(today.getDate() + 1)) : String(today.getDate() + 1);
        today = year + month + day;
        dateValue = dateValue.replace(/-/gi, "");

        if(dateValue > today) {
            dateMsg.text("오늘 날짜 이전으로 설정해주세요");
            datePass = false;
        } else {
            dateMsg.text("");
            datePass = true;
        }
        isAllPass();
    });

    // check name
    inputName.keyup(function (e){
        const nameValue = inputName.val();
        const nameReg = /^[가-힣]{2,6}$/;

        console.log("name is ", nameValue);

        if(!nameReg.test(nameValue)){
            nameMsg.text("공백 제외 한글 2~8자만 가능합니다.");
            namePass = false;
        } else {
            nameMsg.text("");
            namePass = true;
        }
        isAllPass();
    });

    // check email
    inputEmail.keyup(function (e) { 
        const emailValue = inputEmail.val();
        const emailReg = /([a-z0-9_-]+)@([a-z-]+)\.([a-z]{2,3})/; // 영문 또는 숫자 @ 영문 . 영문 2-3개

        console.log("emial is ", emailValue);
        
        if(emailValue === ""){
            emailMsg.text("");
            emailPass = true;
        } else if (!emailReg.test(emailValue)){
            emailMsg.text("올바른 이메일 주소형식을 사용해주세요.");
            emailPass = false;
        } else {
            emailMsg.text("");
            emailPass = true;
        }
        isAllPass();
    });

    // check mobile
    inputMobile.keyup(function () {
        const mobileValue = inputMobile.val();
        const moblieReg = /^\d{3}-\d{3,4}-\d{4}$/; // 숫자 3개  숫자 3-4개 - 숫자 4개

        if(!moblieReg.test(mobileValue)){
            //수정한 값이 형식에 맞지 않을 때
            mobileMsg.text("(-)를 포함한 번호를 입력해주세요");
            mobilePass = false;
        } else {
            mobileMsg.text("");
            mobilePass = true;
        }
        isAllPass();
    });

    // manage button disabled
    function isAllPass(){
        console.log(idPass , pwPass , datePass, namePass , emailPass);

        if(idPass && pwPass && datePass && namePass && emailPass){
            btnSignUp.attr("disabled", false);
        } else {
            btnSignUp.attr("disabled", true);
        }
    }
});