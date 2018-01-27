var tekmeID = new Array;
var tipi = new Array;
var vsotaK = 1;
var dobicek = 1;
function dodajParDomaci(tabela,indeks,kvota){
        document.getElementById("stavniListek").innerHTML += "<p class='listki' id='" + indeks +"'>" + tabela[indeks][0] + " " + tabela[indeks][2] + " " + tabela[indeks][3] +" " + 1 +" " + kvota[indeks]+ "<button class='brisanje' onclick='odstraniPar("+"tekme,"+indeks+ ",kvotaDomaci"+")' id='x"+indeks+"'>X</button>";
        document.getElementById("listek").innerHTML += "<input type='hidden' value='" + tabela[indeks][0] + "x" + "1y"+kvota[indeks]+ "'name='" + tabela[indeks][0] + "x" + "1y"+kvota[indeks]+ "'/>"; 
        vsotaK = vsotaK * kvota[indeks];
        document.getElementById("sestevekKvot").value = vsotaK.toFixed(2);
        tekmeID.push(tabela[indeks][0]);
        tipi.push(1);
        var gumbi = document.getElementsByClassName(indeks); 
        for(var i = 0; i < gumbi.length; i++){
            gumbi[i].disabled = true;
        }
}
function dodajParGosti(tabela,indeks,kvota){
    document.getElementById("stavniListek").innerHTML += "<p class='listki' id='" + indeks +"'>" + tabela[indeks][0] + " " + tabela[indeks][2] + " " + tabela[indeks][3] +" " + 2 + " " + kvota[indeks]+ "<button class='brisanje' onclick='odstraniPar("+"tekme,"+indeks+",kvotaGosti"+ ")' id='x"+indeks+"'>X</button>";
    document.getElementById("listek").innerHTML += "<input type='hidden' value='" + tabela[indeks][0] + "x" + "2y"+kvota[indeks]+ "'name='" + tabela[indeks][0] + "x" + "2y"+kvota[indeks]+ "'/>"; 
    vsotaK = vsotaK * kvota[indeks];
    document.getElementById("sestevekKvot").value = vsotaK.toFixed(2);
    var gumbi = document.getElementsByClassName(indeks);
    tekmeID.push(tabela[indeks][0]);
    tipi.push(2);
    for(var i = 0; i < gumbi.length; i++){
        gumbi[i].disabled = true;
    }
}
function dodajParNeodloceno(tabela,indeks,kvota){
    document.getElementById("stavniListek").innerHTML += "<p class='listki' id='" + indeks +"'>" + tabela[indeks][0] + " " + tabela[indeks][2] + " " + tabela[indeks][3] +" " + "X "+kvota[indeks]+ "<button class='brisanje' onclick='odstraniPar("+"tekme," +indeks+ ",kvotaIzenaceno"+")' id='x"+indeks+"'>X</button>";
    document.getElementById("listek").innerHTML += "<input type='hidden' value='" + tabela[indeks][0] + "x" + "0y"+kvota[indeks]+ "'name='" + tabela[indeks][0] + "x" + "0y"+kvota[indeks]+ "'/>"; 
    vsotaK = vsotaK * kvota[indeks];
    document.getElementById("sestevekKvot").value = vsotaK.toFixed(2);
    var gumbi = document.getElementsByClassName(indeks);
    tekmeID.push(tabela[indeks][0]);
    tipi.push(0);
    for(var i = 0; i < gumbi.length; i++){
        gumbi[i].disabled = true;
    }
}
function odstraniPar(tabela,indeks,kvota){
    $("p").remove("#" + indeks);
    $("input[type=hidden]").each(function(){
        if($(this).val() == tabela[indeks][0] + "x1"){
            $(this).remove();
        }
        else if($(this).val() == tabela[indeks][0] + "x0"){
            $(this).remove();
        }
        else if($(this).val() == tabela[indeks][0] + "x2"){
            $(this).remove();
        }
    });
    var gumbi = document.getElementsByClassName(indeks);
    var poz = tekmeID.indexOf(tabela[indeks][0]);
    tekmeID.splice(poz,1); // IZBRIS IZBRANEGA!
    for(var i = 0; i < gumbi.length; i++){
        gumbi[i].disabled = false;
    }
    vsotaK = vsotaK / kvota[indeks];
    document.getElementById("sestevekKvot").value = vsotaK.toFixed(2);
    dobicek = document.getElementById("znesek").value;
    dobicek = parseFloat(dobicek) * vsotaK;
    document.getElementById("mozniDobitek").value = dobicek.toFixed(2);

}

function izracun(){
    dobicek = document.getElementById("znesek").value;
    dobicek = parseFloat(dobicek) * vsotaK;
    document.getElementById("mozniDobitek").value = dobicek.toFixed(2);
}

