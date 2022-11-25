import requests
from bs4 import BeautifulSoup
def name(link):
    """Searching star cast for the top 250 imdb movies we will find the token on each film and enter into the alltopics versions and scrape caste.
    which was present under a with class = titlecoloumn and it's text.
    :param link: link that consists of top 250 movies
    :return: NULL
    """
    r = requests.get(link)
    soup = BeautifulSoup(r.content, 'html5lib')
    movies=soup.find_all('tr')
    file_object = open('plot.txt', 'a')
    for i in range(1,251):
        sample1=movies[i].find('td',class_='titleColumn')
        base=movies[i].find('a')
        sample2=sample1.find('a').get('href')
        caste=sample1.find('a').get('title')
        break
        # print(caste)
name('https://www.imdb.com/chart/top/')