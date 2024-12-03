document.addEventListener('DOMContentLoaded', function() {
    //偵測id
    const loginBtn = document.getElementById('loginBtn');
    const registerBtn = document.getElementById('registerBtn');
    const submitBtn = document.getElementById('submitBtn');
    const userBtn = document.getElementById('userBtn');
    const selectBtn = document.getElementById('selectBtn');
    const editArticleBtn = document.getElementById('editArticleBtn');
    const manageAccountBtn = document.getElementById('manageAccountBtn');
    const editAccountBtn = document.getElementById('editAccountBtn');
    const editEmailBtn = document.getElementById('editEmailBtn');
    const editNameBtn = document.getElementById('editNameBtn');
    const editPasswordBtn = document.getElementById('editPasswordBtn');
    const container = document.querySelector('.container');
    const industryInput = document.getElementById("industry_input");
    const dropdownList = document.getElementById("dropdown_list");
    const industries = [
        { value: "ElectronicElectrical", text: "電子電機" },
        { value: "ComputerPeripherals", text: "電腦周邊" },
        { value: "Semiconductors", text: "半導體" },
        { value: "CommunicationNetworks", text: "通訊網路" },
        { value: "InformationServices", text: "資訊服務" },
        { value: "FinanceInsurance", text: "金融保險" },
        { value: "BiotechnologyMedical", text: "生技醫療" },
        { value: "TextilesFibers", text: "紡織纖維" },
        { value: "Chemical", text: "化學工業" },
        { value: "Food", text: "食品工業" },
        { value: "Tourism", text: "觀光餐旅" },
        { value: "Others", text: "其他" }
    ];    
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
    // 註冊
    if (registerBtn) {
        registerBtn.addEventListener('click', function() {
            const account=document.getElementById("account");
            const name=document.getElementById("name");
            const password=document.getElementById("password");
            const role=document.getElementById("role");
            account.value=account.value.trim();
            name.value=name.value.trim();
            password.value=password.value.trim();
            role.value=role.value.trim();
            document.getElementById('registerForm').submit();
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
    //到managingAccount.php
    if (manageAccountBtn) {
        manageAccountBtn.addEventListener('click', function() {
            window.location.href = 'managingAccount.php';
        });  
    }
    //產業選擇選單
    if (industryInput) {
        // 點擊輸入框時顯示所有選項
        industryInput.addEventListener("focus", showDropdown);
        // 當輸入文字時，動態篩選顯示符合條件的選項
        industryInput.addEventListener("input", showDropdown);
        // 點擊選項時選定該選項並隱藏清單
        function showDropdown() {
            const input = industryInput.value.toLowerCase();
            dropdownList.innerHTML = ""; // 清空之前的選項，讓每次篩選的結果都會顯示當前匹配的內容。
            //1.先篩選
            const filteredIndustries = industries.filter(industry =>
                industry.text.toLowerCase().includes(input)//若input空值對所有選項都會返回 true
            );
            //2.再將篩選後的選項加入下拉清單
            if (filteredIndustries.length) {
                // 生成篩選後的選項清單
                filteredIndustries.forEach(industry => {
                    const optionDiv = document.createElement("div");
                    optionDiv.textContent = industry.text;
                    optionDiv.dataset.value = industry.value;

                    // 點擊選項時填入輸入框並隱藏清單
                    optionDiv.addEventListener("click", function() {
                        industryInput.value = this.textContent;
                        dropdownList.style.display = "none";
                    });

                    dropdownList.appendChild(optionDiv);
                });
            } else {
                // 顯示「沒有符合的選項」
                const noOptionDiv = document.createElement("div");
                noOptionDiv.textContent = "沒有符合的選項";
                noOptionDiv.classList.add("no-options");
                dropdownList.appendChild(noOptionDiv);
            }

            // 顯示下拉清單
            dropdownList.style.display = "block";
        } 
    }
    // 點擊其他區域時隱藏下拉選單
    if (industryInput && dropdownList) {
        document.addEventListener("click", function(event) {
            if (!industryInput.contains(event.target) && !dropdownList.contains(event.target)) {
                dropdownList.style.display = "none";
            }
        });
    }
    // 管理帳號
    if (editAccountBtn) {
        editAccountBtn.addEventListener('click', function() {
            const account=document.getElementById("account");
            const name=document.getElementById("name");
            const role=document.getElementById("role");
            account.value=account.value.trim();
            name.value=name.value.trim();
            role.value=role.value.trim();
            if (!account.value) {
                alert("請輸入會員電子郵件！");
                account.focus();
                return; // 阻止表单提交
            }
            if (!name.value) {
                alert("請輸入會員名稱！");
                name.focus();
                return; // 阻止表单提交
            }
            if (!role.value) {
                alert("請選擇會員角色！");
                role.focus();
                return; // 阻止表单提交
            }
            document.getElementById('editAccount_form').submit();
        })
    }
    //使用者修改電子郵件
    if (editEmailBtn) {
        editEmailBtn.addEventListener('click', function() {
            const userId = document.getElementById("userId").value;
            const emailInput = document.getElementById("account");
            const email = emailInput.value.trim();
            console.log(email);
            console.log(userId);
            fetch("userRevise.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    userId: userId,
                    userEmail: email
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text(); // 确保只解析 JSON 响应
            })
            .then(data => {
            try {
                const jsonData = JSON.parse(data); // 解析 JSON
                if (jsonData.success) {
                    alert("修改成功");
                    window.location.href = "user.php";
                } else {
                    alert("修改失败：" + jsonData.message);
                    window.location.href = "user.php";
                }
            } catch (error) {
                console.error("JSON 解析失败：", error);
            }
            })
            .catch(error => {
                console.error("發生錯誤:", error);
            });
        })
    }
    //使用者修改名稱
    if (editNameBtn) {
        editNameBtn.addEventListener('click', function() {
            const userId = document.getElementById("userId").value;
            const nameInput = document.getElementById("name");
            const name = nameInput.value.trim();
            console.log(name);
            console.log(userId);
            fetch("userRevise.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    userId: userId,
                    userName: name
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text(); // 确保只解析 JSON 响应
            })
            .then(data => {
            try {
                const jsonData = JSON.parse(data); // 解析 JSON
                if (jsonData.success) {
                    alert("修改成功");
                    window.location.href = "user.php";
                } else {
                    alert("修改失败：" + jsonData.message);
                    window.location.href = "user.php";
                }
            } catch (error) {
                console.error("JSON 解析失败：", error);
            }
            })
            .catch(error => {
                console.error("發生錯誤:", error);
            })
        })
    }
    //使用者修改密碼
    if (editPasswordBtn) {
        editPasswordBtn.addEventListener('click', function() {
            const userId = document.getElementById("userId").value;
            const passwordInput = document.getElementById("password");
            const password = passwordInput.value.trim();
            console.log(password);
            console.log(userId);
            fetch("userRevise.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    userId: userId,
                    userPassword: password
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text(); // 确保只解析 JSON 响应
            })
            .then(data => {
            try {
                const jsonData = JSON.parse(data); // 解析 JSON
                if (jsonData.success) {
                    alert("修改成功");
                    window.location.href = "user.php";
                } else {
                    alert("修改失败：" + jsonData.message);
                    window.location.href = "user.php";
                }
            } catch (error) {
                console.error("JSON 解析失败：", error);
            }
            })
            .catch(error => {
                console.error("發生錯誤:", error);
            })
        })
    }
    //小視窗函數
    window.openModal = function(accountId) {
        document.getElementById("deleteModal").style.display = "flex";
        document.getElementById("accountId").value = accountId;
        document.getElementById("deleteForm").action = "deleteAccount.php?id=" + accountId;
    }
    window.closeModal = function() {
        document.getElementById("deleteModal").style.display = "none";
    }
    window.confirmDelete = function() {
        document.getElementById("deleteForm").submit();
    }
    // 上傳
    if (submitBtn) {
        submitBtn.addEventListener('click', function() {
            event.preventDefault(); // 防止表單默認提交行為
            const imageInput = document.getElementById("image");
            const fileInput = document.getElementById("file");
            // 確保檔案元素存在並取出檔案物件
            const image = imageInput && imageInput.files.length > 0 ? imageInput.files[0] : null;
            const file = fileInput && fileInput.files.length > 0 ? fileInput.files[0] : null;

            const article_title=document.getElementById("article_title").value.trim();
            const industry_input=document.getElementById("industry_input").value.trim();
            const article_content=document.getElementById("article_content").value.trim();
            console.log(image);
            console.log(article_title);
            console.log(industry_input);
            console.log(article_content);
            console.log(file);
            document.getElementById('upload_form').submit();
        });
    }
    //關注
    if (container){
        //事件委派
        container.addEventListener('click', (event) => {
            const target = event.target;
        
            // 判斷點擊的是否是關注或取消關注按鈕
            if (target.id.startsWith('followBtn-')) {
                const article_id = target.id.split('-')[1];
                follow(article_id, target.id);
            } else if (target.id.startsWith('unfollowBtn-')) {
                const article_id = target.id.split('-')[1];
                unfollow(article_id, target.id);
            }
        });
    }
    // Follow 函數
    function follow(article_id, followBtnId) {
    console.log("Follow:", followBtnId);
    console.log("Article ID:", article_id);
    fetch("follow.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            article_id: article_id
        })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json(); // 確保只解析 JSON 響應
        })
        .then(jsonData => {
            if (jsonData.success) {
                const followContainer = document.getElementById(`followContainer-${article_id}`);
                if (followContainer) {
                    followContainer.innerHTML = `
                        <button class='btn' id='unfollowBtn-${article_id}' type='button'>取消關注</button>
                    `;
                }
            } else {
                alert("Follow 失敗：" + jsonData.message);
            }
        })
        .catch(error => {
            console.error("Follow 發生錯誤:", error);
        });
    }
    // Unfollow 函數
    function unfollow(article_id, unfollowBtnId) {
        console.log("Unfollow:", unfollowBtnId);
        console.log("Article ID:", article_id);
        fetch("unfollow.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                article_id: article_id
            })
        })
            .then(response => response.json())
            .then(jsonData => {
                if (jsonData.success) {
                    const followContainer = document.getElementById(`followContainer-${article_id}`);
                    if (followContainer) {
                        followContainer.innerHTML = `
                            <button class='btn' id='followBtn-${article_id}' type='button'>關注</button>
                        `;
                    }
                } else {
                    alert("取消關注失敗：" + jsonData.message);
                }
            })
            .catch(error => {
                console.error("取消關注發生錯誤:", error);
            });
    }     
});
