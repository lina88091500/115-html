<?php
// 初始化所有可能用到的變數，避免出現 Undefined variable 錯誤
$login_error = '';
$register_message = '';
$show_register = false;
$registered_account = $_COOKIE['registered_account'] ?? '';
$registered_password = $_COOKIE['registered_password'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // 處理註冊邏輯
    if ($action === 'register') {
        $new_account = trim($_POST['new_account'] ?? '');
        $new_password = trim($_POST['new_password'] ?? '');

        if ($new_account === '' || $new_password === '') {
            $register_message = '請完成所有註冊欄位';
            $show_register = true;
        } else {
            setcookie('registered_account', $new_account, time() + 86400 * 30, '/');
            setcookie('registered_password', $new_password, time() + 86400 * 30, '/');
            header('Location: 08-login-cookie.php?registered=1');
            exit();
        }
    }

    // 處理登入邏輯
    if ($action === 'login') {
        $account = trim($_POST['account'] ?? '');
        $password = trim($_POST['password'] ?? '');

        $valid = false;
        if ($account === 'mack' && $password === '1234') {
            $valid = true;
        } elseif ($registered_account !== '' && $account === $registered_account && $password === $registered_password) {
            $valid = true;
        }

        if ($valid) {
            setcookie('login', '1', time() + 3600, '/');
            setcookie('login_user', $account, time() + 3600, '/');
            header('Location: user_center-cookie.php');
            exit();
        } else {
            $login_error = '帳號或密碼錯誤，請重新登入';
        }
    }
}

