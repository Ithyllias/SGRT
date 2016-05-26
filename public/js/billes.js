window.onload = function() {
    //clickTableau();
};


function clickTableau()
{
    document.getElementById("bC").className = "selected";
    var html = "";
    html += "<table id='tabBilles'>";
    html += "<tr> <th onclick=\"clickTableau()\">INFO</th>";
    for(var lProfs in Dummy[0].ens)
    {
        html += "<th onclick=\"clickProfs(\'" + Dummy[0].ens[lProfs].p + "\')\">" + Dummy[0].ens[lProfs].p + "</th>";
    }
    html += "</tr>";
    for(var lCours in Dummy)
    {
        html += "<tr>";
        html += "<th onclick=\"clickCours(\'" + Dummy[lCours].cours + "\')\">" + Dummy[lCours].cours + "</th>";
        for(var lProfs in Dummy[lCours].ens)
        {
            html += "<td>" + ((langue == "FR") ? "Billes: " : "Marbles: ")  + Dummy[lCours].ens[lProfs].val + ((langue == "FR") ? "<br /> Fois: " : "<br /> Times: ") + Dummy[lCours].ens[lProfs].val2 + "</td>";
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
    html += "<th onclick=\"\">" + ((langue == "FR") ? "FOIS" : "TIMES") + "</th>";
    html += "<th onclick=\"\">" + ((langue == "FR") ? "BILLES" : "MARBLES") + "</th>";
    html += "<th onclick=\"\">BID</th>";
    html += "</tr>";
    for(var lCours in Dummy)
    {

            for (var lProfs in Dummy[lCours].ens) {
                if(Dummy[lCours].ens[lProfs].p == pId)
                {
                    html += "<tr>";
                    html += "<th onclick=\"clickCours(\'" + Dummy[lCours].cours + "\')\">" + Dummy[lCours].cours + "</th>";
                    html += "<td>" + Dummy[lCours].ens[lProfs].val + "</td>";
                    html += "<td>" + Dummy[lCours].ens[lProfs].val2 + "</td>";
                    html += "<td>" + Dummy[lCours].ens[lProfs].val3 + "</td>";
                    html += "</tr>";
                }
            }
    }
    html += "</table>";
    document.getElementById("contentBilles").innerHTML = html;
}

function clickCours(cId)
{
    var html = "";
    html += "<h3>" + cId + "</h3>"
    html += "<table id='tabBilles'>";
    html += "<tr> <th>INFO</th>";
    html += "<th onclick=\"clickTriFois(" + cId + ")\">" + ((langue == "FR") ? "FOIS" : "TIMES") + "</th>";
    html += "<th onclick=\"clickTriBilles(" + cId + ")\">" + ((langue == "FR") ? "BILLES" : "MARBLES") + "</th>";
    html += "<th onclick=\"clickTriBid(" + cId + ")\">BID</th>";
    html += "</tr>";
    for(var lCours in Dummy)
    {
        if(Dummy[lCours].cours == cId)
        {
            for (var lProfs in Dummy[lCours].ens) {
                html += "<tr>";
                html += "<th onclick=\"clickProfs(\'" + Dummy[lCours].ens[lProfs].p + "\')\">" + Dummy[lCours].ens[lProfs].p + "</th>";
                html += "<td>" + Dummy[lCours].ens[lProfs].val + "</td>";
                html += "<td>" + Dummy[lCours].ens[lProfs].val2 + "</td>";
                html += "<td>" + Dummy[lCours].ens[lProfs].val3 + "</td>";
                html += "</tr>";
            }
        }
    }
    html += "</table>";
    document.getElementById("contentBilles").innerHTML = html;
}
