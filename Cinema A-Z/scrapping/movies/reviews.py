import requests
from bs4 import BeautifulSoup
def ratings(link):
    """Searching user reviews for the top 250 imdb movies and extracting the top 3 from web scrapping.
    we will find the token on each film and enter into the alltopics versions and scrape user Reviews.
    :param link: link that consists of top 250 movies
    :return: NULL
    """
    r = requests.get(link)
    soup = BeautifulSoup(r.content, 'html5lib')
    movies=soup.find_all('tr')
    with open("reviews.txt", "a") as file:
        for i in range(1,30):
            sample1=movies[i].find('td',class_='titleColumn')
            base=movies[i].find('a')
            sample2=sample1.find('a').get('href')
            extra='https://www.imdb.com'+sample2+'reviews/?ref_=tt_ql_urv'
            s=requests.get(extra)
            soup1=BeautifulSoup(s.content,'html5lib')
            user=soup1.find_all('a',class_="title")
            break
            # cnt=0
            # for j in user:
            #     cnt = cnt+1   
            #     file.write(j.get_text().strip())
            #     file.write(' @ ')
            #     if(cnt==3):
            #         break
            #     file.write('\n')
ratings('https://www.imdb.com/chart/top/')