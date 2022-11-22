import requests
from bs4 import BeautifulSoup
r = requests.get('https://www.imdb.com/chart/top/')
soup = BeautifulSoup(r.content, 'html5lib')
movies=soup.find_all('tr')

with open('plot.txt', "a") as file:
    for i in range(1,251):
        sample1=movies[i].find('td',class_='titleColumn')
        base=movies[i].find('a')
        sample2=sample1.find('a').get('href')
        extra4='https://www.imdb.com'+sample2+'plotsummary?ref_=tt_ql_sm'
        s3=requests.get(extra4)
        soup4=BeautifulSoup(s3.content,'html5lib')
        plot=soup4.find('li',class_='ipl-zebra-list__item').get_text()
        file.write(plot.strip())
        file.write('\n')