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
                if (Dummy[ens[j]["ens_alias"]] == null || Dummy[ens[j]["ens_alias"]]["cours"][cours[i]["cou_no"]] == null) {
                    ArrayBilles[i][cmpt].billes = 0;
                    ArrayBilles[i][cmpt].fois = 0;
                }
                else {
                    ArrayBilles[i][cmpt].billes = Dummy[ens[j]["ens_alias"]]["cours"][cours[i]["cou_no"]].billes;
                    ArrayBilles[i][cmpt].fois = Dummy[ens[j]["ens_alias"]]["cours"][cours[i]["cou_no"]].compteur;
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
                html += "<td>" + ((langue == "EN") ? "Times: " : "Fois: ") + ArrayBilles[i][j].fois + ((langue == "EN") ? "<br /> Marbles: " : "<br /> Billes: ") + ArrayBilles[i][j].billes + "</td>";
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
    html += "</br> <table id='tabBilles'>";
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
                    html += "<tr>";
                    html += "<th onclick=\"clickCours(\'" + ArrayBilles[i].no + "\')\">" + ArrayBilles[i].no + " : " + ArrayBilles[i].titre + "</th>";
                    html += "<td>" + ArrayBilles[i][j].fois + "</td>";
                    html += "<td>" + ArrayBilles[i][j].billes + "</td>";
                    html += "</tr>";
                }
            }
    }
    html += "</table>";
    document.getElementById("contentBilles").innerHTML = html;
}

function clickCours(cId)
{

    var listFois = new Array();
    var listBilles = new Array();

    for(var i = 0; i < ArrayBilles.length;i++) {
        if(ArrayBilles[i].no == cId){
            titre = ArrayBilles[i].titre;
            for(var j = 0; j < ArrayBilles[i].length;j++) {
                listFois.push({ key: ArrayBilles[i][j].alias, val: ArrayBilles[i][j].fois });
                listBilles.push({ key: ArrayBilles[i][j].alias, val: ArrayBilles[i][j].billes });
            }
        }
    }
    listFois.sort(function(a,b) {
        return b.val - a.val;
    });
    listBilles.sort(function(a,b) {
        return b.val - a.val;
    });



    var html = "";
    html += "<h3>" + cId + " : " + titre + "</h3> </br>"
    html += "<button onclick=\"clickTableau()\">RETOUR</button>";
    html += "</br> <h3>" + ((langue == "EN") ? "Times" : "Fois") + "</h3>";
    html += "<table id='tabFois'>";
    html += "<th>" + ((langue == "EN") ? "Alias" : "Alias") + "</th>";
    html += "<th>" + ((langue == "EN") ? "Times" : "Fois") + "</th>";
    for(var i = 0; i < listFois.length;i++)
    {
        html += "<tr>";
        html += "<th onclick=\"clickProfs(\'" + listFois[i].key + "\')\">" + listFois[i].key + "</th>";
        html += "<td>" + listFois[i].val + "</td>";
        html += "</tr>";
    }
    html += "</table>";

    html += "<h3>" + ((langue == "EN") ? "Marbles" : "Billes") + "</h3>";
    html += "<table id='tabBilles'>";
    html += "<th>" + ((langue == "EN") ? "Alias" : "Alias") + "</th>";
    html += "<th>" + ((langue == "EN") ? "Marbles" : "Billes") + "</th>";
    for(var i = 0; i < listBilles.length;i++)
    {
        html += "<tr>";
        html += "<th onclick=\"clickProfs(\'" + listBilles[i].key + "\')\">" + listBilles[i].key + "</th>";
        html += "<td>" + listBilles[i].val + "</td>";
        html += "</tr>";
    }
    html += "</table>";
    document.getElementById("contentBilles").innerHTML = html;
}
