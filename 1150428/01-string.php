<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>字串取代</h2>
    <p>將”aaddw1123”改成”*********”</p>
    <?php 
    $str="aaddw1123adsfsdfasdf";
    $str=str_replace(["a","d","w",1,2,3],"*",$str);
    
    echo $str;
    
    echo "<br>";
    echo str_repeat("*",mb_strlen($str));
    ?>
    <h2>字串分割</h2>
    <p>將”this,is,a,book”依”,”切割後成為陣列</p>
    <?php 
    $str="this,is,a,book";
    $arr=explode(",",$str);
    echo "<pre>";
    print_r($arr);
    echo "</pre>";

    ?>
<h2></h2>
    <h2>字串組合</h2>
    <p>將上例陣列重新組合成“this is a book”</p>
    <?php 
        $str=join(" ", $arr);
        echo $str;
    ?>

<h2>子字串取用</h2>
<p>
    將” The reason why a great man is great is that he resolves to be a great man”只取前十字成為” The reason…”
</p>
<?php 
$str="The reason why a great man is great is that he resolves to be a great man";
$short=mb_substr($str,0,10);

echo $short . "...";
?>
<p>
    將”偉大的人之所以偉大，是因為他決心成為偉大的人。”只取前十字成為” 偉大的人之所以偉大，…”
</p>
<?php 
$str="偉大的人之所以偉大，是因為他決心成為偉大的人。";
$short=mb_substr($str,0,10);

echo $short . "...";
?>
<br>
<?php 
$str="偉大的人之所以偉大，是因為他決心成為偉大的人。";
$short=substr($str,0,10);

echo $short . "...";
?>
<br>
<?php 
$str="偉大的人之所以偉大，是因為他決心成為偉大的人。";
$short=mb_substr($str,10,-5);

echo $short . "...";
?>

<h2>尋找字串與HTML、css整合應用</h2>

<ul>
    <li>給定一個句子，將指定的關鍵字放大</li>
    <li>“學會PHP網頁程式設計，薪水會加倍，工作會好找”</li>
    <li>請將上句中的 “程式設計” 放大字型或變色.</li>
</ul>
<?php 

$str="學會PHP網頁程式設計，薪水會加倍，工作會好找，學程式設計真的是太好玩了";
$keyword="程式設計";
$tmp="<span style='color:blue;font-size:24px;'>$keyword</span>";
if(strpos($str,$keyword)>0){
    $str=str_replace($keyword,$tmp,$str);

}

echo $str;
?>
<br>
<style>
a{
    color:blue;
    text-decoration: none;
}
a:hover{
    text-decoration: underline;
}

</style>
<?php 

$str="學會PHP網頁程式設計，薪水會加倍，工作會好找，學程式設計真的是太好玩了";
$keyword="程式設計";
$tmp="<a href='#' style='color:blue;'>$keyword</a>";
if(strpos($str,$keyword)>0){
    $str=str_replace($keyword,$tmp,$str);

}

echo $str;
?>
<br>
<br>
<style>
a{
    color:blue;
    text-decoration: none;
}
a:hover{
    text-decoration: underline;
}

</style>
<?php 

$str="PHP 是一種廣泛應用於網頁開發的程式語言，具備語法簡單、學習門檻低的優點，特別適合初學者入門。它與資料庫整合能力強，能快速建立動態網站與互動功能。此外，PHP 擁有豐富的開源資源與框架支援，可有效提升開發效率，並降低開發成本，是企業與個人開發網站時常見且實用的選擇。";
echo $str;
echo "<br>";
$keyword=["PHP","網站","企業","初學者","框架"];

$tmp=[];
foreach($keyword as $k){
    $tmp[]="<a href='#' style='color:blue;'>$k</a>";
}
//print_r($tmp);
$str=str_replace($keyword,$tmp,$str);


echo $str;
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>