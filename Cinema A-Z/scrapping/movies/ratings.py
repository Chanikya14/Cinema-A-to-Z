import requests
from bs4 import BeautifulSoup
def ratings(link):
    """Searching running time for the top 250 imdb movies which are present under an td with class ratingColumn imdbRating
    :param link: link that consists of top 250 movies
    :return: NULL
    """
    r = requests.get(link)
    soup = BeautifulSoup(r.content, 'html5lib')
    movies=soup.find_all('tr')
    for i in range(1,251):
        sample1=movies[i].find('td',class_='ratingColumn imdbRating')
        rating=movies[i].find('strong').get_text().strip()
        # print(rating)
        break
ratings('https://www.imdb.com/chart/top/')