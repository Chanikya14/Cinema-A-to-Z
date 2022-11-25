import requests
from bs4 import BeautifulSoup
def title(link):
    """Searching names of the top 250 movies from the imdb link which ifd found in a span with class SecondaryInfo
    :param link: link that consists of top 250 movies
    :return: NULL
    """
    r = requests.get(link)
    soup = BeautifulSoup(r.content, 'html5lib')
    movies=soup.find_all('tr')
    for i in range(1,251):
        sample1=movies[i].find('span',class_='secondaryInfo')
        title=sample1.get_text().replace('(','').replace(')','')
        break
        # print(title)
title('https://www.imdb.com/chart/top/')