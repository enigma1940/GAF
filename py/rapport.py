from urllib.request import urlopen
from bs4 import BeautifulSoup
from urllib.parse import urljoin
import pymysql

con = pymysql.connect(host="localhost", user="root", passwd="", db="gafdb")
cursor = con.cursor()
soup = BeautifulSoup(urlopen('http://www.planificationfamiliale-burkinafaso.net/documents-politiques-dinteret-pour-la-planification-familiale.php').read(), 'lxml')
maxi=0
soup.prettify()

for anchor in soup.findAll('a', {'style':None}):
    if(anchor['href'][len(anchor['href'])-3:]=='pdf'):
        #res = cursor.execute("SELECT ID FROM rapport WHERE link=%s"%anchor['href'])
        #if res==0:
        print(anchor['href'].encode('utf-8'))
        addR = ("INSERT INTO rapport(title,filelink,link)"
            "VALUES(%s,%s,%s)"
        )
        dataR=(anchor.text.encode('utf-8'), anchor['href'].encode('utf-8'), anchor['href'].encode('utf-8'))
        cursor.execute(addR, dataR)
        print('ok')
con.commit()
cursor.close()
con.close()

# to filelink in the app we add the followind text at the begining
# www.planificationfamiliale-burkinafaso.net/
