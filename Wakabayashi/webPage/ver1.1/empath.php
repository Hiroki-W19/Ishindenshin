<?PHP
	// 感情表現の配列
	$emotion = ["エラー", "平常　", "怒り　", "楽しい", "悲しみ", "元気　"];

	$command = 'python empath.py';
	// Pythonの実行
	// 例:{'error': 0, 'calm': 22, 'anger': 7, 'joy': 10, 'sorrow': 9, 'energy': 8}
	exec($command, $output);
	
	// PHPで表示しやすい形に整形
	$output = str_replace('{', "", $output[0]);
	$output = str_replace('}', "", $output);	// {}の削除
	$outputArray0 = explode(",", $output);	// カンマで区切る
	$i = 0;
	foreach($outputArray0 as $op) {
		$outputArray1[$i] = explode(":", $outputArray0[$i]);	// コロンで区切る
		$i++;
	}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>結果表示</title>
	<link rel="stylesheet" href="CSS/CSS.css" type="text/css">
</head>
<body>
	<h1>結果表示</h1>
	<p>
		<?PHP echo $emotion[0] . ": " . $outputArray1[0][1]; ?><br>
		<?PHP echo $emotion[1] . ": " . $outputArray1[1][1]; ?><br>
		<?PHP echo $emotion[2] . ": " . $outputArray1[2][1]; ?><br>
		<?PHP echo $emotion[3] . ": " . $outputArray1[3][1]; ?><br>
		<?PHP echo $emotion[4] . ": " . $outputArray1[4][1]; ?><br>
		<?PHP echo $emotion[5] . ": " . $outputArray1[5][1]; ?>
	</p>
</body>
</html>