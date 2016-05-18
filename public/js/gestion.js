

var compteur = 1;


function clickUsers() {
    document.getElementById("option1").className = "selected";
    document.getElementById("option2").className = "";
    document.getElementById("option3").className = "";

    var html = "";
    html += "<form action=\""+ routeAddEns + "\" method=\"post\">";
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
        html += "<td><input type='text' class='inputtxt' name='values[" + ens[prof].ens_id + "][alias]' value='" + ens[prof].ens_alias + "'></td>";
        html += "<td><input type='checkbox' name='values[" + ens[prof].ens_id + "][coord]' " + ((ens[prof].ens_coordonateur == 1) ? "Checked" : "") + "></td>";
        html += "<td><input type='checkbox' name='values[" + ens[prof].ens_id + "][actif]' " + ((ens[prof].ens_inactif == 1) ? "" : "Checked") + "></td>";
        html += "<td><input type='text' class='inputtxt' name='values[" + ens[prof].ens_id + "][comm]' value='" + ens[prof].ens_commentaire + "'></td>";
        html += "</tr>";
    }
    html += "</table>";
    html += "<input type='submit' value='" + ((langue == "FR") ? "Envoyer" : "Submit") + "'>";
    html += "\t";
    html += "<input type='button' onclick='clickAjout()' value='" + ((langue == "FR") ? "Ajout" : "Add") + "'>";
    html += "</form>"
    document.getElementById("contentGestion").innerHTML = html;

}

function clickCours() {
    document.getElementById("option2").className = "selected";
    document.getElementById("option1").className = "";
    document.getElementById("option3").className = "";

    var html = "";
    html += "<form action=\"\" method=\"post\">";
    html += "<table id='tabCours'>";
    html += "<tr>";
    html += "<th>" + ((langue == "FR") ? "Cours" : "Courses") + "</th>";
    html += "<th>" + ((langue == "FR") ? "valeur de compteur fois max" : "max value for times counter") + "</th>";
    html += "<th>" + ((langue == "FR") ? "Commentaire" : "Comment") + "</th>";
    html += "</tr>";
    for(var cour in cours)
    {
        html += "<tr>";
        html += "<td><input type='hidden' name='values[" + cours[cour].cou_no + "][titre]' value='" + cours[cour].cou_titre + "'>" + cours[cour].cou_titre + "</td>";
        html += "<td><input type='text' class='inputtxt' name='values[" + cours[cour].cou_no + "][compt_max]' value='" + cours[cour].cou_compteur_max + "'></td>";
        html += "<td><input type='text' class='inputtxt' name='values[" + cours[cour].cou_no + "][comm]' value='" + cours[cour].cou_commentaire + "'></td>";
        html += "</tr>";
    }
    html += "</table>";
    html += "<input type='submit' value='" + ((langue == "FR") ? "Envoyer" : "Submit") + "'>";
    html += "</form>"
    document.getElementById("contentGestion").innerHTML = html;

}

function clickImport() {
    document.getElementById("option3").className = "selected";
    document.getElementById("option1").className = "";
    document.getElementById("option2").className = "";

    var html = "";
    document.getElementById("contentGestion").innerHTML = html;
}

function clickAjout() {
    var table = document.getElementById("tabUsers");

    var row = table.insertRow();

    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(0);
    var cell3 = row.insertCell(0);
    var cell4 = row.insertCell(0);

    cell4.innerHTML = "<input type='text' name='values[new" + compteur + "][alias]' value=''>";
    cell3.innerHTML = "<input type='checkbox' name='values[new" + compteur + "][coord] value=''>";
    cell2.innerHTML = "<input type='checkbox' name='values[new" + compteur + "][actif] value=''>";
    cell1.innerHTML = "<input type='text' name='values[new" + compteur + "][comm] value=''>";

    compteur += 1;
}