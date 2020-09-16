<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Camera Test</title>
  <style>
  canvas, video{
    border: 1px solid gray;
  }
  </style>
</head>
<body>

<h1>HTML5カメラ</h1>

<video id="camera" width="300" height="200"></video>
<canvas id="picture" width="300" height="200"></canvas>
<form action="save.php" method="post">
  <button type="button" id="shutter">シャッター</button>
	<input type="hidden" name="canvas_data">
	<input type="submit" onclick="Imgmake();">
</form>

<audio id="se" preload="auto">
  <source src="camera-shutter1.mp3" type="audio/mp3">
</audio>
<!--<button id="download">保存</button>-->
<script>
window.onload = () => {
  const video  = document.querySelector("#camera");
  const canvas = document.querySelector("#picture");
  const se     = document.querySelector('#se');

  /** カメラ設定 */
  const constraints = {
    audio: false,
    video: {
      width: 300,
      height: 200,
      facingMode: "user"   // フロントカメラを利用する
      // facingMode: { exact: "environment" }  // リアカメラを利用する場合
    }
  };

  /**
   * カメラを<video>と同期
   */
  navigator.mediaDevices.getUserMedia(constraints)
  .then( (stream) => {
    video.srcObject = stream;
    video.onloadedmetadata = (e) => {
      video.play();
    };
  })
  .catch( (err) => {
    console.log(err.name + ": " + err.message);
  });

  /**
   * シャッターボタン
   */
   document.querySelector("#shutter").addEventListener("click", () => {
    const ctx = canvas.getContext("2d");

    // 演出的な目的で一度映像を止めてSEを再生する
    video.pause();  // 映像を停止
    se.play();      // シャッター音
    setTimeout( () => {
      video.play();    // 0.5秒後にカメラ再開
    }, 500);

    // canvasに画像を貼り付ける
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
	   
  });
	
};
	
document.getElementById("download").onclick = (event) => {
    canvas = document.getElementById("picture");
    savecanvas = canvas.toDataURL("image/png");
    document.forms[0].canvas_data.value=savecanvas;
	alert("aaa");
}	
</script>
<script>
    function Imgmake(){
    canvas = document.getElementById("picture");
    savecanvas = canvas.toDataURL("image/png");
    document.forms[0].canvas_data.value=savecanvas;
}	
function Count(){
	return count;
}
</script>
    
    
</body>
</html>