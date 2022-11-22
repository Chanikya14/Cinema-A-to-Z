import requests
from bs4 import BeautifulSoup
r = requests.get('https://www.imdb.com/chart/top/')
soup = BeautifulSoup(r.content, 'html5lib')
movies=soup.find_all('tr')

with open('meta_rate.txt', "a") as file:
    for i in range(220,251):
        sample1=movies[i].find('td',class_='titleColumn')
        base=movies[i].find('a')
        sample2=sample1.find('a').get('href')
        meta='https://www.imdb.com'+sample2+'criticreviews?ref_=tt_ov_rt'
        s2=requests.get(meta)
        soup3=BeautifulSoup(s2.content,'html5lib')
        score=soup3.find('span',itemprop="ratingValue")
        if(score == None):
            file.write("N/A")
        else:
            file.write(score.get_text())
        file.write('\n')