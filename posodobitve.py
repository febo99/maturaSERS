import requests
import MySQLdb
from bs4 import BeautifulSoup
import time

tabelaD = []
tabelaG = []
tabelaRD = []
tabelaRG = []
tabelaDrzava = []
tabelaStatus = []
tabelaLiga = []
preveriPodatke = True
datum = time.strftime("%d-%m")
stran = requests.get("http://www.xscores.com/soccer/livescores/" + datum)
vsebina = BeautifulSoup(stran.content,'html.parser')
liga = vsebina.findAll("a", attrs= {'class': "league"})
domacaEkipa = vsebina.findAll("div", attrs= {'class':"score_home_txt score_cell wrap"})
gostujocaEkipa = vsebina.findAll("div", attrs= {'class':"score_away_txt score_cell wrap"})
rezultatD = vsebina.findAll("div", attrs= {'class' : 'scoreh_ft score_cell centerTXT'})
rezultatG = vsebina.findAll("div", attrs= {'class' : 'scorea_ft score_cell centerTXT'})
drzava = vsebina.findAll("span", attrs= {'class' : "tooltip_flag"})
statusTekme = vsebina.findAll("div",{ 'data-game-status' : True} )


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



baza = MySQLdb.connect(host="localhost",user="root",passwd="rdecastrela6",db="stavnica")
kazalec = baza.cursor()
kazalec.execute("SELECT * FROM tekme")
podatki = kazalec.fetchall()

for x in range(0, len(podatki)):
    if(("Fin" in str(tabelaStatus[x])) or ("Post" in str(tabelaStatus[x]))):
        preveriPodatke = False
        print("Nobena tekma ni bila spremenjena!")


    if(int(tabelaRD[x]) != podatki[x][4] or int(tabelaRG[x]) != podatki[x][5] or not(tabelaStatus[x] in podatki[x][7])):
        kazalec.execute("""UPDATE tekme SET goliDomaci=%s,goliGosti=%s,Status=%s WHERE Domaci=%s""",(int(tabelaRD[x]),int(tabelaRG[x]),tabelaStatus[x],tabelaD[x]))
        kazalec.execute("""UPDATE stavniListek SET goliD=%s, goliG=%s WHERE  domaci=%s AND gosti=%s""",(int(tabelaRD[x]),int(tabelaRG[x]),tabelaD[x],tabelaG[x]))

if(preveriPodatke == True):
    exec(open("./igre.py").read())
    print("Spremenili tekme!")
                    
baza.commit()







