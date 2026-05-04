<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>月曆</title>
</head>

<body>
     <h2>月曆</h2>
     <?php
     // 獲取今日日期 Y 是年，m 是月，d 是日
     $today = date("Y-m-d");
     // 計算這個月總共有幾天 t 判斷這個月是 28、30 還是 31 天
     $MonthDays = date("t");
     // 決定月曆第一行前面要空幾格 w 詢問星期幾
     $FirstDayWeek = date("w", strtotime(date("Y-m-01")));
     // 拼湊出這個月的最後一天是哪一天
     $LastDay = date("Y-m-$MonthDays");
     // 計算這個月的最後一天是星期幾
     $LastDayWeek = date('w', strtotime($LastDay));
     // 算「總共要畫幾個格子」
     $TotalDays = $MonthDays + $FirstDayWeek + (6 - $LastDayWeek);
     // 總共要畫幾列（週）
     $TotalWeeks = $TotalDays / 7
     ?>

     <h3>今天是<?= $today; ?></h3>
     <ul>
          <li>這個月的天數一共有<?= $MonthDays; ?></li>
          <li>這個月的第1天是<?= date("Y-m-01"); ?></li>
          <li>這個月的第1天是星期<?= $FirstDayWeek; ?></li>
          <li>這個月的最後1天是<?= $LastDay ?></li>
          <li>這個月的最後1天是星期<?= $LastDayWeek; ?></li>
          <li>這個月曆一共要畫出(含空白)<?= $TotalDays; ?>格子</li>
     </ul>

     <style>
          table {
               border-collapse: collapse;
          }

          table td {
               padding: 5px 10px;
               border: 1px solid #999;
          }
     </style>
     <hr>
     <table>
          <tr>
               <td>日</td>
               <td>一</td>
               <td>二</td>
               <td>三</td>
               <td>四</td>
               <td>五</td>
               <td>六</td>
          </tr>
          <?php
          for ($i = 0; $i < $TotalWeeks; $i++) {
               echo "<tr>";
               for ($j = 0; $j < 7; $j++) {
                    echo "<td>";
                    $DayNumber = ($i * 7 + $j) - ($FirstDayWeek - 1);
                    if ($DayNumber > 0 && $DayNumber <= $MonthDays) {
                         echo $DayNumber;
                    }
                    echo "</td>";
               }
               echo "</tr>";
          }

          ?>
     </table>
     <br><br><br> <!-- 換三行 -->
     <div class="calendar-grid">

          <!-- 結構部分：使用 div 取代 table -->
          <style>
               .calendar-grid {
                    display: grid;
                    /* 重點：定義 7 欄，每欄等寬 */
                    grid-template-columns: repeat(7, 1fr);
                    width: 350px;
                    /* 固定寬度或 100% */
                    border-top: 1px solid #999;
                    border-left: 1px solid #999;
               }

               .calendar-grid div {
                    padding: 10px;
                    border-right: 1px solid #999;
                    border-bottom: 1px solid #999;
                    text-align: center;
               }

               .header {
                    background-color: #eee;
                    font-weight: bold;
               }
          </style>

          <div class="calendar-grid">
               <!-- 星期標題 -->
               <div class="header">日</div>
               <div class="header">一</div>
               <div class="header">二</div>
               <div class="header">三</div>
               <div class="header">四</div>
               <div class="header">五</div>
               <div class="header">六</div>

               <?php
               // 直接用一個迴圈跑完所有的格子即可，不需要巢狀迴圈
               for ($i = 0; $i < $TotalDays; $i++) {
                    $DayNumber = $i - $FirstDayWeek + 1;
                    echo "<div>";
                    if ($DayNumber > 0 && $DayNumber <= $MonthDays) {
                         echo $DayNumber;
                    }
                    echo "</div>";
               }
               ?>
          </div>
     </div>


</body>

</html>