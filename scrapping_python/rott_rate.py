import requests
from bs4 import BeautifulSoup
r = requests.get('https://www.imdb.com/chart/top/')
soup = BeautifulSoup(r.content, 'html5lib')
movies=soup.find_all('tr')
for i in range(1,251):
    sample1=movies[i].find('td',class_='titleColumn')
    title=sample1.find('a').get_text()
    j = sample1.find('span').get_text().replace('(','').replace(')','')

    g = requests.get('https://www.rottentomatoes.com/search?search='+str(title))
    t_soup = BeautifulSoup(g.content, 'html5lib').find('search-page-media-row',attrs={'releaseyear': j})
    if(t_soup==None):
        p_soup =  BeautifulSoup(g.content, 'html5lib').find('search-page-media-row',attrs={'startyear': j})
        if(p_soup==None):
            soup="N/A"
        else:
            soup = p_soup.get('tomatometerscore')
    else:
        soup = t_soup.get('tomatometerscore')

    print(soup)
    with open("new_rotten.txt", "a") as file:
        file.write(str(soup))
        file.write('\n')

