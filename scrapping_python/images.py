import requests
from bs4 import BeautifulSoup
r = requests.get('https://www.imdb.com/chart/top/')
soup = BeautifulSoup(r.content, 'html5lib')
movies=soup.find_all('tr')
with open('all_images.txt', "a") as file:
    for i in range(201,251):
        sample1=movies[i].find('td',class_='titleColumn')
        base=movies[i].find('a')
        sample2=sample1.find('a').get('href')
        extra4='https://www.imdb.com'+sample2+'mediaindex?ref_=tt_ov_mi_sm'
        s3=requests.get(extra4)
        soup4=BeautifulSoup(s3.content,'html5lib')
        plot=soup4.find('link',rel='image_src').get('href')
        file.write(plot)
        file.write('\n')