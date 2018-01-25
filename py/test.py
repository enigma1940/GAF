from urllib.request import urlopen
from bs4 import BeautifulSoup
from urllib.parse import urljoin
from os import system

soup = BeautifulSoup(urlopen('http://lefaso.net/spip.php?rubrique64#pagination_articles').read(), 'lxml')
links = []
clinks = []
maxi=0
soup.prettify()
for anchor in soup.findAll('a', {'class':'lien_pagination'}):
    if(int(anchor.text)>maxi):
        maxi=int(anchor.text)
for i in range(0,maxi+1,20):
    if i==0:
        links.append('http://lefaso.net/spip.php?rubrique64#pagination_articles')
    else:
        links.append(urljoin('http://lefaso.net/spip.php', '?rubrique64&debut_articles=%s#pagination_articles'%str(i)))

for link in links:
    soup2 = BeautifulSoup(urlopen(link).read(), 'lxml')
    for anchor in soup2.findAll('a', href=True):
        if anchor.text.lower().find('conseil des ministre')>-1:
            clinks.append(urljoin('http://lefaso.net/', anchor['href']))
for link in clinks:
    soup = BeautifulSoup(urlopen(link).read(), 'lxml')
    title = ''
    date = ''
    content=''
    for t in soup.findAll('h1',{'class':'entry-title'}):
        title=title+t.text
    for d in soup.findAll('abbr', {'class':'published'}):
        date=d['title'][:d['title'].find('T')]
    for p1 in soup.findAll('div',{'class':'article-chapo'}):
        for p0 in p1.findAlll('p', {'class':None}):
            content=content+p1.text()
        content=content+'\n'
    for p2 in soup.findAll('div', {'class':'texte entry-content'}):
        content=content+p2.text
    system('php ../php/manager.py.php '+str(title.encode('utf-8'))+' '+str(content.encode('utf-8'))+' '+str(date.encode('utf-8'))+' cr-cm '+str(link[link.find('article')+len('article'):]))
    print('line ok')
