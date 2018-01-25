from urllib.request import urlopen
from bs4 import BeautifulSoup
from urllib.parse import urljoin
import pymysql

con = pymysql.connect(host="localhost", user="root", passwd="", db="gafdb")
cursor = con.cursor()
soup = BeautifulSoup(urlopen('https://assembleenationale.bf/Lois-adoptees#pagination_article_ensble').read(), 'lxml')
links = []
clinks = []
maxi=0
soup.prettify()
file=open('loi.txt', 'w')
for anchor in soup.findAll('a', {'class':'lien_pagination'}):
    if(int(anchor.text)>maxi):
        maxi = int(anchor.text)

for i in range(0,maxi,10):
    if i==0:
        links.append('https://assembleenationale.bf/Lois-adoptees#pagination_article_ensble')
    else:
        links.append(urljoin('https://assembleenationale.bf/Lois-adoptees', '?debut_articles_ensble=%s#pagination_article_ensble'%str(i)))

for link in links:
    soup2 = BeautifulSoup(urlopen(link).read(), 'lxml')
    for anchor in soup2.findAll('a', {'class':'link3'}):
        if(anchor['href'][0:3]=='LOI'):
            clinks.append('https://www.assembleenationale.bf/%s'%anchor['href'])
			#file.write('https://www.assembleenationale.bf/%s\n'%anchor['href'])
clinks.reverse();

for link in clinks:
    res = cursor.execute('SELECT * FROM loi WHERE link="%s"'%link)
    if res==0:
        title=''
        filelink=''
        soup3 = BeautifulSoup(urlopen(link).read(), 'lxml')
        for p in soup3.findAll('p', {'class':'titreD'}):
            title=p.text
        for anc in soup3.findAll('a', {'type':'application/pdf'}):
            filelink = 'https://www.assembleenationale.bf/'+anc['href']
        addLoi = ("INSERT INTO loi(title,filelink,link)"
            "VALUES(%s,%s,%s)"
        )
        dataLoi=(title.encode('utf-8'), filelink.encode('utf-8'), link)
        cursor.execute(addLoi, dataLoi)
        print('ok')
con.commit()
cursor.close()
con.close()
