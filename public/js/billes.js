window.onload = function() {
    ArrayBilles = [];

    for(var i = 0; i < cours.length;i++)
    {
        ArrayBilles[i] = [];
        ArrayBilles[i].titre = cours[i]["cou_titre"];
        ArrayBilles[i].no = cours[i]["cou_no"];
        cmpt = 0;
        for(var j = 0; j < ens.length;j++)
        {
                ArrayBilles[i][cmpt] = [];
                ArrayBilles[i][cmpt].alias = ens[j]["ens_alias"];
                if (cmptEtBilles[ens[j]["ens_alias"]] == null || cmptEtBilles[ens[j]["ens_alias"]]["cours"][cours[i]["cou_no"]] == null) {
                    ArrayBilles[i][cmpt].billes = 0;
                    ArrayBilles[i][cmpt].fois = 0;
                }
                else {
                    ArrayBilles[i][cmpt].billes = cmptEtBilles[ens[j]["ens_alias"]]["cours"][cours[i]["cou_no"]].billes;
                    ArrayBilles[i][cmpt].fois = cmptEtBilles[ens[j]["ens_alias"]]["cours"][cours[i]["cou_no"]].compteur;
                    if(cmptEtBilles[ens[j]["ens_alias"]]["cours"][cours[i]["cou_no"]].bid != null) {
                        ArrayBilles[i][cmpt].bid = cmptEtBilles[ens[j]["ens_alias"]]["cours"][cours[i]["cou_no"]].bid;
                    }
                }
                cmpt++;
        }
    }
    clickTableau();
};

function clickTableau()
{
    document.getElementById("bC").className = "selected";
    var html = "";
    html += "<h3>" + ((langue == "EN") ? "This is the Times/Marbles for all teachers." : "Voici les Fois/Billes Pour tout les enseignants.") + "</h3>";
    html += "<table id='tabBilles'>";
    html += "<tr> <th onclick=\"clickTableau()\">INFO</th>";
    for(var i = 0; i < ArrayBilles[0].length;i++)
    {
        if(ArrayBilles[0][i].alias != null)
        {
            html += "<th onclick=\"clickProfs(\'" + ArrayBilles[0][i].alias + "\')\">" + ArrayBilles[0][i].alias + "</th>";
        }

    }
    html += "</tr>";
    for(var i = 0; i < ArrayBilles.length;i++)
    {
        html += "<tr>";
        html += "<th onclick=\"clickCours(\'" + ArrayBilles[i].no + "\')\">" + ArrayBilles[i].no + " : " + ArrayBilles[i].titre + "</th>";
        for(var j = 0; j < ArrayBilles[i].length;j++)
        {
            if(ArrayBilles[i][j].alias != null) {
                html += "<td><h3>" + ArrayBilles[i][j].fois + "/" + ArrayBilles[i][j].billes + "</h3></td>";
            }
        }
        html += "</tr>";
    }
    html += "</table>";
    document.getElementById("contentBilles").innerHTML = html;
}

function clickProfs(pId)
{

    var html = "";
    html += "<h3>" + pId + "</h3>"
    html += "<button onclick=\"clickTableau()\">RETOUR</button>";
    html += "</br> <table id='tabBillesP'>";
    html += "<tr> <th>INFO</th>";
    html += "<th>" + ((langue == "EN") ? "Times" : "Fois") + "</th>";
    html += "<th>" + ((langue == "EN") ? "Marbles" : "Billes") + "</th>";
    html += "</tr>";
    for(var i = 0; i < ArrayBilles.length;i++)
    {
        for(var j = 0; j < ArrayBilles[i].length;j++)
        {
                if(ArrayBilles[i][j].alias == pId)
                {
                    if(ArrayBilles[i][j].fois != 0 || ArrayBilles[i][j].billes != 0) {
                        html += "<tr>";
                        html += "<th onclick=\"clickCours(\'" + ArrayBilles[i].no + "\')\">" + ArrayBilles[i].no + " : " + ArrayBilles[i].titre + "</th>";
                        html += "<td>" + ArrayBilles[i][j].fois + "</td>";
                        html += "<td>" + ArrayBilles[i][j].billes + "</td>";
                        html += "</tr>";
                    }
                }
            }
    }
    html += "</table>";
    html += "</br>";
    document.getElementById("contentBilles").innerHTML = html;
}

