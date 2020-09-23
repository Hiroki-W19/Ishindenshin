// ページ読込完了後にボタンにclickイベントを登録する
window.addEventListener("load", function(){
	document.getElementById("wav_send").addEventListener("click", function(){
		// FoemDataオブジェクトに要素セレクタを渡して宣言する
		var formDatas = document.getElementById("wav_form");
		var mixedDatas = new FormData(formDatas);

		// appendメソッドでキーとデータの組をセットする
		// append("キー(FORMで云うところのname属性値)",  "データ")でデータをセットできる
		// appendではデータは追加となる
		mixedDatas.append("filename",  "voice.wav");
		//mixedDatas.append("filesize",  "10,154B");

		// XHRの宣言
		var XHR = new XMLHttpRequest();

		// openメソッドにPOSTを指定して送信先のURLを指定します
		XHR.open("POST", "file_save.php", true);

		// sendメソッドにデータを渡して送信を実行する
		XHR.send(mixedDatas);

		// サーバの応答をonreadystatechangeイベントで検出して正常終了したらデータを取得する
		XHR.onreadystatechange = function(){
			if(XHR.readyState == 4 && XHR.status == 200){
				// POST送信した結果を表示する
				document.getElementById("result").innerHTML = "送信成功";
			}
		};
	} ,false);
}, false);
