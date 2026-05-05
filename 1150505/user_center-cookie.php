<?php
$user = $_COOKIE['login_user'] ?? '';
$logged_in = isset($_COOKIE['login']) && $_COOKIE['login'] === '1' && $user !== '';

// 登出邏輯
if (isset($_GET['logout'])) {
    setcookie('login', '', time() - 3600, '/');
    setcookie('login_user', '', time() - 3600, '/');
    header('Location: 08-login-cookie.php');
    exit();
}

// 權限檢查
if (!$logged_in) {
    header('Location: 08-login-cookie.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>櫻花季 🌸 會員專屬中心</title>
    <style>
        :root {
            --sakura-light: #fff0f3;
            --sakura-pink: #ffb7c5;
            --sakura-deep: #ff8fa3;
            --sakura-accent: #fb6f92;
            --text-main: #5d4a4d;
            --text-light: #a08a8e;
            --white-glass: rgba(255, 255, 255, 0.7);
        }

        * {
            box-sizing: border-box;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'PingFang TC', 'Microsoft JhengHei', sans-serif;
            background: linear-gradient(135deg, #fff0f3 0%, #ffdde1 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            overflow-x: hidden;
        }

        /* 櫻花背景 */
        .sakura-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .petal {
            position: absolute;
            background-color: #ffb7c5;
            border-radius: 150% 0 150% 0;
            opacity: 0.6;
            animation: fall linear infinite;
        }

        @keyframes fall {
            0% { transform: translate(0, -10px) rotate(0deg); opacity: 0; }
            10% { opacity: 0.8; }
            100% { transform: translate(100px, 100vh) rotate(360deg); opacity: 0; }
        }

        /* 頁面容器 */
        .page {
            width: min(1000px, 100%);
            position: relative;
            z-index: 10;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card-shell {
            background: var(--white-glass);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 2px solid rgba(255, 255, 255, 0.8);
            border-radius: 40px;
            padding: 40px;
            box-shadow: 0 20px 50px rgba(251, 111, 146, 0.1);
        }

        /* 導覽列 */
        .nav-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .logout-btn {
            color: var(--text-light);
            text-decoration: none;
            font-size: 14px;
            padding: 10px 20px;
            background: white;
            border-radius: 20px;
            border: 1px solid var(--sakura-pink);
            font-weight: 500;
        }

        .logout-btn:hover {
            background: var(--sakura-pink);
            color: white;
            transform: scale(1.05);
        }

        /* 會員核心資訊 */
        .hero {
            display: flex;
            gap: 40px;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 1px dashed var(--sakura-pink);
        }

        .avatar-icon {
            width: 130px;
            height: 130px;
            border-radius: 40px;
            background: white;
            display: grid;
            place-items: center;
            font-size: 4rem;
            box-shadow: 0 10px 25px rgba(251, 111, 146, 0.2);
            border: 3px solid white;
        }

        .hero-text h1 { margin: 0 0 10px; font-size: 2.2rem; color: var(--text-main); }
        .hero-text p { margin: 0; color: var(--text-light); font-size: 1.1rem; }

        /* 會員等級進度條 */
        .level-badge {
            display: inline-block;
            padding: 4px 12px;
            background: var(--sakura-accent);
            color: white;
            border-radius: 10px;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .progress-container {
            width: 100%;
            max-width: 300px;
            height: 8px;
            background: #eee;
            border-radius: 10px;
            margin-top: 15px;
            overflow: hidden;
        }

        .progress-bar {
            width: 75%;
            height: 100%;
            background: linear-gradient(to right, var(--sakura-pink), var(--sakura-accent));
        }

        /* 數據網格 */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .panel {
            border-radius: 25px;
            padding: 25px;
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid white;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.02);
        }

        .panel h2 { margin: 0; font-size: 14px; color: var(--text-light); text-transform: uppercase; letter-spacing: 1px; }
        .panel .value { font-size: 28px; font-weight: bold; color: var(--sakura-accent); margin: 10px 0; }

        /* 功能卡片 */
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .feature-card {
            border-radius: 30px;
            padding: 30px;
            background: white;
            border: 1px solid rgba(255, 183, 197, 0.3);
            position: relative;
            overflow: hidden;
        }

        .feature-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(251, 111, 146, 0.15); }

        .feature-card h3 { margin: 15px 0 10px; color: var(--text-main); }
        .feature-card p { margin: 0; color: var(--text-light); font-size: 14px; line-height: 1.6; }

        /* 最近活動紀錄 */
        .activity-list {
            margin-top: 15px;
            text-align: left;
        }

        .activity-item {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            padding: 8px 0;
            border-bottom: 1px solid #fff0f3;
        }

        .footer-note { margin-top: 50px; text-align: center; font-size: 13px; color: var(--text-light); }

        @media (max-width: 760px) { 
            .hero { flex-direction: column; text-align: center; } 
            .stats-grid { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>

<body>
    <!-- 櫻花背景 -->
    <div class="sakura-bg" id="sakura-container"></div>

    <div class="page">
        <div class="card-shell">
            <header class="nav-header">
                <a class="logout-btn" href="user_center-cookie.php?logout=1">退出登入 ⬅</a>
                <div style="color: var(--sakura-accent); font-weight: bold; letter-spacing: 1px;">🌸 SAKURA VIP MEMBER</div>
            </header>

            <!-- 會員標題區 -->
            <section class="hero">
                <div class="avatar-icon">🐱</div>
                <div class="hero-text">
                    <span class="level-badge">櫻花尊榮會員</span>
                    <h1>早安，<?= htmlspecialchars($user) ?></h1>
                    <p>感謝您與我們共度第 128 天。今天也要保持粉紅色的好心情喔！</p>
                    <div class="progress-container">
                        <div class="progress-bar"></div>
                    </div>
                    <small style="color: var(--text-light); font-size: 12px; display: block; margin-top: 8px;">
                        距離下一等級「櫻之王者」還差 150 pts
                    </small>
                </div>
            </section>

            <!-- 數據概覽 -->
            <div class="stats-grid">
                <div class="panel">
                    <h2>累積點數</h2>
                    <div class="value">1,250</div>
                    <p style="font-size: 12px; color: #4caf50;">+150 本週</p>
                </div>
                <div class="panel">
                    <h2>專屬優惠券</h2>
                    <div class="value">3 <small style="font-size: 14px;">張</small></div>
                    <p style="font-size: 12px; color: var(--sakura-deep);">最高 85 折</p>
                </div>
                <div class="panel">
                    <h2>心願清單</h2>
                    <div class="value">8</div>
                    <p style="font-size: 12px; color: var(--text-light);">已降價 2 件</p>
                </div>
                <div class="panel">
                    <h2>登入天數</h2>
                    <div class="value">42</div>
                    <p style="font-size: 12px; color: var(--text-light);">連續不中斷</p>
                </div>
            </div>

            <!-- 功能與動態 -->
            <div class="feature-grid">
                <!-- 最近活動 -->
                <article class="feature-card">
                    <span style="font-size: 2rem;">📜</span>
                    <h3>最近活動紀錄</h3>
                    <div class="activity-list">
                        <div class="activity-item">
                            <span>領取櫻花登入獎勵</span>
                            <span style="color: var(--text-light);">1小時前</span>
                        </div>
                        <div class="activity-item">
                            <span>更改了個人頭像</span>
                            <span style="color: var(--text-light);">昨天</span>
                        </div>
                        <div class="activity-item">
                            <span>收藏了「夢幻和服」</span>
                            <span style="color: var(--text-light);">3天前</span>
                        </div>
                    </div>
                </article>

                <!-- 專屬福利 -->
                <article class="feature-card" style="background: linear-gradient(135deg, #fff, #fff0f3);">
                    <span style="font-size: 2rem;">🎁</span>
                    <h3>本月專屬禮物</h3>
                    <p>您的「春季櫻花限量擴香」已準備就緒，點擊下方按鈕填寫寄送地址。</p>
                    <button style="margin-top: 15px; padding: 8px 15px; border: none; background: var(--sakura-accent); color: white; border-radius: 12px; cursor: pointer;">立即領取</button>
                </article>

                <!-- 設定中心 -->
                <article class="feature-card">
                    <span style="font-size: 2rem;">⚙️</span>
                    <h3>帳號安全性</h3>
                    <p>您的帳號目前受 Cookie 加密保護。建議定期更換密碼以維持甜蜜安全。</p>
                    <a href="#" style="color: var(--sakura-accent); font-size: 13px; text-decoration: none; display: block; margin-top: 10px;">前往設定 →</a>
                </article>
            </div>

            <p class="footer-note">🌸 櫻花季專屬連線中 · 祝您有美好的一天 🌸</p>
        </div>
    </div>

    <script>
        // 動態生成飄落櫻花
        function createPetals() {
            const container = document.getElementById('sakura-container');
            const petalCount = 15;
            for (let i = 0; i < petalCount; i++) {
                const petal = document.createElement('div');
                petal.className = 'petal';
                const size = Math.random() * 12 + 8 + 'px';
                petal.style.width = size;
                petal.style.height = size;
                petal.style.left = Math.random() * 100 + 'vw';
                petal.style.animationDuration = Math.random() * 5 + 5 + 's';
                petal.style.animationDelay = Math.random() * 5 + 's';
                container.appendChild(petal);
            }
        }
        createPetals();
    </script>
</body>

</html>
</body>
</html>
