import requests
from bs4 import BeautifulSoup
def title(link):
    """| the function is used to print caste of all top 100 animes in IMDB genrated by the link.
    | these are under 'p' with class = 'text-muted text-small' from which we we can get all 'a' which contains the cast
    :param link: link of top 100 anime in IMDB from which we are scrapping cast of each
    :type info: string
    """
    r = requests.get(link)
    soup = BeautifulSoup(r.content, 'html5lib')
    movies=soup.find_all('p',class_='text-muted text-small')
    for i in range(0,len(movies)):
        sample1=movies[i].find_all('a')
        if(len(sample1)>0):
            for j in sample1:
                print(j.get_text().strip(),end=', ')
            print('\n')
title('https://www.imdb.com/list/ls099530931/')
