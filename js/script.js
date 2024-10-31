document.addEventListener('DOMContentLoaded', function() {
    //偵測id
    const loginBtn = document.getElementById('loginBtn');
    const userBtn = document.getElementById('userBtn');
    const selectBtn = document.getElementById('selectBtn');
    const editArticleBtn = document.getElementById('editArticleBtn');
    // 登入
    if (loginBtn) {
        loginBtn.addEventListener('click', function() {
            const account=document.getElementById("account");
            const password=document.getElementById("password");
            account.value=account.value.trim();
            password.value=password.value.trim();
            document.getElementById('loginForm').submit();
        });
    }
    //回到user.php
    if (userBtn) {
        userBtn.addEventListener('click', function() {
            window.location.href = 'user.php';
        });
    }
    //到select.php
    if (selectBtn) {
        selectBtn.addEventListener('click', function() {
            window.location.href = 'select.php';
        });
    }
    //到upload.php
    if (editArticleBtn) {
        editArticleBtn.addEventListener('click', function() {
            window.location.href = 'myArticle.php';
        });
    }
    // // 註冊
    // const registerBtn = document.getElementById('registerBtn');
    // if (registerBtn) {
    //     registerBtn.addEventListener('click', function() {
    //         document.getElementById('registerForm').submit();
    //     });
    // }
    // // 上傳
    // const submitBtn = document.getElementById('submitBtn');
    // if (submitBtn) {
    //     submitBtn.addEventListener('click', function() {
    //         document.getElementById('upload_form').submit();
    //     });
    // }
});
