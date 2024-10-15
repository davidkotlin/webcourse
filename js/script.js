document.addEventListener('DOMContentLoaded', function() {
    // // 上傳
    // const submitBtn = document.getElementById('submitBtn');
    // if (submitBtn) {
    //     submitBtn.addEventListener('click', function() {
    //         document.getElementById('upload_form').submit();
    //     });
    // }
    // 登入
    const loginBtn = document.getElementById('loginBtn');
    loginBtn.addEventListener('click', function() {
        const account=document.getElementById("account");
        const password=document.getElementById("password");
        account.value=account.value.trim();
        password.value=password.value.trim();
        document.getElementById('loginForm').submit();
    });
    // // 註冊
    // const registerBtn = document.getElementById('registerBtn');
    // if (registerBtn) {
    //     registerBtn.addEventListener('click', function() {
    //         document.getElementById('registerForm').submit();
    //     });
    // }
});
