from pydub import AudioSegment
import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns

# JupitorNoteBookで扱うための奴
#% matplotlib inline

# 音声ファイルの読み込み
sound = AudioSegment.from_file("voice.wav", "wav")

# チャンネル数
sound.channels

# サンプルレート(Hz)
sound.frame_rate

# 再生時間(秒)
sound.duration_seconds

# 生データをリストで受け取る
samples = np.array(sound.get_array_of_samples())
# ステレオ音声から片側の音だけを抽出
sample = samples[::sound.channels]

# プロットする
plt.plot(sample[::10])

# プロットした音声をグラフとして表示
#plt.show()


##########
# numpyでフーリエ変換を実施
spec = np.fft.fft(sample)	# スペクトルの値(複素数)が入っている

# 値の確認
#spec
# 実数部分を取り出し
#spec.real
# 虚数部分を取り出し
#spec.imag
# 絶対値を取り出し
#np.abs(spec)
# 偏角を取り出し
#np.angle(spec)
# 絶対値と偏角から複素数を復元
#np.exp(1j * np.angle(spec)) * np.abs(spec)
# 逆変換
#np.fft.ifft(spec)

# 周波数
#np.fft.fftfreq(sample.shape[0], 1.0 / sound.frame_rate)

# スペクトルをプロット表示
freq = np.fft.fftfreq(sample.shape[0], 1.0 / sound.frame_rate)
plt.plot(freq, np.abs(spec))

# スペクトルをプロットした物をグラフとして表示
#plt.show()

##########
# 対数メモリで
freq = freq[:int(freq.shape[0] / 2)]
spec = spec[:int(spec.shape[0] / 2)]
spec[0] = spec[0] / 2

#plt.xscale("log")
#plt.yscale("log")
plt.plot(freq, np.abs(spec))

# グラフとして表示
#plt.show()


##########
### スペクトログラムを作成
w = 1000	# 窓幅
s = 500		# 刻み

# スペクトル格納用
ampList = []
# 偏角格納用
argList = []

# 刻みずつずらしながら窓幅分のデータをフーリエ変換する
for i in range(int((sample.shape[0] - w) / s)):
	data = sample[i * s: i * s + w]
	spec = np.fft.fft(data)
	spec = spec[:int(spec.shape[0] / 2)]
	spec[0] = spec[0] / 2
	ampList.append(np.abs(spec))
	argList.append(np.angle(spec))

# 周波数は共通なので1回だけ計算(縦軸表示に使う)
freq = np.fft.fftfreq(data.shape[0], 1.0 / sound.frame_rate)
freq = freq[:int(freq.shape[0] / 2)]

# 時間も共通なので1回だけ計算(横軸表示に使う)
time = np.arange(0, i + 1, 1) * s / sound.frame_rate

# numpyの配列にしておく
ampList = np.array(ampList)
argList = np.array(argList)

### matplotlibとseabornでスペクトログラムを可視化
df_amp = pd.DataFrame(data=ampList, index=time, columns=freq)

# seabornのheadmapを使う
ply.figure(figsize = (20, 6))
sns.heatmap(data=np.log(df_amp.iloc[:, :100].T)), xticklabels = 100, yticklabels = 10, cmap = plt.cm.gist_rainbow_r)

