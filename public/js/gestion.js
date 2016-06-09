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
    html += "</form>";
    document.getElementById("contentGestion").innerHTML = html;

}

function confirmReset(){
    var result = confirm(((langue == "EN") ? "This action will permanently delete all current starting marbles, are you certain you wish to proceed?" : "Cette action supprimera de façon permanente toutes les entrés actuelles de billes de départ, êtes-vous certain de vouloir continuer?"));
    return result;
}

function confirmClose(url){
    var enMessage = "This action will permanently close the current task, are you certain you wish to proceed?\n";
    var frMessage = "Cette action fermera de façon permanente la tâche actuelle, êtes-vous certain de vouloir continuer?\n";
    var listMessage = "";
    var unfinished = false;

    $.ajax({
        url: url,
        method: 'POST',
        async: false,
        complete: function (response) {
            var obj = JSON.parse(response.responseText);
            $.each(obj, function(ok,ov){
                if(hasFalse(ov.session)){
                    listMessage += ov.ens_alias + ' : ';
                    $.each(ov.session, function(sk,sv){
                        if(sv == false){
                            listMessage += sk + ', ';
                            unfinished = true;
                        }
                    });
                    listMessage = listMessage.replace(/,\s*$/, "");
                    listMessage += '\n';
                }
            });
            if(unfinished){
                enMessage += "The following teachers have not completed all their choices:\n" + listMessage;
                frMessage += "Les enseignants suivant n\'ont pas complété leurs choix:\n" + listMessage;
            }
        },
        error: function () {
            $('#contentGestion').html('Error!!!');
        }
    });

    return confirm(((langue == "EN") ? enMessage : frMessage));
}

function hasFalse(target){
    for (var member in target) {
        if (target[member] == false)
            return true;
    }
    return false;
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

function clickImport(url) {
    document.getElementById("option3").className = "selected";
    document.getElementById("option1").className = "";
    document.getElementById("option2").className = "";

    $.ajax({
        url: url,
        method: 'POST',
        complete: function (response) {
            $('#contentGestion').html(response.responseText);
        },
        error: function () {
            $('#contentGestion').html('Bummer: there was an error!');
        }
    });
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

function clickResetChoix(url) {
    document.getElementById("option3").className = "";
    document.getElementById("option1").className = "";
    document.getElementById("option2").className = "";
    document.getElementById("option4").className = "selected";

    var html = "";
    html += "<h3>" + ((langue == "EN") ? "Please enter the settings required to remove choices" : "Veuiller entrer les paramètres requis pour supprimer les choix") + "</h3>";
    html += "<form action=\""+ routeResetChoice + "\" method=\"post\">";
    html += "<div>";
    html += "<table id='tabResetChoice'>";
    html += "<tr>";
    html += "<th>Alias</th>";
    html += "<th>Session</th>";
    html += "</tr>";
    html += "<tr>";
    html += "<td><select name='profList'>";
    html += "<option value='' selected></option>";
    for(var prof in ens)
    {
        html += "<option value='" + ens[prof].ens_id + "'>" + ens[prof].ens_alias + "</option>";
    }
    html += "<select></td>";
    html += "</td>";
    html += "<td><select name='sessionList'>";
    html += "<option value='' selected></option>";
    html += "<option value='1'>" +  ((langue == "EN") ? "Autumn" : "Automne")  + "</option>";
    html += "<option value='2'>" +  ((langue == "EN") ? "Winter" : "Hiver")  + "</option>";
    html += "<option value='3'>" +  ((langue == "EN") ? "Summer" : "Été")  + "</option>";
    html += "<select></td>";
    html += "</tr>";
    html += "</table>";
    html += "</div>";
    html += " </br> <input type='submit' value='" + ((langue == "EN") ? "Submit" : "Envoyer") + "'>";
    html += "</form>";
    document.getElementById("contentGestion").innerHTML = html;

    $.ajax({
        url: url,
        method: 'POST',
        complete: function (response) {
            console.log(response);
            $('#contentGestion').append(response.responseText);
        },
        error: function () {
            $('#contentGestion').html('error!');
        }
    });
}