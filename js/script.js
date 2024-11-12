document.addEventListener('DOMContentLoaded', function() {
    //偵測id
    const loginBtn = document.getElementById('loginBtn');
    const userBtn = document.getElementById('userBtn');
    const selectBtn = document.getElementById('selectBtn');
    const editArticleBtn = document.getElementById('editArticleBtn');
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
    document.addEventListener("click", function(event) {
        if (!industryInput.contains(event.target) && !dropdownList.contains(event.target)) {
            dropdownList.style.display = "none";
        }
    });
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
