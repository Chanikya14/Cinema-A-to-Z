import requests
from bs4 import BeautifulSoup
def similar(link):
    """| the function is used to print connections of all top 100 animes in IMDB genrated by the link.
    | we are finding token which is unique for every anime called as data-tconst
    | we will attach some link parts which is common for every anime and we will go to all topics and then connections
    | and scrape the top 3 user reviews of the data
    :param link: link of top 100 anime in IMDB from which we are scrapping similar movies of each
    :type info: string
    """
    r = requests.get(link)
    soup = BeautifulSoup(r.content, 'html5lib')
    movies=soup.find_all('div',class_='lister-item-image ribbonize')
    with open('new_similar.txt', "a") as file:
        for i in range(82,100):
            const=movies[i].get('data-tconst')
            sample2='/title/'+const+'/'
            extra1='https://www.imdb.com'+sample2+'movieconnections?ref_=tt_ql_sm'
            s1=requests.get(extra1)
            soup2=BeautifulSoup(s1.content,'html5lib')
            connections=soup2.find_all('div',class_='soda odd')
            cnt=0
            for j in connections:
                cnt = cnt+1
                k=j.get_text().strip().split("\n")
                file.write(k[0])
                file.write(' , ')
                if(cnt==3):
                    break
            file.write('\n')            
similar('https://www.imdb.com/list/ls099530931/')