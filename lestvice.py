import requests
import MySQLdb
from bs4 import BeautifulSoup

drzave = ["Spain","England","Italy","Germany","France","Russia","Portugal","Ukraine","Belgium","Turkey","Austria","Netherlands","Greece","Switzerland","Denmark","Croatia","Cyprus","Israel","Poland","Sweden","Serbia","Slovenia","Norway","Scotland"]


baza = MySQLdb.connect(host="localhost",user="root",passwd="rdecastrela6",db="stavnica")
kazalec = baza.cursor()

tabelaEkipa = []
tabelaTocke = []
stevecLige = 0
for i in drzave:
    #kazalec.execute("""DROP TABLE """+i)
    kazalec.execute("""CREATE TABLE """+i + """ (ID INT AUTO_INCREMENT PRIMARY KEY,
                                        Ekipa VARCHAR(255),
                                        Tocke VARCHAR(255))""")
    stran = requests.get("http://www.xscores.com/soccer/tables/"+ drzave[stevecLige])
    vsebina = BeautifulSoup(stran.content, 'html.parser')
    ekipa = vsebina.findAll("div", attrs={"class":"table_cell table_team"})
    tocke = vsebina.findAll("div", attrs={"class" : "table_cell table_games table_pts"})
    stevecLige+=1
    tabelaEkipa = []
    for besedilo in ekipa:
        tekst = besedilo.text
        if (tekst == "TEAM"):
            pass
        else:
            tekst = tekst.replace("\t", "").replace("\r", "").replace("\n", "")
            tabelaEkipa.append(tekst)

    tabelaTocke = []
    for besedilo in tocke:
        tekst = besedilo.text
        if (tekst == "PtsPoints"):
            pass
        else:
            tekst = tekst.replace("\t", "").replace("\r", "").replace("\n", "")
            tabelaTocke.append(tekst)

    for stevec in range(0,len(tabelaTocke)):
        kazalec.execute("""INSERT INTO """+ i + """(Ekipa,Tocke) VALUES (%s,%s)""",(tabelaEkipa[stevec],tabelaTocke[stevec]))

