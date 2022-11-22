import requests
from bs4 import BeautifulSoup
r = requests.get('https://www.imdb.com/chart/top/')
soup = BeautifulSoup(r.content, 'html5lib')
movies=soup.find_all('tr')

with open('new_similar.txt', "a") as file:
    for i in range(150,200):
        sample1=movies[i].find('td',class_='titleColumn')
        base=movies[i].find('a')
        sample2=sample1.find('a').get('href')
        extra1='https://www.imdb.com'+sample2+'movieconnections?ref_=tt_ql_sm'
        s1=requests.get(extra1)
        soup2=BeautifulSoup(s1.content,'html5lib')
        connections=soup2.find_all('div',class_='soda odd')
        cnt=0
        for j in connections:
            cnt = cnt+1
            k=j.get_text().strip().split("\n")
            file.write(k[0])
            file.write(' , ')
            if(cnt==3):
                break
        file.write('\n')