from urllib.request import urlopen
from bs4 import BeautifulSoup
from urllib.parse import urljoin
import pymysql

con = pymysql.connect(host="localhost", user="root", passwd="", db="gafdb")
cursor = con.cursor()
soup = BeautifulSoup(urlopen('http://archives.assembleenationale.bf/spip.php?rubrique18').read(), 'lxml')
links = []
clinks = []
title=[]
#filelink=[]
maxi=0
file=open('loisArchives.txt', 'w')
for anchor in soup.findAll('a', {'class':'lien_pagination'}):
    if(int(anchor.text)>maxi):
        maxi = int(anchor.text)

for i in range(0,maxi,10):
    if i==0:
        links.append('http://archives.assembleenationale.bf/spip.php?rubrique18#pagination_articles_ensble')
    else:
        links.append('http://archives.assembleenationale.bf/spip.php?rubrique18&debut_articles_ensble=%s#pagination_articles_ensble'%str(i))
#maxi=0
for link in links:
    soup2 = BeautifulSoup(urlopen(link).read(), 'lxml')
    for anchor in soup2.findAll('a', {'class':'link3'}):
        if(anchor['href'][0:16]=='spip.php?article'):
            if(anchor.text[0:3]=='LOI'):
                clinks.append('http://archives.assembleenationale.bf/%s'%anchor['href'])
                title.append(anchor.text)
clinks.reverse()
title.reverse()
for i in range(len(title)):
    filelink=''
    soup3=BeautifulSoup(urlopen(clinks[i]).read(), 'lxml')
    for anc in soup3.findAll('a', {'target':'_blank'}):
        if(anc['href'][len(anc['href'])-3:]=='pdf'):
            filelink=('archives.assembleenationale.bf/%s'%anc['href'])
            addLoi = ("INSERT INTO loi(title,filelink,link)"
                "VALUES(%s,%s,%s)"
            )
            dataLoi=(title[i].encode('utf-8'), filelink.encode('utf-8'), filelink.encode('utf-8'))
            cursor.execute(addLoi, dataLoi)
            print('done')
#print('sizes : CLINKS-%d TITLES-%d'%(len(clinks),len(title)))
#for link in clinks:
#    soup3 = BeautifulSoup(urlopen(link).read(), 'lxml')
#    for anc in soup3.findAll('a', {'target':'_blank'}):
 #       if(anc['href'][len(anc['href'])-3:]=='pdf'):
 #           filelink.append('archives.assembleenationale.bf/IMG/pdf/%s'%anc['href'])

#print('FILELINKS-%d TITLE-%d'%(len(filelink),len(title)))
#for i in range(len(title)):
#	addLoi = ("INSERT INTO loi(title,filelink,link)"
#        "VALUES(%s,%s,%s)"
#    )
#	dataLoi=(title[i].encode('utf-8'), filelink[i].encode('utf-8'), filelink[i].encode('utf-8'))
#	cursor.execute(addLoi, dataLoi)
#	print('done')
	
con.commit()
cursor.close()
con.close()
