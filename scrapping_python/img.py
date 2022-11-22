import requests
from bs4 import BeautifulSoup
r = requests.get('https://www.imdb.com/chart/top/')
soup = BeautifulSoup(r.content, 'html5lib')
movies=soup.find_all('tr')
with open('images_url.txt', "a") as file:
    for i in range(1,251):
        sample1=movies[i].find('td',class_='titleColumn')
        base=movies[i].find('a')
        sample2=sample1.find('a').get('href')
        image=base.find('img').get('src')
        file.write(image)
        file.write("\n")
