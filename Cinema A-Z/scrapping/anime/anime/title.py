import requests
from bs4 import BeautifulSoup
def title(link):
    """| the function is used to print title of all top 100 animes in IMDB genrated by the link.
    | these are present under 'h3' with class = 'lister-item-header' in which they are present under 'a' as text
    :param link: link of top 100 anime in IMDB from which we are scrapping title of each
    :type info: string
    """
    r = requests.get(link)
    soup = BeautifulSoup(r.content, 'html5lib')
    movies=soup.find_all('h3',class_='lister-item-header')
    for i in range(0,len(movies)):
        sample1=movies[i].find('a')
        title=sample1.get_text()
        print(title)
title('https://www.imdb.com/list/ls099530931/')