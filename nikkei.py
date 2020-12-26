import requests, json, datetime
from bs4 import BeautifulSoup
import urllib.request as req

url = "https://www.nikkei.com/"

# URLにアクセスするURLを取得する
html = requests.get(url)
soup = BeautifulSoup(html.content, 'html.parser')

# classが"k-card__title-piece"に当てはまるspan要素全てを摘出する
span = soup.find_all("span", class_='k-card__title-piece')

# 見出しを14行だけ抽出
nikkei= []
for s in span[0:16]:
    nikkei.append(s.getText())

for a in nikkei[0:8]:
    print(a)


# 残りをnikkei2.txtに書き込み
# nikkei= []
# for s in span[8:16]:
#     f = open('nikkei2.txt', 'w')
#     f.write(str(s))
#     f.close()

for s in nikkei:
        f = open('nikkei2.txt', 'a')
        f.write(str(s))
        f.close()