import requests
from bs4 import BeautifulSoup
def reviews(link):
    """| the function is used to print reviews of all top 100 animes in IMDB genrated by the link.
    | we are finding token which is unique for every anime called as data-tconst
    | we will attach some link parts which is common for every anime and we will go to all topics and then user reviews
    | and scrape the top 3 user reviews of the data
    :param link: link of top 100 anime in IMDB from which we are scrapping user reviews of each
    :type info: string
    """
    r = requests.get(link)
    soup = BeautifulSoup(r.content, 'html5lib')
    movies=soup.find_all('div',class_='lister-item-image ribbonize')
    with open("reviews.txt", "a") as file:
        for i in range(0,100):
            const=movies[i].get('data-tconst')
            sample2='/title/'+const+'/'
            extra='https://www.imdb.com'+sample2+'reviews/?ref_=tt_ql_urv'
            s=requests.get(extra)
            soup1=BeautifulSoup(s.content,'html5lib')
            user=soup1.find_all('a',class_="title")
            cnt=0
            for j in user:
                cnt = cnt+1   
                file.write(j.get_text().strip())
                file.write(' @ ')
                if(cnt==3):
                    break
            file.write('\n')
reviews('https://www.imdb.com/list/ls099530931/')