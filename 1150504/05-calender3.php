<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>和風之月 - 夢幻萬年曆</title>
    <script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Serif+TC:wght@400;700&display=swap');

        :root {
            --bg: #fffbf0; /* 和風米白 */
            --sakura: #f78fb3;
            --dark-pink: #ad5371;
            --text: #4a373e;
            --glass: rgba(255, 255, 255, 0.8);
        }

        /* 1. 櫻花滑鼠鼠標 */
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Noto Serif TC', serif;
            background: linear-gradient(135deg, #fff5f8 0%, #fce6f4 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            color: var(--text);
            cursor: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="%23f78fb3" d="M12,2c0,0-2,4-6,4s-4-2-4-2s0,6,4,10s8,8,8,8s4-4,8-8s4-10,4-10s-2,2-4,2S12,2,12,2z"/></svg>'), auto;
        }

        /* 2. 背景裝飾物 */
        .sakura-bg {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none; z-index: 0;
        }

        .petal {
            position: absolute;
            background: #fff;
            border-radius: 150% 0 150% 0;
            opacity: 0.4;
            animation: drift 10s infinite linear;
        }

        @keyframes drift {
            0% { transform: translateY(-10%) rotate(0deg) translateX(0); opacity: 0; }
            50% { opacity: 0.6; }
            100% { transform: translateY(110%) rotate(360deg) translateX(100px); opacity: 0; }
        }

        /* 3. 月曆容器主體 */
        .calendar-card {
            position: relative;
            z-index: 1;
            width: min(550px, 95%);
            background: var(--glass);
            backdrop-filter: blur(20px);
            border: 2px solid #fff;
            border-radius: 24px;
            padding: 50px 40px;
            box-shadow: 0 25px 50px rgba(173, 83, 113, 0.15);
            background-image: radial-gradient(circle at 10% 10%, rgba(247, 143, 179, 0.05) 0%, transparent 50%);
        }

        /* 隱藏原始資訊 */
        ul, hr, h2:first-of-type { display: none; }

        .header-section {
            text-align: center;
            position: relative;
        }

        /* 像印章一樣的年份標記 */
        .year-stamp {
            position: absolute;
            top: -10px; right: 0;
            width: 50px; height: 50px;
            border: 2px solid var(--sakura);
            color: var(--sakura);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
            transform: rotate(15deg);
        }

        .month-title {
            font-size: 4rem;
            margin: 0;
            font-weight: 900;
            color: var(--dark-pink);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .month-title span { font-size: 1.5rem; margin-top: 20px; }

        /* 切換按鈕 */
        .nav-btn-group {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin: 25px 0;
        }

        .nav-link {
            text-decoration: none;
            color: var(--dark-pink);
            font-weight: bold;
            font-size: 0.9rem;
            padding: 5px 15px;
            border-bottom: 2px solid transparent;
            transition: 0.3s;
        }

        .nav-link:hover {
            border-bottom: 2px solid var(--sakura);
            letter-spacing: 2px;
        }

        /* 表格樣式 */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 5px;
        }

        .week-header td {
            font-size: 0.8rem;
            color: var(--sakura);
            padding: 10px 0;
            font-weight: bold;
        }

        table td {
            width: 50px; height: 50px;
            text-align: center;
            border-radius: 12px;
            font-size: 1.1rem;
            transition: all 0.3s;
        }

        /* 懸浮效果：像花瓣一樣彈跳 */
        table td:not(:empty):hover {
            background: var(--sakura);
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(247, 143, 179, 0.4);
        }

        /* 今日標記 */
        .today-circle {
            background: rgba(247, 143, 179, 0.15);
            color: var(--dark-pink);
            font-weight: bold;
            border: 1px dashed var(--sakura);
        }

        .footer-info {
            text-align: center;
            margin-top: 30px;
            font-size: 0.8rem;
            color: var(--dark-pink);
            opacity: 0.6;
        }
    </style>
</head>
<body>

    <div class="sakura-bg" id="sakura-container"></div>

    <div class="calendar-card">
        <?php
        // --- PHP 邏輯 (修正後版本) ---
        $today=date("Y-m-d");
        if(isset($_GET['month'])){ $month=$_GET['month']; }else{ $month=date("Y-m"); }
        $FirstDay=$month."-01";
        $time=strtotime($FirstDay);
        $m=(int)date("m",$time);
        $y=date("Y",$time);
        $FirstDayWeek=date("w",$time);
        $MonthDays=date("t",$time);
        $LastDay=$month."-".$MonthDays;
        $LastDayWeek=date('w',strtotime($LastDay));
        $TotalDays=$MonthDays+$FirstDayWeek+(6-$LastDayWeek);
        $TotalWeeks=$TotalDays/7;
        ?>

        <div class="header-section">
            <div class="year-stamp"><?= $y ?>年</div>
            <h1 class="month-title"><?= $m ?><span>月</span></h1>
            <div style="font-size: 12px; letter-spacing: 4px; opacity: 0.5;">日曆・CALENDAR</div>
        </div>

        <div class="nav-btn-group">
            <?php 
            $prevM = ($m-1 > 0) ? $y."-".sprintf("%02d",$m-1) : ($y-1)."-12";
            $nextM = ($m+1 <= 12) ? $y."-".sprintf("%02d",$m+1) : ($y+1)."-01";
            ?>
            <a href="?month=<?= $prevM ?>" class="nav-link">上個月</a>
            <a href="?month=<?= $nextM ?>" class="nav-link">下個月</a>
        </div>

        <table>
            <tr class="week-header">
                <td>日</td><td>一</td><td>二</td><td>三</td><td>四</td><td>五</td><td>六</td>
            </tr>
            <?php 
            for($i=0;$i<$TotalWeeks;$i++){
                echo "<tr>";
                for($j=0;$j<7;$j++){
                    $DayNumber=($i*7+$j)-($FirstDayWeek-1);
                    $fullDate = $month."-".sprintf("%02d",$DayNumber);
                    $todayClass = ($fullDate == $today) ? "today-circle" : "";
                    
                    echo "<td class='$todayClass'>";
                    if($DayNumber>0 && $DayNumber<=$MonthDays){
                        echo $DayNumber;
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }
            ?>
        </table>

        <div class="footer-info">
            今日：<?= $today ?> ｜ 曆書記載良辰
        </div>
    </div>

    <!-- 產生飄動花瓣 -->
    <script>
        const container = document.getElementById('sakura-container');
        for (let i = 0; i < 20; i++) {
            let p = document.createElement('div');
            p.className = 'petal';
            p.style.left = Math.random() * 100 + 'vw';
            let size = Math.random() * 10 + 8 + 'px';
            p.style.width = size; p.style.height = size;
            p.style.animationDelay = Math.random() * 10 + 's';
            p.style.animationDuration = (Math.random() * 5 + 7) + 's';
            container.appendChild(p);
        }
    </script>

</body>
</html>