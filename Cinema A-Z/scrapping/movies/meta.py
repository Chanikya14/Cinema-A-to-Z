import requests
from bs4 import BeautifulSoup
def metascore(link):
    """Searching metacritic score for the top 250 imdb movies and extracting it from the  from web scrapping.
    we will find the token on each film and enter into the alltopics versions and scrape metascore.
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
        meta='https://www.imdb.com'+sample2+'criticreviews?ref_=tt_ov_rt'
        s2=requests.get(meta)
        soup3=BeautifulSoup(s2.content,'html5lib')
        score=soup3.find('span',itemprop="ratingValue")
        break
        # if(score == None):
        #     print("N/A")
        # else:
        #     print(score.get_text())
metascore('https://www.imdb.com/chart/top/')