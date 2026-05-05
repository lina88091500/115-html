<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI計算器</title>
    <!-- 引入 Font Awesome 確保圖標顯示 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #6c5ce7;
            --bg-gradient: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            --card-bg: #ffffff;
            --text-color: #2d3436;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg-gradient);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
            color: var(--text-color);
            margin: 0;
        }

        h2 { margin-bottom: 20px; color: #4834d4; }

        .desc-box {
            background: rgba(255, 255, 255, 0.6);
            padding: 15px 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            text-align: center;
        }

        .card {
            background: var(--card-bg);
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }

        .card-content { padding: 30px; text-align: center; }

        .icon-top { font-size: 2.5rem; color: #ff7675; margin-bottom: 15px; }

        .input-group {
            display: flex;
            align-items: center;
            background: #f1f2f6;
            border-radius: 10px;
            padding: 5px 15px;
            margin-bottom: 20px;
        }

        .input-group i { color: #636e72; width: 25px; }

        .input-group input {
            border: none;
            background: transparent;
            padding: 12px 10px;
            width: 100%;
            outline: none;
            font-size: 1rem;
        }

        button {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        button:hover { background: #4834d4; }
    </style>
</head>

<body>
    <h2>BMI 計算</h2>
    <div class="desc-box">
        <ul style="list-style: none; padding: 0; margin: 0;">
            <li>建立一個可以輸入身高和體重的表單畫面</li>
            <li>按下"計算BMI"按鈕後，在另一個頁面顯示BMI值</li>
        </ul>
    </div>

    <!-- GET 表單 -->
    <div class="card">
        <div class="card-content">
            <div class="icon-top"><i class="fa-solid fa-heart-pulse"></i></div>
            <h2 style="color:var(--primary-color)">BMI 計算表單(GET)</h2>
            <form action="bmi_result.php" method="get">
                <div class="input-group">
                    <i class="fa-solid fa-ruler-vertical"></i>
                    <!-- 修正：加入 name="height" -->
                    <input type="number" name="height" placeholder="請輸入身高 (cm)" required>
                </div>
                <div class="input-group">
                    <i class="fa-solid fa-weight-scale"></i>
                    <!-- 修正：加入 name="weight" -->
                    <input type="number" name="weight" placeholder="請輸入體重 (kg)" required>
                </div>
                <button type="submit"><i class="fa-solid fa-calculator"></i> 送出計算</button>
            </form>
        </div>
    </div>

    <!-- POST 表單 -->
    <div class="card">
        <div class="card-content">
            <div class="icon-top"><i class="fa-solid fa-heart-pulse"></i></div>
            <h2 style="color:var(--primary-color)">BMI 計算表單(POST)</h2>
            <form action="bmi_result.php" method="post">
                <div class="input-group">
                    <i class="fa-solid fa-ruler-vertical"></i>
                    <!-- 修正：加入 name="height" -->
                    <input type="number" name="height" placeholder="請輸入身高 (cm)" required>
                </div>
                <div class="input-group">
                    <i class="fa-solid fa-weight-scale"></i>
                    <!-- 修正：加入 name="weight" -->
                    <input type="number" name="weight" placeholder="請輸入體重 (kg)" required>
                </div>
                <button type="submit"><i class="fa-solid fa-calculator"></i> 送出計算</button>
            </form>
        </div>
    </div>
</body>

</html>