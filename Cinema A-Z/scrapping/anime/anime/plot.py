import requests
from bs4 import BeautifulSoup
def title(link):
    """| the function is used to print plot of all top 100 animes in IMDB genrated by the link.
    | these are present under a 'p' with class = ''
    :param link: link of top 100 anime in IMDB from which we are scrapping plot of each
    :type info: string
    """
    r = requests.get(link)
    soup = BeautifulSoup(r.content, 'html5lib')
    movies=soup.find_all('p',class_='')
    for i in range(0,len(movies)):
        sample1=movies[i].get_text().strip()
        print(sample1)
        break
title('https://www.imdb.com/list/ls099530931/')