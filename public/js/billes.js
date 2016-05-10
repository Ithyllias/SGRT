var Dummy = [
    {
        'cours' : 'cours1',
        'ens' : [
            {
                'p' : 'prof1',
                'val' : 0,
                'val2' : 4,
                "val3" : 0
            },
            {
                'p' : 'prof2',
                'val' : 2,
                'val2' : 8,
                "val3" : 0
            },
            {
                'p' : 'prof3',
                'val' : 4,
                'val2' : 6,
                "val3" : 0
            },
            {
                'p' : 'prof4',
                'val' : 5,
                'val2' : 6,
                "val3" : 0
            },
            {
                'p' : 'prof5',
                'val' : 1,
                'val2' : 5,
                "val3" : 0
            },
            {
                'p' : 'prof6',
                'val' : 3,
                'val2' : 2,
                "val3" : 0
            },
            {
                'p' : 'prof7',
                'val' : 4,
                'val2' : 6,
                "val3" : 0
            },
            {
                'p' : 'prof8',
                'val' : 5,
                'val2' : 6,
                "val3" : 0
            },
            {
                'p' : 'prof9',
                'val' : 1,
                'val2' : 5,
                "val3" : 0
            },
            {
                'p' : 'prof10',
                'val' : 3,
                'val2' : 2,
                "val3" : 0
            }
        ]
    },
    {
        'cours' : 'cours2',
        'ens' : [
            {
                'p' : 'prof1',
                'val' : 2,
                'val2' : 8,
                "val3" : 0
            },
            {
                'p' : 'prof2',
                'val' : 4,
                'val2' : 6,
                "val3" : 0
            },
            {
                'p' : 'prof3',
                'val' : 0,
                'val2' : 4,
                "val3" : 0
            },
            {
                'p' : 'prof4',
                'val' : 5,
                'val2' : 6,
                "val3" : 0
            },
            {
                'p' : 'prof5',
                'val' : 1,
                'val2' : 5,
                "val3" : 0
            },
            {
                'p' : 'prof6',
                'val' : 3,
                'val2' : 2,
                "val3" : 0
            },
            {
                'p' : 'prof7',
                'val' : 4,
                'val2' : 6,
                "val3" : 0
            },
            {
                'p' : 'prof8',
                'val' : 5,
                'val2' : 6,
                "val3" : 0
            },
            {
                'p' : 'prof9',
                'val' : 1,
                'val2' : 5,
                "val3" : 0
            },
            {
                'p' : 'prof10',
                'val' : 3,
                'val2' : 2,
                "val3" : 0
            }
        ]
    },
    {
        'cours' : 'cours3',
        'ens' : [
            {
                'p' : 'prof1',
                'val' : 4,
                'val2' : 6,
                "val3" : 0
            },
            {
                'p' : 'prof2',
                'val' : 0,
                'val2' : 4,
                "val3" : 0
            },
            {
                'p' : 'prof3',
                'val' : 2,
                'val2' : 8,
                "val3" : 0
            },
            {
                'p' : 'prof4',
                'val' : 5,
                'val2' : 6,
                "val3" : 0
            },
            {
                'p' : 'prof5',
                'val' : 1,
                'val2' : 5,
                "val3" : 0
            },
            {
                'p' : 'prof6',
                'val' : 3,
                'val2' : 2,
                "val3" : 0
            },
            {
                'p' : 'prof7',
                'val' : 4,
                'val2' : 6,
                "val3" : 0
            },
            {
                'p' : 'prof8',
                'val' : 5,
                'val2' : 6,
                "val3" : 0
            },
            {
                'p' : 'prof9',
                'val' : 1,
                'val2' : 5,
                "val3" : 0
            },
            {
                'p' : 'prof10',
                'val' : 3,
                'val2' : 2,
                "val3" : 0
            }
        ]
    },
    {
        'cours' : 'cours4',
        'ens' : [
            {
                'p' : 'prof1',
                'val' : 1,
                'val2' : 2,
                "val3" : 0
            },
            {
                'p' : 'prof2',
                'val' : 3,
                'val2' : 4,
                "val3" : 0
            },
            {
                'p' : 'prof3',
                'val' : 5,
                'val2' : 6,
                "val3" : 0
            },
            {
                'p' : 'prof4',
                'val' : 5,
                'val2' : 6,
                "val3" : 0
            },
            {
                'p' : 'prof5',
                'val' : 1,
                'val2' : 5,
                "val3" : 0
            },
            {
                'p' : 'prof6',
                'val' : 3,
                'val2' : 2,
                "val3" : 0
            },
            {
                'p' : 'prof7',
                'val' : 4,
                'val2' : 6,
                "val3" : 0
            },
            {
                'p' : 'prof8',
                'val' : 5,
                'val2' : 6,
                "val3" : 0
            },
            {
                'p' : 'prof9',
                'val' : 1,
                'val2' : 5,
                "val3" : 0
            },
            {
                'p' : 'prof10',
                'val' : 3,
                'val2' : 2,
                "val3" : 0
            }
        ]
    }
];

function clickBilles()
{
    document.getElementById("bBilles").className = "selected";
    document.getElementById("bFois").className = "";
    var html = "";
    html += "<table id='tabBilles'>";
    html += "<tr> <th onclick=\"clickBilles()\">BILLES</th>";
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
            html += "<td>" + Dummy[lCours].ens[lProfs].val + "</td>";
        }
        html += "</tr>";
    }
    html += "</table>";
    document.getElementById("contentBilles").innerHTML = html;
}

function clickFois()
{
    document.getElementById("bBilles").className = "";
    document.getElementById("bFois").className = "selected";
    var html = "";
    html += "<table id='tabFois'>";
    html += "<tr> <th onclick=\"clickFois()\">FOIS</th>";
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
            html += "<td>" + Dummy[lCours].ens[lProfs].val2 + "</td>";
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
    html += "<tr> <th>INFOS</th>";
    html += "<th onclick=\"clickFois()\">FOIS</th>";
    html += "<th onclick=\"clickBilles()\">BILLES</th>";
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
    html += "<tr> <th>INFOS</th>";
    html += "<th onclick=\"clickFois()\">FOIS</th>";
    html += "<th onclick=\"clickBilles()\">BILLES</th>";
    html += "<th onclick=\"\">BID</th>";
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