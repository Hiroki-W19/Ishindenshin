<?PHP
	if(!empty($_FILES['voice']['tmp_name']) && is_uploaded_file($_FILES["voice"]["tmp_name"])) {
		$uploaddir = '';	// アップロード先ディレクトリ
		$upload = $uploaddir . basename($_FILES['voice']['name']);	// アップロード済みファイルを参照してファイル名の指定
		if(move_uploaded_file($_FILES['voice']['tmp_name'], "voice.wav")) {
			echo "アップロードされたファイルを保存しました";
		}
		else {
			echo "アップロードされたファイルの保存に失敗しました";
		}
	}
	else {
		echo "ファイルがアップロードされていません";
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
	<h1>...Loading</h1>
</body>
</html>