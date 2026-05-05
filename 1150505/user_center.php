<?php

if(!($_POST['username']=='mack' && $_POST['password']=='1234')){
    echo "帳號或密碼錯誤,請重新登入";
    echo "<a href='07-login-get.php'>登入</a>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>會員中心 - 夢幻日系</title>
     <style>
          :root {
               /* 延續高級感莫蘭迪粉色調 */
               --bg-gradient: linear-gradient(135deg, #fff5f8 0%, #ffeef4 100%);
               --surface-glass: rgba(255, 255, 255, 0.75);
               --primary-pink: #f8bbd0;
               --accent-pink: #ec407a;
               --text-main: #5a2f40;
               --text-soft: #8f6072;
               --border-thin: rgba(248, 187, 208, 0.4);
               --shadow-soft: 0 20px 40px rgba(236, 64, 122, 0.08);
          }

          * {
               box-sizing: border-box;
               transition: all 0.3s ease;
          }

          body {
               margin: 0;
               min-height: 100vh;
               font-family: 'PingFang TC', 'Microsoft JhengHei', sans-serif;
               background: var(--bg-gradient);
               color: var(--text-main);
               display: flex;
               justify-content: center;
               align-items: center;
               padding: 24px;
               overflow-x: hidden;
          }

          /* 背景裝飾圓圈 */
          .bg-decoration {
               position: fixed;
               border-radius: 50%;
               background: radial-gradient(circle, rgba(248, 187, 208, 0.3), transparent 70%);
               z-index: -1;
          }

          .circle-1 {
               width: 500px;
               height: 500px;
               top: -150px;
               left: -100px;
          }

          .circle-2 {
               width: 400px;
               height: 400px;
               bottom: -100px;
               right: -50px;
          }

          .page {
               width: min(900px, 100%);
               position: relative;
               animation: fadeIn 0.8s ease-out;
          }

          @keyframes fadeIn {
               from {
                    opacity: 0;
                    transform: translateY(10px);
               }

               to {
                    opacity: 1;
                    transform: translateY(0);
               }
          }

          .card-shell {
               position: relative;
               background: var(--surface-glass);
               backdrop-filter: blur(20px);
               -webkit-backdrop-filter: blur(20px);
               border: 1px solid rgba(255, 255, 255, 0.6);
               border-radius: 40px;
               padding: 45px;
               box-shadow: var(--shadow-soft);
          }

          /* 頂部導航區 */
          .nav-header {
               display: flex;
               justify-content: space-between;
               align-items: center;
               margin-bottom: 40px;
          }

          .back-link {
               color: var(--text-soft);
               text-decoration: none;
               font-size: 14px;
               display: flex;
               align-items: center;
               gap: 5px;
               padding: 8px 16px;
               background: rgba(255, 255, 255, 0.5);
               border-radius: 20px;
               border: 1px solid var(--border-thin);
          }

          .back-link:hover {
               background: #fff;
               color: var(--accent-pink);
               transform: translateX(-3px);
          }

          /* 個人資料橫幅 */
          .hero {
               display: flex;
               gap: 35px;
               align-items: center;
               margin-bottom: 45px;
               border-bottom: 1px dashed var(--border-thin);
               padding-bottom: 40px;
          }

          .avatar-wrapper {
               position: relative;
          }

          .avatar-icon {
               width: 120px;
               height: 120px;
               border-radius: 35px;
               background: linear-gradient(135deg, #fff, #ffeef4);
               display: grid;
               place-items: center;
               font-size: 3.5rem;
               border: 1px solid var(--border-thin);
               box-shadow: 0 15px 30px rgba(248, 187, 208, 0.2);
          }

          .status-dot {
               position: absolute;
               bottom: 5px;
               right: 5px;
               width: 24px;
               height: 24px;
               background: #fff;
               border-radius: 50%;
               display: flex;
               align-items: center;
               justify-content: center;
               font-size: 12px;
               border: 1px solid var(--border-thin);
          }

          .hero-text h1 {
               margin: 0 0 10px;
               font-size: 2rem;
               letter-spacing: 1px;
               color: var(--text-main);
          }

          .hero-text p {
               margin: 0;
               color: var(--text-soft);
               line-height: 1.6;
               max-width: 450px;
          }

          /* 數據卡片區 */
          .stats-grid {
               display: grid;
               grid-template-columns: repeat(3, 1fr);
               gap: 20px;
               margin-bottom: 40px;
          }

          .panel {
               border-radius: 25px;
               padding: 25px;
               background: rgba(255, 255, 255, 0.6);
               border: 1px solid var(--border-thin);
               text-align: center;
          }

          .panel:hover {
               background: #fff;
               transform: translateY(-5px);
               box-shadow: 0 15px 30px rgba(236, 64, 122, 0.05);
          }

          .panel h2 {
               margin: 0 0 12px;
               font-size: 15px;
               color: var(--accent-pink);
               text-transform: uppercase;
               letter-spacing: 1px;
          }

          .panel p {
               margin: 0;
               color: var(--text-main);
               font-size: 14px;
               line-height: 1.5;
          }

          /* 功能特色區 */
          .feature-grid {
               display: grid;
               grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
               gap: 20px;
          }

          .feature {
               border-radius: 25px;
               padding: 30px 25px;
               background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(255, 245, 249, 0.7));
               border: 1px solid rgba(255, 255, 255, 0.8);
               position: relative;
          }

          .feature:hover {
               border-color: var(--primary-pink);
          }

          .feature .icon {
               font-size: 1.8rem;
               margin-bottom: 15px;
               display: block;
          }

          .feature h3 {
               margin: 0 0 10px;
               font-size: 16px;
               font-weight: 600;
          }

          .feature p {
               margin: 0;
               color: var(--text-soft);
               font-size: 13.5px;
               line-height: 1.7;
          }

          .ribbon {
               position: absolute;
               top: 15px;
               right: 15px;
               padding: 4px 10px;
               border-radius: 10px;
               background: var(--primary-pink);
               color: #fff;
               font-size: 10px;
               font-weight: 700;
               letter-spacing: 1px;
          }

          .footer-note {
               margin-top: 50px;
               text-align: center;
               font-size: 13px;
               color: var(--text-soft);
               opacity: 0.8;
          }

          @media (max-width: 768px) {
               .hero {
                    flex-direction: column;
                    text-align: center;
               }

               .stats-grid {
                    grid-template-columns: 1fr;
               }

               .card-shell {
                    padding: 30px 20px;
               }
          }
     </style>
</head>

<body>

     <div class="bg-decoration circle-1"></div>
     <div class="bg-decoration circle-2"></div>

     <div class="page">
          <div class="card-shell">
               <header class="nav-header">
                    <a class="back-link" href="./07-login.php"><span>←</span> 返回登入</a>
                    <div style="color: var(--primary-pink)">♥ Member Only</div>
               </header>

               <section class="hero">
                    <div class="avatar-wrapper">
                         <div class="avatar-icon">🐰</div>
                         <div class="status-dot">🌸</div>
                    </div>
                    <div class="hero-text">
                         <h1>Welcome, Sakura</h1>
                         <p>今天是個充滿粉色心情的好日子。在這裡查看您的專屬福利與收藏清單，享受我們為您準備的甜蜜驚喜。</p>
                    </div>
               </section>

               <div class="stats-grid">
                    <div class="panel">
                         <h2>專屬優惠</h2>
                         <p>已解鎖 3 個隱藏折扣</p>
                    </div>
                    <div class="panel">
                         <h2>收藏紀錄</h2>
                         <p>12 件心動商品</p>
                    </div>
                    <div class="panel">
                         <h2>甜美點數</h2>
                         <p>目前累積 850 pts</p>
                    </div>
               </div>

               <div class="feature-grid">
                    <article class="feature">
                         <span class="icon">💌</span>
                         <div class="ribbon">NEW</div>
                         <h3>甜心信箱</h3>
                         <p>接收節日驚喜以及會員限定消息通知。</p>
                    </article>
                    <article class="feature">
                         <span class="icon">💎</span>
                         <h3>VIP 禮遇</h3>
                         <p>升級解鎖更多珍藏商品與優先購買權。</p>
                    </article>
                    <article class="feature">
                         <span class="icon">🌸</span>
                         <h3>粉系日記</h3>
                         <p>記錄您的購物心情，打造夢幻回憶。</p>
                    </article>
               </div>

               <p class="footer-note">安全連線中 🌸 您的個人資料受到甜蜜保護</p>
          </div>
     </div>

</body>

</html>