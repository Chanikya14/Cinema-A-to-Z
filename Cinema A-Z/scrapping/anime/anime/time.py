import requests
from bs4 import BeautifulSoup
def title(link):
    """| the function is used to print time of all top 100 animes in IMDB genrated by the link.
    | these are present under an span with class = 'runtime'
    :param link: link of top 100 anime in IMDB from which we are scrapping time of each
    :type info: string
    """
    r = requests.get(link)
    soup = BeautifulSoup(r.content, 'html5lib')
    movies=soup.find_all('span',class_='runtime')
    for i in range(0,len(movies)):
        sample1=movies[i].get_text().strip()
        print(sample1)
title('https://www.imdb.com/list/ls099530931/')