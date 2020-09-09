import requests

url ='https://api.webempath.net/v2/analyzeWav'

apikey = 'sEYnCj27dk2RE_SUF-UDJwqfAbOsphqjDd9nr8XJLvE'
payload = {'apikey': apikey}

wav = "voice.wav"
data = open(wav, 'rb')
file = {'wav': data}

res = requests.post(url, params=payload, files=file)
print(res.json())