import requests
from bs4 import BeautifulSoup
def title(link):
    """| the function is used to print time of all tv-shows in IMDB genrated by the link.
    | these are present under an span with class = 'runtime'
    :param link: link of tv-shows in IMDB from which we are scrapping time of each
    :type info: string
    """
    r = requests.get(link)
    soup = BeautifulSoup(r.content, 'html5lib')
    movies=soup.find_all('span',class_='runtime')
    for i in range(0,len(movies)):
        sample1=movies[i].get_text().strip()
        print(sample1)
title('https://www.imdb.com/list/ls008957859/')
title('https://www.imdb.com/list/ls008957859/?sort=list_order,asc&st_dt=&mode=detail&page=2')
title('https://www.imdb.com/list/ls008957859/?sort=list_order,asc&st_dt=&mode=detail&page=3')