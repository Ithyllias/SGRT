



function clickopt1() {
    document.getElementById("option1").className = "selected";
    document.getElementById("option2").className = "";
    document.getElementById("option3").className = "";

    var html = "";
    html += "<form action=\"\" method=\"post\">";
    html += "<table id='tabUsers'>";
    html += "<tr>";
    html += "<th>Alias</th>";
    html += "<th>" + ((langue == "FR") ? "Coordonnateur" : "Coord") + "</th>";
    html += "<th>" + ((langue == "FR") ? "Actif" : "Active") + "</th>";
    html += "<th>" + ((langue == "FR") ? "Commentaire" : "Comment") + "</th>";
    html += "</tr>";
    for(var prof in ens)
    {
        html += "<tr>";
        html += "<td><input type='text' value='" + ens[prof].alias + "'></td>";
        html += "<td><input type='checkbox' " + ((ens[prof].coord == 1) ? "Checked" : "") + "></td>";
        html += "<td><input type='checkbox' " + ((ens[prof].actif == 1) ? "Checked" : "") + "></td>";
        html += "<td><input type='text' value='" + ens[prof].comm + "'></td>";
        html += "</tr>";
    }
    html += "</table>";
    html += "<input type='submit' value='" + ((langue == "FR") ? "Envoyer" : "Submit") + "'>";
    html += "\t";
    html += "<input type='button' onclick='clickAjout()' value='" + ((langue == "FR") ? "Ajout" : "Add") + "'>";
    html += "</form>"
    document.getElementById("contentGestion").innerHTML = html;

}

function clickopt2() {
    document.getElementById("option2").className = "selected";
    document.getElementById("option1").className = "";
    document.getElementById("option3").className = "";
}

function clickopt3() {
    document.getElementById("option3").className = "selected";
    document.getElementById("option1").className = "";
    document.getElementById("option2").className = "";

}

function clickAjout() {
    var table = document.getElementById("tabUsers");

    var row = table.insertRow();

    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(0);
    var cell3 = row.insertCell(0);
    var cell4 = row.insertCell(0);

    cell4.innerHTML = "<input type='text' value=''>";
    cell3.innerHTML = "<input type='checkbox' value=''>";
    cell2.innerHTML = "<input type='checkbox' value=''>";
    cell1.innerHTML = "<input type='text' value=''>";
}