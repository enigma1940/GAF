
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
    res = cursor.execute('SELECT * FROM conseil WHERE url=%s'%link[link.find('article')+len('article'):])
    if res==0:
        soup = BeautifulSoup(urlopen(link).read(), 'lxml')

        communication=''
        nomination=''
        deliberation=''
        content=''
        date=''
        title=''
        tmp=0

        for t in soup.findAll('h1',{'class':'entry-title'}):
            title=title+t.text
        for d in soup.findAll('abbr', {'class':'published'}):
            date=d['title'][:d['title'].find('T')]
        for p1 in soup.findAll('div',{'class':'article-chapo'}):
            content=content+'<p>'+p1.text+'</p>'

        elt = soup.find('div', {'class':'texte entry-content'}).findAll('p')
        for pel in elt:
            if (pel.text.lower().replace(' ','')[2:]=='deliberations' or pel.text.lower().replace(' ','')[2:]=='deliberation') or (pel.text.lower().replace(' ','')=='deliberation' or pel.text.lower().replace(' ','')=='deliberations'):
                deliberation=deliberation+'<p id="deliberation"><font class="subArticle" data="dtext">'+pel.text+'</font></p><div class="dtext col m12">'
                tmp=1
            elif (pel.text.lower().replace(' ','')[3:]=='communicationsorales' or pel.text.lower().replace(' ','')[3:]=='communicationorale') or (pel.text.lower().replace(' ','')=='communicationsorales' or pel.text.lower().replace(' ','')=='communicationorale'):
                communication=communication+'<p id="communication"><font class="subArticle" data="dtext">'+pel.text+'</font></p><div class="dtext col m12">'
                tmp=3
            elif (pel.text.lower().replace(' ','')[4:]=='nominations' or pel.text.lower().replace(' ','')[4:]=='nomination') or (pel.text.lower().replace(' ','')=='nominations' or pel.text.lower().replace(' ','')=='nomination'):
                nomination=nomination+'<p id="nomination"><font class="subArticle" data="dtext">'+pel.text+'</font></p><div class="dtext col m12">'
                tmp=2
            else:
                if tmp==0:
                    content=content+'<p>'+pel.text+'</p>'
                elif tmp==1:
                    deliberation = deliberation+'<p>'+pel.text+'</p>'
                elif tmp==2:
                    nomination = nomination+'<p>'+pel.text+'</p>'
                elif tmp==3:
                    communication = communication+'<p>'+pel.text+'</p>'

        if deliberation!='':
            deliberation = deliberation+'</div>'
        if communication!='':
            communication = communication+'</div>'
        if nomination!='':
            nomination = nomination+'</div>'

        addConseil = ("INSERT INTO conseil(content, datea, title, url, deliberation, nomination, communication)"
            " VALUES(%s, %s, %s, %s, %s, %s, %s)"
        )
        dataConseil = (content.encode('utf-8'), date.encode('utf-8'), title.encode('utf-8'), link[link.find('article')+len('article'):], deliberation.encode('utf-8'), nomination.encode('utf-8'), communication.encode('utf-8'))
        cursor.execute(addConseil, dataConseil)
        print('done')
con.commit()
cursor.close()
con.close()
