import requests
from bs4 import BeautifulSoup
def title(link):
    """| the function is used to print title of all tv-shows in IMDB genrated by the link.
    | these are present under 'h3' with class = 'lister-item-header' in which they are present under 'a' as text
    :param link: link of tv-shows in IMDB from which we are scrapping title of each
    :type info: string
    """
    r = requests.get(link)
    soup = BeautifulSoup(r.content, 'html5lib')
    movies=soup.find_all('h3',class_='lister-item-header')
    for i in range(0,len(movies)):
        sample1=movies[i].find('a')
        title=sample1.get_text()
        print(title)
title('https://www.imdb.com/list/ls008957859/')
title('https://www.imdb.com/list/ls008957859/?sort=list_order,asc&st_dt=&mode=detail&page=2')
title('https://www.imdb.com/list/ls008957859/?sort=list_order,asc&st_dt=&mode=detail&page=3')