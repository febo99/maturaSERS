import requests
import MySQLdb
from bs4 import BeautifulSoup
import time

baza = MySQLdb.connect(host="localhost",user="root",passwd="rdecastrela6",db="stavnica")
kazalec = baza.cursor()
drzave = ["Spain","England","Italy","Germany","France","Russia","Portugal","Ukraine","Belgium","Turkey","Austria","Netherlands","Greece","Switzerland","Denmark","Croatia","Cyprus","Israel","Poland","Sweden","Serbia","Slovenia","Norway","Scotland"]
datum = time.strftime("%d-%m")

tabelaD = []
tabelaG = []
tabelaRD = []
tabelaRG = []
tabelaDrzava = []
tabelaStatus = []
tabelaLiga = []
stran = requests.get("http://www.xscores.com/soccer/livescores/" + datum)
vsebina = BeautifulSoup(stran.content,'html.parser')
liga = vsebina.findAll("a", attrs= {'class': "league"})
domacaEkipa = vsebina.findAll("div", attrs= {'class':"score_home_txt score_cell wrap"})
gostujocaEkipa = vsebina.findAll("div", attrs= {'class':"score_away_txt score_cell wrap"})
rezultatD = vsebina.findAll("div", attrs= {'class' : 'scoreh_ft score_cell centerTXT'})
rezultatG = vsebina.findAll("div", attrs= {'class' : 'scorea_ft score_cell centerTXT'})
drzava = vsebina.findAll("span", attrs= {'class' : "tooltip_flag"})
statusTekme = vsebina.findAll("div",{ 'data-game-status' : True} )
kazalec.execute("""DROP TABLE tekme""")
kazalec.execute("""CREATE TABLE tekme(ID INT AUTO_INCREMENT PRIMARY KEY,
                                      Drzava VARCHAR(255),
                                      Domaci VARCHAR(255),
                                      Gosti VARCHAR(255),
                                      goliDomaci INT,
                                      goliGosti INT,
                                      Liga VARCHAR(255),
                                      Status VARCHAR(255))"""
                    )
for ekipa in domacaEkipa:
    tekst = ekipa.text
    tekst = tekst.replace("\t","").replace("\r","").replace("\n","")
    tabelaD.append(tekst)
for ekipa in gostujocaEkipa:
    tekst = ekipa.text
    tekst = tekst.replace("\t", "").replace("\r", "").replace("\n", "")
    tabelaG.append(tekst)

for stevilke in rezultatD:
    tekst = stevilke.text
    tekst = tekst.replace("\t", "").replace("\r", "").replace("\n", "")
    tekst = tekst.replace(" ","0")
    tabelaRD.append(tekst)

for stevilke in rezultatG:
    tekst = stevilke.text
    tekst = tekst.replace("\t", "").replace("\r", "").replace("\n", "")
    tekst = tekst.replace(" ","0")
    tabelaRG.append(tekst)

for besedilo in drzava:
    tekst = besedilo.text
    tekst = tekst.replace("\t", "").replace("\r", "").replace("\n", "").replace("SHOW GAMES FROM","")
    tabelaDrzava.append(tekst)

for besedilo in statusTekme:
    tekst = besedilo['data-game-status']
    tekst = tekst.replace("\t", "").replace("\r", "").replace("\n", "")
    tabelaStatus.append(tekst)

for besedilo in liga:
    tekst = besedilo.text
    tekst = tekst.replace("\t", "").replace("\r", "").replace("\n", "").replace(" ", "")
    tabelaLiga.append(tekst)



for stevec in range(0, len(tabelaDrzava)): 
    kazalec.execute('''INSERT INTO tekme(Drzava,Domaci,Gosti,goliDomaci,goliGosti,Liga,Status) VALUES (%s,%s,%s,%s,%s,%s,%s)''',(tabelaDrzava[stevec],tabelaD[stevec],tabelaG[stevec],int(tabelaRD[stevec]),int(tabelaRG[stevec]),tabelaLiga[stevec],tabelaStatus[stevec]))
baza.commit()








