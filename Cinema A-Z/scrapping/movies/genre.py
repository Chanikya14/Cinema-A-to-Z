import requests
from bs4 import BeautifulSoup
def genre(link):
    """Searching running time for the top 250 imdb movies which are present under an span with class genre
    :param link: link that consists of top 250 movies
    :return: NULL
    """
    r=requests.get(link)
    soup = BeautifulSoup(r.content, 'html5lib')
    movies=soup.find_all('span',class_='genre')
    # for i in range(0,len(movies)):
    #     # print(movies[i].get_text().strip())
genre('https://www.imdb.com/search/title/?groups=top_250&sort=user_rating')
genre('https://www.imdb.com/search/title/?groups=top_250&sort=user_rating,desc&start=51&ref_=adv_nxt')
genre('https://www.imdb.com/search/title/?groups=top_250&sort=user_rating,desc&start=101&ref_=adv_nxt')
genre('https://www.imdb.com/search/title/?groups=top_250&sort=user_rating,desc&start=151&ref_=adv_nxt')
genre('https://www.imdb.com/search/title/?groups=top_250&sort=user_rating,desc&start=201&ref_=adv_nxt')