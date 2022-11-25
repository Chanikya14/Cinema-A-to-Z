import requests
from bs4 import BeautifulSoup
def similar(link):
    """Searching similar movies for the top 250 imdb movies and extracting the top 3 from web scrapping.
    we will find the token on each film and enter into the alltopics versions and scrape connections.
    :param link: link that consists of top 250 movies
    :return: NULL
    """
    r = requests.get(link)
    soup = BeautifulSoup(r.content, 'html5lib')
    movies=soup.find_all('tr')
    with open('new_similar.txt', "a") as file:
        for i in range(21,80):
            sample1=movies[i].find('td',class_='titleColumn')
            base=movies[i].find('a')
            sample2=sample1.find('a').get('href')
            extra1='https://www.imdb.com'+sample2+'movieconnections?ref_=tt_ql_sm'
            s1=requests.get(extra1)
            soup2=BeautifulSoup(s1.content,'html5lib')
            connections=soup2.find_all('div',class_='soda odd')
            break
            # cnt=0
            # for j in connections:
            #     cnt = cnt+1
            #     k=j.get_text().strip().split("\n")
            #     file.write(k[0])
            #     file.write(' , ')
            #     if(cnt==3):
            #         break
            # file.write('\n')
similar('https://www.imdb.com/chart/top/')