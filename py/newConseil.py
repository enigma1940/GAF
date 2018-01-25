from urllib.request import urlopen
from bs4 import BeautifulSoup
from urllib.parse import urljoin
import pymysql

con = pymysql.connect(host="localhost", user="root", passwd="", db="gafdb")
cursor = con.cursor()
links = []
clinks = []

soup2 = BeautifulSoup(urlopen('http://lefaso.net/spip.php?rubrique64#pagination_articles').read(), 'lxml')
for anchor in soup2.findAll('a', href=True):
    if anchor.text.lower().find('conseil des ministre')>-1:
        clinks.append(urljoin('http://lefaso.net/', anchor['href']))

clinks.reverse()
for link in clinks:
    res = cursor.execute('SELECT * FROM article WHERE url=%s'%link[link.find('article')+len('article'):])
    if res==0:
        soup = BeautifulSoup(urlopen(link).read(), 'lxml')
        title = ''
        date = ''
        content=''
        for t in soup.findAll('h1',{'class':'entry-title'}):
            title=title+t.text
        for d in soup.findAll('abbr', {'class':'published'}):
            date=d['title'][:d['title'].find('T')]
        for p1 in soup.findAll('div',{'class':'article-chapo'}):
            content=content+'<p>'+p1.text+'</p>'

        elt = soup.find('div', {'class':'texte entry-content'}).findAll('p')
        for pel in elt:
            if (pel.text.lower().replace(' ','')[2:]=='deliberations' or pel.text.lower().replace(' ','')[2:]=='deliberation') or (pel.text.lower().replace(' ','')=='deliberation' or pel.text.lower().replace(' ','')=='deliberations'):
                content=content+'<p id="deliberation"><font class="subArticle">'+pel.text+'</font></p>'
            elif (pel.text.lower().replace(' ','')[3:]=='communicationsorales' or pel.text.lower().replace(' ','')[3:]=='communicationorale') or (pel.text.lower().replace(' ','')=='communicationsorales' or pel.text.lower().replace(' ','')=='communicationorale'):
                content=content+'<p id="communication"><font class="subArticle">'+pel.text+'</font></p>'
            elif (pel.text.lower().replace(' ','')[4:]=='nominations' or pel.text.lower().replace(' ','')[4:]=='nomination') or (pel.text.lower().replace(' ','')=='nominations' or pel.text.lower().replace(' ','')=='nomination'):
                    content=content+'<p id="nomination"><font class="subArticle">'+pel.text+'</font></p>'
            else: content=content+'<p>'+pel.text+'</p>'

        addArticle = ("INSERT INTO article(title, content, datea, cat, url)"
            " VALUES(%s, %s, %s, %s, %s)"
        )
        dataArticle = (title.encode('utf-8'), content.encode('utf-8'), date.encode('utf-8'), 'cr-cm', link[link.find('article')+len('article'):])
        cursor.execute(addArticle, dataArticle)
        print('done')
con.commit()
cursor.close()
con.close()
