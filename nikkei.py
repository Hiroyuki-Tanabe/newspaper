import requests, json, datetime
from bs4 import BeautifulSoup
import urllib.request as req

url = "https://www.nikkei.com/"

# URLにアクセスするURLを取得する
html = requests.get(url)
soup = BeautifulSoup(html.content, 'html.parser')

# classが"k-card__title-piece"に当てはまるspan要素全てを摘出する
span = soup.find_all("span", class_='k-card__title-piece')

# 見出しを16行だけ抽出
nikkei= []
for s in span[0:16]:
    nikkei.append(s.getText())

for a in nikkei[0:8]:
    print(a)

f = open('nikkei.txt', 'a')
f.truncate(0)
f.close()

for s in nikkei[8:16]:
    f = open('nikkei.txt', 'a')
    f.write('{}<br>'.format(str(s)))
    f.close()
