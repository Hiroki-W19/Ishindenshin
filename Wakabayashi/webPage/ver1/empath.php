<?PHP
	$command = 'python empath.py';
	exec($command, $output);
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
	<p><?PHP echo "$output[0]\n"; ?></p>
</body>
</html>