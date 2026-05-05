<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>BMI 計算結果</title>
     <!-- 引入圖標庫 -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <style>
          :root {
               --primary-color: #6c5ce7;
               --bg-gradient: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
               --card-bg: #ffffff;
               --text-color: #2d3436;
          }

          body {
               font-family: 'Segoe UI', Arial, sans-serif;
               background: var(--bg-gradient);
               min-height: 100vh;
               display: flex;
               justify-content: center;
               align-items: center;
               margin: 0;
               color: var(--text-color);
          }

          .card {
               background: var(--card-bg);
               padding: 40px;
               border-radius: 20px;
               box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
               width: 100%;
               max-width: 400px;
               text-align: center;
          }

          .icon-top {
               font-size: 3rem;
               color: #ff7675;
               margin-bottom: 20px;
          }

          h2 {
               font-size: 1.2rem;
               margin: 15px 0;
               font-weight: 500;
               border-bottom: 1px dashed #dfe6e9;
               padding-bottom: 10px;
          }

          .bmi-value {
               font-size: 2.5rem;
               color: var(--primary-color);
               font-weight: 800;
               margin: 10px 0;
               display: block;
          }

          .result-text {
               font-size: 1.5rem;
               color: #2d3436;
               font-weight: 600;
          }

          .back-btn {
               display: inline-block;
               margin-top: 25px;
               padding: 10px 20px;
               background: var(--primary-color);
               color: white;
               text-decoration: none;
               border-radius: 8px;
               transition: 0.3s;
          }

          .back-btn:hover {
               background: #4834d4;
               transform: scale(1.05);
          }
     </style>
</head>

<body>
     <?php
     // 初始化變數
     $height = 0;
     $weight = 0;
     $bmi = "無法計算";
     $result = "";

     // 取得資料
     if (isset($_GET['height'])) {
          $height = $_GET['height'];
     }
     if (isset($_GET['weight'])) {
          $weight = $_GET['weight'];
     }
     if (isset($_POST['height'])) {
          $height = $_POST['height'];
     }
     if (isset($_POST['weight'])) {
          $weight = $_POST['weight']; // 修正：從 $_POST 取得體重
     }

     // 計算邏輯
     if ($height > 0 && $weight > 0) {
          $h_m = $height / 100;
          $bmi = round($weight / ($h_m * $h_m), 2);

          // 判定邏輯
          if ($bmi >= 27) {
               $result = "肥胖";
          } else if ($bmi >= 24) {
               $result = "過重";
          } else if ($bmi >= 18.5) {
               $result = "正常";
          } else {
               $result = "過輕";
          }
     }
     ?>

     <div class="card">
          <div class="icon-top">
               <i class="fa-solid fa-heart-pulse"></i>
          </div>

          <h2><i class="fa-solid fa-ruler-vertical"></i> 身高：<?= htmlspecialchars($height); ?> cm</h2>
          <h2><i class="fa-solid fa-weight-scale"></i> 體重：<?= htmlspecialchars($weight); ?> kg</h2>

          <div style="margin-top: 30px;">
               <span style="font-size: 1rem; color: #636e72;">計算結果 BMI</span>
               <span class="bmi-value"><?= $bmi; ?></span>
               <span class="result-text"><?= $result; ?></span>
          </div>

          <a href="javascript:history.back()" class="back-btn">
               <i class="fa-solid fa-arrow-left"></i> 回上一頁
          </a>
     </div>
</body>

</html>