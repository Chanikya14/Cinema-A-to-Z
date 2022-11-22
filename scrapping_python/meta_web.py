import requests
from bs4 import BeautifulSoup
headers = {
    'accept-ranges': 'bytes',
'cache-control': 'public, max-age=300',
'content-encoding': 'gzip',
'content-length': '16155',
# 'content-security-policy': 'frame-ancestors 'self';',
'content-type': 'text/html',
 'charset':'UTF-8',
'strict-transport-security': 'max-age=63072000; includeSubDomains; preload',
'vary': 'Accept-Encoding, User-Agent'}
r = requests.get('https://www.metacritic.com/search/all/game-of-thrones/results',headers=headers)
soup = BeautifulSoup(r.content, 'html5lib')
print(soup)