function clickCours(cId)
{

    var listFois = new Array();
    var listBilles = new Array();
    var listBid = new Array();

    for(var i = 0; i < ArrayBilles.length;i++) {
        if(ArrayBilles[i].no == cId){
            titre = ArrayBilles[i].titre;
            for(var j = 0; j < ArrayBilles[i].length;j++) {
                listFois.push({ key: ArrayBilles[i][j].alias, val: ArrayBilles[i][j].fois });
                listBilles.push({ key: ArrayBilles[i][j].alias, val: ArrayBilles[i][j].billes });
                if(ArrayBilles[i][j].bid != null)
                {
                    listBid.push({ key: ArrayBilles[i][j].alias, val: ArrayBilles[i][j].bid });
                }
            }
        }
    }
    listFois.sort(function(a,b) {
        return b.val - a.val;
    });
    listBilles.sort(function(a,b) {
        return b.val - a.val;
    });
    listBid.sort(function(a,b) {
        return a.val - b.val;
    });


    var html = "";
    html += "<h3>" + cId + " : " + titre + "</h3> </br>"
    html += "<button onclick=\"clickTableau()\">RETOUR</button>";
    html += "</br> <h3>" + ((langue == "EN") ? "Times" : "Fois") + "</h3>";
    html += "<table id='tabFoisC'>";
    html += "<th>" + ((langue == "EN") ? "Alias" : "Alias") + "</th>";
    html += "<th>" + ((langue == "EN") ? "Times" : "Fois") + "</th>";
    for(var i = 0; i < listFois.length;i++)
    {
        if(listFois[i].val != 0)
        {
            html += "<tr>";
            html += "<th onclick=\"clickProfs(\'" + listFois[i].key + "\')\">" + listFois[i].key + "</th>";
            html += "<td>" + listFois[i].val + "</td>";
            html += "</tr>";
        }
    }
    html += "</table>";

    html += "<h3>" + ((langue == "EN") ? "Marbles" : "Billes") + "</h3>";
    html += "<table id='tabBillesC'>";
    html += "<th>" + ((langue == "EN") ? "Alias" : "Alias") + "</th>";
    html += "<th>" + ((langue == "EN") ? "Marbles" : "Billes") + "</th>";
    for(var i = 0; i < listBilles.length;i++)
    {
        if(listBilles[i].val != 0)
        {
            html += "<tr>";
            html += "<th onclick=\"clickProfs(\'" + listBilles[i].key + "\')\">" + listBilles[i].key + "</th>";
            html += "<td>" + listBilles[i].val + "</td>";
            html += "</tr>";
        }
    }
    html += "</table>";
    if(listBid.length > 0)
    {
        html += "<h3>" + ((langue == "EN") ? "Bid" : "Bid") + "</h3>";
        html += "<table id='tabBidC'>";
        html += "<th>" + ((langue == "EN") ? "Alias" : "Alias") + "</th>";
        html += "<th>" + ((langue == "EN") ? "Bid" : "Bid") + "</th>";
        for(var i = 0; i < listBid.length;i++)
        {
            if(listBid[i].val != 0)
            {
                html += "<tr>";
                html += "<th onclick=\"clickProfs(\'" + listBid[i].key + "\')\">" + listBid[i].key + "</th>";
                html += "<td>" + listBid[i].val + "</td>";
                html += "</tr>";
            }
        }
        html += "</table>";
    }
    html += "</br>";
    document.getElementById("contentBilles").innerHTML = html;
}
