import requests
from bs4 import BeautifulSoup
def images(link):
    """Searching image for the top 250 imdb movies we will find the token on each film and enter into the alltopics versions and scrape allphotos.
    :param link: link that consists of top 250 movies
    :return: NULL
    """
    r = requests.get(link)
    soup = BeautifulSoup(r.content, 'html5lib')
    movies=soup.find_all('tr')
    for i in range(1,251):
        sample1=movies[i].find('td',class_='titleColumn')
        base=movies[i].find('a')
        sample2=sample1.find('a').get('href')
        extra4='https://www.imdb.com'+sample2+'mediaindex?ref_=tt_ov_mi_sm'
        s3=requests.get(extra4)
        soup4=BeautifulSoup(s3.content,'html5lib')
        plot=soup4.find('link',rel='image_src').get('href')
        break
        # print(plot)
images('https://www.imdb.com/chart/top/')