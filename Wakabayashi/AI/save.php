<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Camera Test</title>
</head>
<body>

<h1>写真を送りました</h1>
<p><a href="kamera.php">戻る</a></p>    
<?php
//canvasデータがPOSTで送信されてきた場合
$canvas = $_POST["canvas_data"];
$now = date("Y-m-d-H-i-s") . "." . substr(explode(".", (microtime(true) . ""))[1], 0, 3);

//ヘッダに「data:image/png;base64,」が付いているので、それは外す
$canvas = preg_replace("/data:[^,]+,/i","",$canvas);
 
//残りのデータはbase64エンコードされているので、デコードする
$canvas = base64_decode($canvas);
 
//まだ文字列の状態なので、画像リソース化
$image = imagecreatefromstring($canvas);
 
//画像として保存（ディレクトリは任意）
imagesavealpha($image, TRUE); // 透明色の有効
imagepng($image ,'./'.$now.'.png');
    
$img_name=$now.".png";

//画像認証python実行
exec("python face_detect.py ".$img_name,$output);
echo "$output[0]\n";
//echo $img_name;
//$result = shell_exec('python face_detect.py' . $img_name);
?>

<?php
  if($output[0] == 'no'){
      echo "失敗";
  }  
?>
    
</body>