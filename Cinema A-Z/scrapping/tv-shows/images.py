import requests
from bs4 import BeautifulSoup
def images(link):
    """| the function is used to print image links of all TV-SHOWS in IMDB genrated by the link.
    | these are present under an 'img' with class = 'loadlate'
    :param link: link of tv-shows in IMDB from which we are scrapping image link of each
    :type info: string
    """
    r = requests.get(link)
    soup = BeautifulSoup(r.content, 'html5lib')
    movies=soup.find_all('img',class_='loadlate')
    for i in range(0,100):
        print(movies[i].get('loadlate'))
images('https://www.imdb.com/list/ls008957859/')
images('https://www.imdb.com/list/ls008957859/?sort=list_order,asc&st_dt=&mode=detail&page=2')
images('https://www.imdb.com/list/ls008957859/?sort=list_order,asc&st_dt=&mode=detail&page=3')