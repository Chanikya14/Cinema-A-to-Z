import requests
from bs4 import BeautifulSoup
def title(link):
    """| the function is used to print year of all top 100 animes in IMDB genrated by the link.
    | these are present under 'h3' with class = 'lister-item-header' in which they are present under 'span'
    | with class = 'lister-item-year text-muted unbold'
    :param link: link of top 100 anime in IMDB from which we are scrapping rating of each
    :type info: string
    """
    r = requests.get(link)
    soup = BeautifulSoup(r.content, 'html5lib')
    movies=soup.find_all('h3',class_='lister-item-header')
    for i in range(0,len(movies)):
        sample1=movies[i].find('span',class_='lister-item-year text-muted unbold')
        year=sample1.get_text()
        print(year)
title('https://www.imdb.com/list/ls099530931/')