// 處理註冊成功後的跳轉提示
if (isset($_GET['registered'])) {
    $register_message = '註冊成功！請用新帳號登入。';
    $show_register = false;
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>櫻花季 🌸 Cookie登入</title>
    <style>
        :root {
            --sakura-light: #fff0f3;
            --sakura-pink: #ffb7c5;
            --sakura-deep: #ff8fa3;
            --sakura-accent: #fb6f92;
            --text-main: #5d4a4d;
            --text-light: #a08a8e;
            --white-glass: rgba(255, 255, 255, 0.75);
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

        /* 櫻花飄落背景容器 */
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
            opacity: 0.7;
            animation: fall linear infinite;
        }

        @keyframes fall {
            0% { transform: translate(0, -10px) rotate(0deg); opacity: 0; }
            10% { opacity: 0.8; }
            100% { transform: translate(100px, 100vh) rotate(360deg); opacity: 0; }
        }

        .login-card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 420px;
            background: var(--white-glass);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 2px solid rgba(255, 255, 255, 0.8);
            border-radius: 40px;
            padding: 50px 40px;
            box-shadow: 0 15px 35px rgba(251, 111, 146, 0.15);
            text-align: center;
        }

        .header-icon {
            font-size: 40px;
            margin-bottom: 15px;
            display: inline-block;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .header h1 { margin: 0; font-size: 26px; color: var(--text-main); letter-spacing: 2px; }
        .header p { font-size: 14px; color: var(--text-light); margin: 10px 0 35px; }

        .form-group { text-align: left; margin-bottom: 22px; }
        .form-group label { display: block; font-size: 14px; color: var(--text-main); margin-bottom: 8px; margin-left: 8px; font-weight: 500; }

        input {
            width: 100%;
            padding: 14px 20px;
            border-radius: 20px;
            border: 1.5px solid transparent;
            background: rgba(255, 255, 255, 0.9);
            font-size: 16px;
            outline: none;
        }

        input:focus { border-color: var(--sakura-pink); box-shadow: 0 0 15px rgba(255, 183, 197, 0.4); }

        .help-links { display: flex; justify-content: space-between; margin-top: -5px; margin-bottom: 25px; font-size: 13px; }
        .help-links a { color: var(--text-light); text-decoration: none; cursor: pointer; }
        .help-links a:hover { color: var(--sakura-accent); }

        .login-btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 20px;
            background: linear-gradient(135deg, #ff8fa3, #fb6f92);
            color: white;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(251, 111, 146, 0.3);
        }

        .login-btn:hover { transform: translateY(-3px); box-shadow: 0 12px 25px rgba(251, 111, 146, 0.4); }

        .message {
            margin-bottom: 20px;
            padding: 12px 18px;
            border-radius: 15px;
            font-size: 14px;
            color: #d63384;
            background: rgba(255, 183, 197, 0.3);
            border-left: 4px solid var(--sakura-deep);
            text-align: left;
        }

        .footer-note { margin-top: 30px; font-size: 12px; color: var(--text-light); }
        
        #register-section { display: <?php echo $show_register ? 'block' : 'none'; ?>; }
        #login-section { display: <?php echo $show_register ? 'none' : 'block'; ?>; }
    </style>
</head>

<body>
    <!-- 櫻花飄落背景 -->
    <div class="sakura-bg" id="sakura-container"></div>

    <div class="login-card">
        <!-- 登入區塊 -->
        <div id="login-section">
            <div class="header">
                <span class="header-icon">🌸</span>
                <h1>Welcome Back</h1>
                <p>漫步在粉色的櫻花樹下</p>
            </div>

            <!-- 錯誤訊息提示 -->
            <?php if (!empty($login_error)): ?>
                <div class="message">❌ <?php echo htmlspecialchars($login_error); ?></div>
            <?php endif; ?>

            <!-- 註冊成功提示 -->
            <?php if (!empty($register_message) && !$show_register): ?>
                <div class="message" style="color: #4a7c59; background: rgba(187, 248, 208, 0.3); border-left-color: #72b01d;">
                    ✨ <?php echo htmlspecialchars($register_message); ?>
                </div>
            <?php endif; ?>

            <form action="08-login-cookie.php" method="post">
                <input type="hidden" name="action" value="login">
                <div class="form-group">
                    <label for="account">帳號</label>
                    <input type="text" id="account" name="account" placeholder="請輸入帳號" required>
                </div>

                <div class="form-group">
                    <label for="password">密碼</label>
                    <input type="password" id="password" name="password" placeholder="請輸入密碼" required>
                </div>

                <div class="help-links">
                    <a href="#">忘記密碼？</a>
                    <a onclick="toggleForm('register')">註冊新會員 🌸</a>
                </div>

                <button type="submit" class="login-btn">立即登入</button>
            </form>
        </div>

        <!-- 註冊區塊 -->
        <div id="register-section">
            <div class="header">
                <span class="header-icon">✨</span>
                <h1>New Member</h1>
                <p>開啟你的甜蜜日記</p>
            </div>

            <?php if (!empty($register_message) && $show_register): ?>
                <div class="message">⚠️ <?php echo htmlspecialchars($register_message); ?></div>
            <?php endif; ?>

            <form action="08-login-cookie.php" method="post">
                <input type="hidden" name="action" value="register">
                <div class="form-group">
                    <label for="new_account">設定帳號</label>
                    <input type="text" id="new_account" name="new_account" placeholder="請輸入新帳號" required>
                </div>

                <div class="form-group">
                    <label for="new_password">設定密碼</label>
                    <input type="password" id="new_password" name="new_password" placeholder="請設定密碼" required>
                </div>

                <div class="help-links">
                    <a onclick="toggleForm('login')">⬅ 返回登入</a>
                </div>

                <button type="submit" class="login-btn" style="background: linear-gradient(135deg, #fb6f92, #ff4d6d);">完成註冊</button>
            </form>
        </div>

        <div class="footer-note">
            安全加密連線中 🌸 保護你的甜蜜資料
        </div>
    </div>

    <script>
        // 切換表單
        function toggleForm(mode) {
            const login = document.getElementById('login-section');
            const register = document.getElementById('register-section');
            if (mode === 'register') {
                login.style.display = 'none';
                register.style.display = 'block';
            } else {
                login.style.display = 'block';
                register.style.display = 'none';
            }
        }

        // 產生櫻花花瓣
        function createPetals() {
            const container = document.getElementById('sakura-container');
            for (let i = 0; i < 15; i++) {
                const petal = document.createElement('div');
                petal.className = 'petal';
                petal.style.width = Math.random() * 10 + 10 + 'px';
                petal.style.height = petal.style.width;
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