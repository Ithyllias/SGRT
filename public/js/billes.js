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
            if(ens[j]["ens_inactif"] == 0)
            {
                ArrayBilles[i][cmpt] = [];
                ArrayBilles[i][cmpt].alias = ens[j]["ens_alias"];
                if (Dummy[ens[j]["ens_alias"]] == null || Dummy[ens[j]["ens_alias"]]["cours"][cours[i]["cou_no"]] == null) {
                    ArrayBilles[i][cmpt].billes = 0;
                    ArrayBilles[i][cmpt].fois = 0;
                    ArrayBilles[i][cmpt].bid = 0;
                }
                else {
                    ArrayBilles[i][cmpt].billes = Dummy[ens[j]["ens_alias"]]["cours"][cours[i]["cou_no"]].billes;
                    ArrayBilles[i][cmpt].fois = Dummy[ens[j]["ens_alias"]]["cours"][cours[i]["cou_no"]].compteur;
                    ArrayBilles[i][cmpt].bid = Dummy[ens[j]["ens_alias"]]["cours"][cours[i]["cou_no"]].bid;
                }
                cmpt++;
            }
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
        html += "<th onclick=\"clickCours(\'" + ArrayBilles[i].no + "\')\">" + ArrayBilles[i].titre + "</th>";
        for(var j = 0; j < ArrayBilles[i].length;j++)
        {
            if(ArrayBilles[i][j].alias != null) {
                html += "<td>" + ((langue == "EN") ? "Marbles: " : "Billes: ") + ArrayBilles[i][j].billes + ((langue == "EN") ? "<br /> Times: " : "<br /> Fois: ") + ArrayBilles[i][j].fois + "</td>";
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
    html += "<table id='tabBilles'>";
    html += "<tr> <th>INFO</th>";
    html += "<th>" + ((langue == "EN") ? "Marbles" : "Billes") + "</th>";
    html += "<th>" + ((langue == "EN") ? "Times" : "Fois") + "</th>";
    html += "<th>BID</th>";
    html += "</tr>";
    for(var i = 0; i < ArrayBilles.length;i++)
    {

        for(var j = 0; j < ArrayBilles[i].length;j++)
        {
                if(ArrayBilles[i][j].alias == pId)
                {
                    html += "<tr>";
                    html += "<th onclick=\"clickCours(\'" + ArrayBilles[i].no + "\')\">" + ArrayBilles[i].titre + "</th>";
                    html += "<td>" + ArrayBilles[i][j].billes + "</td>";
                    html += "<td>" + ArrayBilles[i][j].fois + "</td>";
                    html += "<td>" + ArrayBilles[i][j].bid + "</td>";
                    html += "</tr>";
                }
            }
    }
    html += "</table>";
    document.getElementById("contentBilles").innerHTML = html;
}

function clickCours(cId)
{
    for(var i = 0; i < ArrayBilles.length;i++) {
        if(ArrayBilles[i].no == cId){
            titre = ArrayBilles[i].titre;
        }
    }
    var html = "";
    html += "<h3>" + cId + ":" + titre + "</h3>"
    html += "<table id='tabBilles'>";
    html += "<tr> <th>INFO</th>";
    html += "<th>" + ((langue == "EN") ? "Marbles" : "Billes") + "</th>";
    html += "<th>" + ((langue == "EN") ? "Times" : "Fois") + "</th>";
    html += "<th>BID</th>";
    html += "</tr>";
    for(var i = 0; i < ArrayBilles.length;i++)
    {
        if(ArrayBilles[i].no == cId)
        {
            for(var j = 0; j < ArrayBilles[i].length;j++)
            {
                html += "<tr>";
                html += "<th onclick=\"clickProfs(\'" + ArrayBilles[i][j].alias + "\')\">" + ArrayBilles[i][j].alias + "</th>";
                html += "<td>" + ArrayBilles[i][j].billes + "</td>";
                html += "<td>" + ArrayBilles[i][j].fois + "</td>";
                html += "<td>" + ArrayBilles[i][j].bid + "</td>";
                html += "</tr>";
            }
        }
    }
    html += "</table>";
    document.getElementById("contentBilles").innerHTML = html;
}
