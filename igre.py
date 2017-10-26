import requests
from operator import itemgetter, attrgetter
from bs4 import BeautifulSoup
import numpy
tabelaD = []
tabelaG = []
tabelaRD = []
tabelaRG = []
stevec = 0
matrikaStevec = 0
spored = ""
stran = requests.get("http://www.xscores.com/soccer/livescores/26-10")
vsebina = BeautifulSoup(stran.content,'html.parser')
domacaEkipa = vsebina.findAll("div", attrs= {'class':"score_home_txt score_cell wrap"})
gostujocaEkipa = vsebina.findAll("div", attrs= {'class':"score_away_txt score_cell wrap"})
rezultatD = vsebina.findAll("div", attrs= {'class' : 'scoreh_ft score_cell centerTXT'})
rezultatG = vsebina.findAll("div", attrs= {'class' : 'scorea_ft score_cell centerTXT'})
drzava = vsebina.findAll("span", attrs= {'class' : "tooltip_flag",})

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
    tabelaRD.append(tekst)

for stevilke in rezultatG:
    tekst = stevilke.text
    tekst = tekst.replace("\t", "").replace("\r", "").replace("\n", "")
    tabelaRG.append(tekst)

tabelaDrzava = numpy.empty((2, len(tabelaD)),dtype=object)
for besedilo in drzava:
    tekst = besedilo.text
    tekst = tekst.replace("\t", "").replace("\r", "").replace("\n", "").replace("SHOW GAMES FROM","")
    tabelaDrzava[0][matrikaStevec] = tekst
    tabelaDrzava[1][matrikaStevec] = matrikaStevec
    matrikaStevec+=1


for stevec in range(0, len(tabelaD)):
    if tabelaRD[stevec] is None and tabelaRG[stevec] is None:
        print(tabelaD[stevec] + " : " + tabelaG[stevec] + " " + "Tekma se še ni začela")
    else:
        print(tabelaD[stevec] + " : " + tabelaG[stevec] + " " +tabelaRD[stevec] + "-" + tabelaRG[stevec] + " " + tabelaDrzava[0][stevec])
    stevec+=1







