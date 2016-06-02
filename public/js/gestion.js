window.onload = function() {
};

var compteur = 1;


function clickUsers() {
    document.getElementById("option1").className = "selected";
    document.getElementById("option2").className = "";
    document.getElementById("option3").className = "";

    var html = "";
    html += "<form action=\""+ routeAddEns + "\" method=\"post\">";
    html += "<table id='tabUsers'>";
    html += "<tr>";
    html += "<th>" + ((langue == "EN") ? "Login" : "Connection") + "</th>";
    html += "<th>Alias</th>";
    html += "<th>" + ((langue == "EN") ? "Coord" : "Coordonnateur") + "</th>";
    html += "<th>" + ((langue == "EN") ? "Active" : "Actif") + "</th>";
    html += "<th>" + ((langue == "EN") ? "Comment" : "Commentaire") + "</th>";
    html += "</tr>";
    for(var prof in ens)
    {
        html += "<tr>";
        html += "<th><input type='hidden' class='inputtxt' name='values[" + ens[prof].ens_id + "][login]' value='" + ens[prof].ens_login + "'>" + ens[prof].ens_login + "</th>";
        html += "<td><input type='text' class='inputtxt' name='values[" + ens[prof].ens_id + "][alias]' value='" + ens[prof].ens_alias + "'></td>";
        html += "<td><input type='checkbox' name='values[" + ens[prof].ens_id + "][coord]' " + ((ens[prof].ens_coordonateur == 1) ? "Checked" : "") + "></td>";
        html += "<td><input type='checkbox' name='values[" + ens[prof].ens_id + "][actif]' " + ((ens[prof].ens_inactif == 1) ? "" : "Checked") + "></td>";
        html += "<td><input type='text' class='inputtxt' name='values[" + ens[prof].ens_id + "][comm]' value='" + ens[prof].ens_commentaire + "'></td>";
        html += "</tr>";
    }
    html += "</table>";
    html += "<input type='button' onclick='clickAjout()' value='+''>";
    html += " </br> </br> <input type='submit' value='" + ((langue == "EN") ? "Submit" : "Envoyer") + "'>";
    html += "</form>"
    document.getElementById("contentGestion").innerHTML = html;

}

function clickCours() {
    document.getElementById("option2").className = "selected";
    document.getElementById("option1").className = "";
    document.getElementById("option3").className = "";

    var html = "";
    html += "<form action=\""+ routeModifCours + "\" method=\"post\">";
    html += "<table id='tabCours'>";
    html += "<tr>";
    html += "<th>No.</th>";
    html += "<th>" + ((langue == "EN") ? "Courses" : "Cours") + "</th>";
    html += "<th>" + ((langue == "EN") ? "max value for times counter" : "valeur de compteur fois max") + "</th>";
    html += "<th>" + ((langue == "EN") ? "Comment" : "Commentaire") + "</th>";
    html += "</tr>";
    for(var cour in cours)
    {
        html += "<tr>";
        html += "<td><input type='hidden' name='values[" + cours[cour].cou_no + "][no]' value='" + cours[cour].cou_no + "'>" + cours[cour].cou_no + "</td>";
        html += "<td><input type='hidden' name='values[" + cours[cour].cou_no + "][titre]' value='" + cours[cour].cou_titre + "'>" + cours[cour].cou_titre + "</td>";
        html += "<td><input type='text' class='inputtxt' name='values[" + cours[cour].cou_no + "][compt_max]' value='" + cours[cour].cou_compteur_max + "'></td>";
        html += "<td><input type='text' class='inputtxt' name='values[" + cours[cour].cou_no + "][comm]' value='" + cours[cour].cou_commentaire + "'></td>";
        html += "</tr>";
    }
    html += "</table>";
    html += "<input type='button' onclick='clickAjoutC()' value='+''>";
    html += " </br> </br> <input type='submit' value='" + ((langue == "EN") ? "Submit" : "Envoyer") + "'>";
    html += "</form>";
    document.getElementById("contentGestion").innerHTML = html;

}

