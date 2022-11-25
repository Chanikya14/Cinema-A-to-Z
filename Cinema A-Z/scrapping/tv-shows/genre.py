import requests
from bs4 import BeautifulSoup
def title(link):
    """| the function is used to print genre of all TV-SHOWS in IMDB genrated by the link.
    | these are present under a 'span' with class = 'genre'
    :param link: link of TV-SHOWS  in IMDB from which we are scrapping genre of each
    :type info: string
    """
    r = requests.get(link)
    soup = BeautifulSoup(r.content, 'html5lib')
    movies=soup.find_all('span',class_='genre')
    for i in range(0,len(movies)):
        sample1=movies[i].get_text().strip()
        print(sample1)
title('https://www.imdb.com/list/ls008957859/')
title('https://www.imdb.com/list/ls008957859/?sort=list_order,asc&st_dt=&mode=detail&page=2')
title('https://www.imdb.com/list/ls008957859/?sort=list_order,asc&st_dt=&mode=detail&page=3')