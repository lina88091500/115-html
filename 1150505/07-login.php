<!DOCTYPE html>
<html lang="zh-Hant">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>粉色夢幻登入</title>
     <style>
          :root {
               /* 調節為更有質感的莫蘭迪粉色調 */
               --bg-color: #fff9fb;
               --primary-pink: #f8bbd0;
               --accent-pink: #ec407a;
               --text-main: #4a4a4a;
               --text-light: #9e9e9e;
               --white: #ffffff;
          }

          * {
               box-sizing: border-box;
               transition: all 0.3s ease;
          }

          body {
               margin: 0;
               min-height: 100vh;
               font-family: 'PingFang TC', 'Microsoft JhengHei', sans-serif;
               background: linear-gradient(135deg, #fff5f8 0%, #ffeef4 100%);
               display: flex;
               justify-content: center;
               align-items: center;
               padding: 20px;
          }

          /* 背景裝飾圓圈 - 增加層次感 */
          .bg-circle {
               position: fixed;
               border-radius: 50%;
               background: linear-gradient(135deg, rgba(248, 187, 208, 0.4), rgba(255, 255, 255, 0));
               z-index: -1;
          }

          .circle-1 {
               width: 400px;
               height: 400px;
               top: -100px;
               left: -100px;
          }

          .circle-2 {
               width: 300px;
               height: 300px;
               bottom: -50px;
               right: -50px;
          }

          .login-card {
               width: 100%;
               max-width: 420px;
               background: rgba(255, 255, 255, 0.8);
               backdrop-filter: blur(20px);
               border: 1px solid rgba(255, 255, 255, 0.5);
               border-radius: 32px;
               padding: 50px 40px;
               box-shadow: 0 20px 40px rgba(236, 64, 122, 0.08);
               text-align: center;
          }

          .header h1 {
               margin: 0;
               font-size: 28px;
               color: var(--text-main);
               letter-spacing: 2px;
               font-weight: 500;
          }

          .header p {
               font-size: 14px;
               color: var(--text-light);
               margin: 10px 0 40px;
          }

          .form-group {
               text-align: left;
               margin-bottom: 25px;
          }

          .form-group label {
               display: block;
               font-size: 14px;
               color: var(--text-main);
               margin-bottom: 8px;
               margin-left: 5px;
               font-weight: 500;
          }

          .input-wrapper {
               position: relative;
          }

          input {
               width: 100%;
               padding: 15px 20px;
               border-radius: 15px;
               border: 1px solid transparent;
               background: var(--white);
               box-shadow: 0 5px 15px rgba(0, 0, 0, 0.02);
               font-size: 16px;
               outline: none;
          }

          input:focus {
               border-color: var(--primary-pink);
               background: #fff;
               box-shadow: 0 8px 20px rgba(248, 187, 208, 0.2);
          }

          .help-links {
               display: flex;
               justify-content: space-between;
               margin-top: -10px;
               margin-bottom: 30px;
               font-size: 13px;
          }

          .help-links a {
               color: var(--text-light);
               text-decoration: none;
          }

          .help-links a:hover {
               color: var(--accent-pink);
          }

          .login-btn {
               width: 100%;
               padding: 16px;
               border: none;
               border-radius: 15px;
               background: linear-gradient(to right, #f48fb1, #f06292);
               color: white;
               font-size: 18px;
               font-weight: 500;
               cursor: pointer;
               box-shadow: 0 10px 20px rgba(240, 98, 146, 0.2);
          }

          .login-btn:hover {
               transform: translateY(-2px);
               box-shadow: 0 15px 25px rgba(240, 98, 146, 0.3);
               filter: brightness(1.05);
          }

          .footer-note {
               margin-top: 30px;
               font-size: 12px;
               color: var(--text-light);
          }

          /* 愛心小點綴 */
          .heart {
               color: var(--accent-pink);
               display: block;
               margin-bottom: 15px;
               font-size: 24px;
          }
     </style>
</head>

<body>

     <div class="bg-circle circle-1"></div>
     <div class="bg-circle circle-2"></div>

     <div class="login-card">
          <div class="header">
               <span class="heart">♥</span>
               <h1>Welcome Back</h1>
               <p>進入你的粉色夢幻世界</p>
          </div>

          <form action="user_center.php" method="post">
               <div class="form-group">
                    <label for="account">帳號</label>
                    <div class="input-wrapper">
                         <input type="text" id="account" name="account" placeholder="請輸入帳號" required>
                    </div>
               </div>

               <div class="form-group">
                    <label for="password">密碼</label>
                    <div class="input-wrapper">
                         <input type="password" id="password" name="password" placeholder="請輸入密碼" required>
                    </div>
               </div>

               <div class="help-links">
                    <a href="#">忘記密碼？</a>
                    <a href="#">註冊新會員</a>
               </div>

               <button type="submit" class="login-btn">立即登入</button>
          </form>

          <div class="footer-note">
               安全加密連線中 🌸 保護你的甜蜜資料
          </div>
     </div>

</body>

</html>