Dummy = [
    {
        'cours' : 'cours1',
        'ens' : [
            {
                'p' : 'prof1',
                'val' : 0,
                'val2' : 4
            },
            {
                'p' : 'prof2',
                'val' : 2,
                'val2' : 8
            },
            {
                'p' : 'prof3',
                'val' : 4,
                'val2' : 6
            }
        ]
    },
    {
        'cours' : 'cours2',
        'ens' : [
            {
                'p' : 'prof1',
                'val' : 2,
                'val2' : 8
            },
            {
                'p' : 'prof2',
                'val' : 4,
                'val2' : 6
            },
            {
                'p' : 'prof3',
                'val' : 0,
                'val2' : 4
            }
        ]
    },
    {
        'cours' : 'cours3',
        'ens' : [
            {
                'p' : 'prof1',
                'val' : 4,
                'val2' : 6
            },
            {
                'p' : 'prof2',
                'val' : 0,
                'val2' : 4
            },
            {
                'p' : 'prof3',
                'val' : 2,
                'val2' : 8
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
    html += "<tr> <th></th>";
    for(var lProfs in Dummy[0].ens)
    {
        html += "<th>" + Dummy[0].ens[lProfs].p + "</th>";
    }
    html += "</tr>";
    for(var lCours in Dummy)
    {
        html += "<tr>";
        html += "<th>" + Dummy[lCours].cours + "</th>";
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
    html += "<table id='tabBilles'>";
    html += "<tr> <th></th>";
    for(var lProfs in Dummy[0].ens)
    {
        html += "<th>" + Dummy[0].ens[lProfs].p + "</th>";
    }
    html += "</tr>";
    for(var lCours in Dummy)
    {
        html += "<tr>";
        html += "<th>" + Dummy[lCours].cours + "</th>";
        for(var lProfs in Dummy[lCours].ens)
        {
            html += "<td>" + Dummy[lCours].ens[lProfs].val2 + "</td>";
        }
        html += "</tr>";
    }
    html += "</table>";
    document.getElementById("contentBilles").innerHTML = html;

}