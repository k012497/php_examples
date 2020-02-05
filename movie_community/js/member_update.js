let pwPass = false;
let namePass = true;
let emailPass = true;
let mobilePass = true;

$(document).ready(function () {
    const inputPw1 = $("#password"), inputPw2 = $("#password2"), pwMsg = $("#password2Msg"); //pw
    const name = $("#name"), nameMsg = $("#nameMsg"); //name
    const email = $("#email"), emailMsg = $("#emailMsg"); //email
    const user_mobile = document.getElementById("mobile-num").value; //mobile
    const mobile = $("#mobile-num"), mobileMsg = $("#mobileMsg"); 
    const btnSave = $("#btn-save");

    // check password
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

    // check name
    name.keyup(function (e){
        const nameValue = name.val();
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
    email.keyup(function (e) { 
        const emailValue = email.val();
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
    mobile.keyup(function () {
        const mobileValue = mobile.val();
        const moblieReg = /^\d{3}-\d{3,4}-\d{4}$/; // 숫자 3개  숫자 3-4개 - 숫자 4개

        if(mobileValue !== user_mobile){
            //전화번호 수정 시 
            mobilePass = false;
            if(!moblieReg.test(mobileValue)){
                //수정한 값이 형식에 맞지 않을 때
                mobileMsg.text("(-)를 포함한 번호를 입력해주세요");
            } else {
                mobileMsg.text("");
                mobilePass = true;
            }
        } else {
            mobileMsg.text("");
            mobilePass = true;
        }
        isAllPass();
    });

    // make button disabled
    function isAllPass(){
        console.log(pwPass, namePass, emailPass, mobilePass);
        if(pwPass && namePass && emailPass && mobilePass) {
            btnSave.attr("disabled", false);
        } else {
            btnSave.attr("disabled", true);
        }
    }

});