function clickImport() {
    document.getElementById("option3").className = "selected";
    document.getElementById("option1").className = "";
    document.getElementById("option2").className = "";

    var html = "";
    html += "<form action=\""+ "a" + "\" method=\"post\">";
    html += "<h3>" + ((langue == "EN") ? "New Task" : "Tâche Vierge") + "</h3> </br>";
    html += "<input type=\"file\" name=\"datafile\" size=\"40\">";
    html += "</br></br> <input type=\"submit\" value=\"Send\">";
    html += "</form>";
    html += "<form action=\""+ "b" + "\" method=\"post\">";
    html += "<h3>" + ((langue == "EN") ? "Completed Task" : "Tâche Complété") + "</h3> </br>";
    html += "<input type=\"file\" name=\"datafile\" size=\"40\">";
    html += "</br></br> <input type=\"submit\" value=\"Send\">";
    html += "</form>";
    html += "<form action=\""+ "c" + "\" method=\"post\">";
    html += "<h3>" + ((langue == "EN") ? "Starting Marbles" : "Billes Départ") + "</h3> </br>";
    html += "<input type=\"file\" name=\"datafile\" size=\"40\">";
    html += "</br></br> <input type=\"submit\" value=\"Send\">";
    html += "</form>";
    document.getElementById("contentGestion").innerHTML = html;
}

function clickAjout() {
    var table = document.getElementById("tabUsers");

    var row = table.insertRow();

    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(0);
    var cell3 = row.insertCell(0);
    var cell4 = row.insertCell(0);
    var cell5 = row.insertCell(0);

    cell5.innerHTML = "<input type='text' class='inputtxt' name='values[new" + compteur + "][login]' value=''>";
    cell4.innerHTML = "<input type='text' class='inputtxt' name='values[new" + compteur + "][alias]' value=''>";
    cell3.innerHTML = "<input type='checkbox' name='values[new" + compteur + "][coord] value=''>";
    cell2.innerHTML = "<input type='checkbox' name='values[new" + compteur + "][actif] value=''>";
    cell1.innerHTML = "<input type='text' class='inputtxt' name='values[new" + compteur + "][comm] value=''>";

    compteur += 1;
}
function clickAjout() {
    var table = document.getElementById("tabUsers");

    var row = table.insertRow();

    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(0);
    var cell3 = row.insertCell(0);
    var cell4 = row.insertCell(0);
    var cell5 = row.insertCell(0);

    cell5.innerHTML = "<input type='text' class='inputtxt' name='values[new" + compteur + "][login]' value=''>";
    cell4.innerHTML = "<input type='text' class='inputtxt' name='values[new" + compteur + "][alias]' value=''>";
    cell3.innerHTML = "<input type='checkbox' name='values[new" + compteur + "][coord] value=''>";
    cell2.innerHTML = "<input type='checkbox' name='values[new" + compteur + "][actif] value=''>";
    cell1.innerHTML = "<input type='text' class='inputtxt' name='values[new" + compteur + "][comm] value=''>";

    compteur += 1;
}

function clickAjoutC() {
    var table = document.getElementById("tabCours");

    var row = table.insertRow();

    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(0);
    var cell3 = row.insertCell(0);
    var cell4 = row.insertCell(0);

    cell4.innerHTML = "<input type='text' class='inputtxt' name='values[new" + compteur + "][no]' value=''>";
    cell3.innerHTML = "<input type='text' class='inputtxt' name='values[new" + compteur + "][titre] value=''>";
    cell2.innerHTML = "<input type='text' class='inputtxt' name='values[new" + compteur + "][compt_max] value=''>";
    cell1.innerHTML = "<input type='text' class='inputtxt' name='values[new" + compteur + "][comm] value=''>";

    compteur += 1;
}