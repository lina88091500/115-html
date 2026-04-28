<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
</head>

<body>
     <h1>字串取代</h1>
     <p>將”aaddw1123”改成”*********”</p>
     <?php
     $str = "aaddw1123";
     $str = str_replace("a", "*", str_repeat("*", strlen($str)), $str);

     echo $str;
     echo "<br>";
     echo str_repeat("*", strlen($str));
     ?>

     <h1>字串分割</h1>
     <p>將”this,is,a,book”依”,”切割後成為陣列</p>
     <?php
     $str = "this,is,a,book";
     $arr = explode(",", $str);
     echo "<pre>";
     print_r($arr);
     echo "</pre>";
     ?>

     <h1>字串組合</h1>
     <p>將上例陣列重新組合成“this is a book”</p>
     <?php
     $str = "this,is,a,book";
     $arr = explode(",", $str);
     $newStr = implode(" ", $arr);
     echo $newStr;
     ?>

</body>

</html>