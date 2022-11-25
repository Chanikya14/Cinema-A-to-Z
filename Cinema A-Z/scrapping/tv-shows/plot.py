import requests
from bs4 import BeautifulSoup
def title(link):
    """| the function is used to print year of all top 100 in IMDB genrated by the link.
    | these are present under 'h3' with class = 'lister-item-header' in which they are present under 'span'
    | with class = 'lister-item-year text-muted unbold'
    :param link: link of top 100 in IMDB from which we are scrapping rating of each
    :type info: string
    """
    r = requests.get(link)
    soup = BeautifulSoup(r.content, 'html5lib')
    movies=soup.find_all('p',class_='')
    for i in range(0,len(movies)):
        sample1=movies[i].get_text().strip()
        print(sample1)
        print('##########')
title('https://www.imdb.com/list/ls008957859/')
title('https://www.imdb.com/list/ls008957859/?sort=list_order,asc&st_dt=&mode=detail&page=2')
title('https://www.imdb.com/list/ls008957859/?sort=list_order,asc&st_dt=&mode=detail&page=3')