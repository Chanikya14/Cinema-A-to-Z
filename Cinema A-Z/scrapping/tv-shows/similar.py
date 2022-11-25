import requests
from bs4 import BeautifulSoup
def similar(link):
    """| the function is used to print ratings of all tv-shows in IMDB genrated by the link.
    | these are present in an div with class = 'ipl-rating-star small'
    | under this there is a span with class = 'ipl-rating-star__rating' in which the text is the rating of each anime
    :param link: link of tv-shows in IMDB from which we are scrapping ratings of each
    :type info: string
    """
    r = requests.get(link)
    soup = BeautifulSoup(r.content, 'html5lib')
    movies=soup.find_all('div',class_='lister-item-image ribbonize')
    with open('new_similar.txt', "a") as file:
        for i in range(0,100):
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
similar('https://www.imdb.com/list/ls008957859/')
similar('https://www.imdb.com/list/ls008957859/?sort=list_order,asc&st_dt=&mode=detail&page=2')
similar('https://www.imdb.com/list/ls008957859/?sort=list_order,asc&st_dt=&mode=detail&page=3')