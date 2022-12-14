<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入</title>

    <script>
        // 結合JavaScript
        function alertSuccessEvent() {
            alert("你已登入成功!");
            document.location.href = "index.php"; 
        }
        function alertFailEvent() {
            alert("你的帳號密碼有誤!");
            document.location.href = "login.php"; 
        }
    </script>

    <?php
    //檢查有沒有來自index.php帳密的POST
    if (isset($_POST["Account"]) && isset($_POST["Password"])) {
        session_start();  // 啟用Session

        require("functions.php"); // require() 引用別的PHP檔案

        $Account = $_POST["Account"];                                       // 使用者帳號
        $Password = $_POST["Password"];                                     // 密碼
        $RemeberMe = isset($_POST["RemeberMe"]) ? $_POST["RemeberMe"] : ""; // 記住我
        $AccountCheckResult = Account_Check($Account, $Password);           // 帳號密碼驗證
        
        if ($AccountCheckResult) {
            // 依據有沒有勾選記住我？來設定LoginOK的Cookie的期限
            $date = ($RemeberMe == "YesRememberMe") ? strtotime("+10 days", time()) : strtotime("+1 minutes", time());

            setcookie("LoginOK", "OK", $date); // 建立LoginOK的Cookie，用來辨識使用者是否已經成功驗證帳號密碼

            echo "<script type='text/javascript'>alertSuccessEvent();</script>";
        } else {
            echo "<script type='text/javascript'>alertFailEvent();</script>";
        }
        exit;
    }
    ?>
</head>
<body>
</body>

</html>