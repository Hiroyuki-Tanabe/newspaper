import requests
from bs4 import BeautifulSoup

#classがtitle _ellipsisの場合、divを全部集める
r = requests.get('https://newspicks.com/') 
data = BeautifulSoup(r.text, 'html.parser')
elems = data.find_all("div", class_="title _ellipsis")

# テキスト要素を抽出
newspicks= []
for e in elems:
    newspicks.append(e.getText())

for b in newspicks[0:6]:
    print(b)

f = open('newspicks.txt', 'a')
f.truncate(0)
f.close()

for s in newspicks[6:12]:
    f = open('newspicks.txt', 'a')
    f.write('{}<br>'.format(str(s)))
    f.close()
