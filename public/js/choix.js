window.onload = function() {
    ArrayBilles = [];

    listFois = new Array();
    listBilles = new Array();

    for(var i = 0; i < cours.length;i++)
    {
        ArrayBilles[i] = [];
        ArrayBilles[i].titre = cours[i]["cou_titre"];
        ArrayBilles[i].no = cours[i]["cou_no"];
        ArrayBilles[i].maxBilles = 0;
        ArrayBilles[i].maxFois = 0;
        compte = 0;
        for(var j = 0; j < ens.length;j++)
        {
            ArrayBilles[i][compte] = [];
            ArrayBilles[i][compte].alias = ens[j]["ens_alias"];
            ArrayBilles[i][compte].id = ens[j]["ens_id"];
            if (cmptEtBilles[ens[j]["ens_alias"]] == null || cmptEtBilles[ens[j]["ens_alias"]]["cours"][cours[i]["cou_no"]] == null) {
                ArrayBilles[i][compte].billes = 0;
                ArrayBilles[i][compte].fois = 0;
            }
            else {
                ArrayBilles[i][compte].billes = cmptEtBilles[ens[j]["ens_alias"]]["cours"][cours[i]["cou_no"]].billes;
                ArrayBilles[i][compte].fois = cmptEtBilles[ens[j]["ens_alias"]]["cours"][cours[i]["cou_no"]].compteur;
                if(cmptEtBilles[ens[j]["ens_alias"]]["cours"][cours[i]["cou_no"]].billes > ArrayBilles[i].maxBilles)
                {
                    ArrayBilles[i].maxBilles = cmptEtBilles[ens[j]["ens_alias"]]["cours"][cours[i]["cou_no"]].billes;
                }

                if(cmptEtBilles[ens[j]["ens_alias"]]["cours"][cours[i]["cou_no"]].compteur > ArrayBilles[i].maxFois)
                {
                    ArrayBilles[i].maxFois = cmptEtBilles[ens[j]["ens_alias"]]["cours"][cours[i]["cou_no"]].compteur;
                }
            }
            compte++;
        }
    }
};

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();

    var data = ev.dataTransfer.getData("text");
    if(document.getElementById("temp" + data) != null) {
        document.getElementById("temp" + data).setAttribute("value", "");
        document.getElementById("temp" + data).setAttribute("id", "");
    }
    if(ev.target.innerHTML == "") {
        ev.target.appendChild(document.getElementById(data));
        document.getElementsByName(ev.target.id)[0].setAttribute("value", data);
        document.getElementsByName(ev.target.id)[0].setAttribute("id", "temp" + data);
    }else if(ev.target.getAttribute('id') == 'fixer')
    {
        ev.target.appendChild(document.getElementById(data));
    }
}

function ClickA() {
    document.getElementById("option1").className = "selected";
    document.getElementById("option2").className = "";
    document.getElementById("option3").className = "";

    var html = "";
    if(choixFait.choixFait.A == false && choixFait.taskClosed == false) {
        html += "<div ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\" id=\"fixer\" >";
        html += "<h1>" + ((langue == "EN") ? "Priorities" : "Priorités") + "</h1>";
        html += "<p id=\"01\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;1&nbsp;</p>";
        html += "<p id=\"02\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;2&nbsp;</p>";
        html += "<p id=\"03\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;3&nbsp;</p>";
        html += "<p id=\"04\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;4&nbsp;</p>";
        html += "<p id=\"05\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;5&nbsp;</p>";
        html += "</div>";
        html += "<div id=\"infoFixe\"><br/><p>" + ((langue == "EN") ? "Please click on a course to see the top 4." : "Veuillez clicker sur un cours pour voir le top 4.") + "</p></div>";
        html += "<form id=\"FormChoix\" name=\"FormChoix\" method=\"post\" action=\"" + RouteSubmit + "\">";
        html += "<input type=\"hidden\" value=\""+ ensId + "\" name=\"ensId\" readonly/>";
        html += "<h3>" + ((langue == "EN") ? "Please make your courses choice." : "Veuillez faire vos choix de cours.") + "</h3>";
        html += "<table>";
        html += "<th>" + ((langue == "EN") ? "Courses" : "Cours") + "</th>";
        html += "<th>" + ((langue == "EN") ? "Max Counter" : "Max Compteur") + "</th>";
        html += "<th>" + ((langue == "EN") ? "Max Marbles" : "Max Billes") + "</th>";
        html += "<th>" + ((langue == "EN") ? "Bid" : "Bid") + "</th>";
        for(var i = 0; i < courses[1].length;i++)
        {
            for(var k = 0; k < ArrayBilles.length;k++) {
                if(ArrayBilles[k].no == courses[1][i]["cou_no"])
                {
                    maxBilles = ArrayBilles[k].maxBilles;
                    maxFois = ArrayBilles[k].maxFois;
                    for(var j = 0; j < ArrayBilles[k].length;j++) {
                        if(ArrayBilles[k][j].id == ensId)
                        {
                            mesBilles = ArrayBilles[k][j].billes;
                            mesFois = ArrayBilles[k][j].fois;
                        }
                    }
                }
            }
            html += "<tr onclick='clickCours(\"" + courses[1][i]["cou_no"] + "\")' id='" + courses[1][i]["cou_no"] + "'>";
            html += "<td class=\"cours\">" + courses[1][i]["cou_no"] + " : " + courses[1][i]["cou_titre"] +"</td>";
            html += "<td>" + mesFois  + " / " +  maxFois + "</td>";
            html += "<td>" + mesBilles  + " / " +  maxBilles + "</td>";
            html += "<td class=\"divDrop\">";
            html += "<div id=\"" + courses[1][i]["cdn_id"] + "\" class=\"elements\"   ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"></div>";
            html += "<input type=\"text\" value=\"\"  name=\"" + courses[1][i]["cdn_id"] + "\"  hidden readonly/>";
            html += "</td>";
            html += "</tr>";
        }
        html += "</table>";
        html += "<br/>";
        html += "<input type=\"submit\" onclick=\"return confirm('" + ((langue == "EN") ? "Are you sure?" : "Etes-vous certain?") + "')\" value=\"" + ((langue == "EN") ? "Send" : "Envoyer") + "\">";
        html += "</form>";
    }else{
        if(choixFait.choixFait.A == false){
            html += "<h3>" + ((langue == "EN") ? "The task has been closed and your choices have not been completed." : "La tâche à été fermée et vos choix n\'ont pas été complétés.") + "</h3>";
        } else {
            html += "<h3>" + ((langue == "EN") ? "Here are your choices." : "Voici vos choix de cours.") + "</h3>";
            html += "<table  id=\"tRes\">";
            html += "<tr>";
            html += "<th>" + ((langue == "EN") ? "Courses" : "Cours") + "</th>";
            html += "<th>" + ((langue == "EN") ? "Priorities" : "Priorités") + "</th>";
            html += "</tr>";
            for (var i = 0; i < tache[1].length; i++) {
                html += "<tr>";
                html += "<td class=\"cours\">" + tache[1][i]["cou_no"] + " : " + tache[1][i]["cou_titre"] + "</td>";
                html += "<td>" + tache[1][i]["chx_priorite"] + "</td>";
                html += "</tr>";
            }
            html += "</table>";
            html += "<br/>";
        }
    }

    document.getElementById("contentChoix").innerHTML = html;
}

function ClickH() {
    document.getElementById("option2").className = "selected";
    document.getElementById("option1").className = "";
    document.getElementById("option3").className = "";

    var html = "";
    if(choixFait.choixFait.H == false && choixFait.taskClosed == false) {
        html += "<div ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\" id=\"fixer\" >";
        html += "<h1>" + ((langue == "EN") ? "Priorities" : "Priorités") + "</h1>";
        html += "<p id=\"01\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;1&nbsp;</p>";
        html += "<p id=\"02\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;2&nbsp;</p>";
        html += "<p id=\"03\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;3&nbsp;</p>";
        html += "<p id=\"04\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;4&nbsp;</p>";
        html += "<p id=\"05\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;5&nbsp;</p>";
        html += "</div>";
        html += "<div id=\"infoFixe\"><br/><p>" + ((langue == "EN") ? "Please click on a course to see the top 4." : "Veuillez clicker sur un cours pour voir le top 4.") + "</p></div>";
        html += "<form id=\"FormChoix\" name=\"FormChoix\" method=\"post\" action=\"" + RouteSubmit + "\">";
        html += "<input type=\"hidden\" value=\""+ ensId + "\" name=\"ensId\" readonly/>";
        html += "<h3>" + ((langue == "EN") ? "Please make your courses choice." : "Veuillez faire vos choix de cours.") + "</h3>";
        html += "<table>";
        html += "<th>" + ((langue == "EN") ? "Courses" : "Cours") + "</th>";
        html += "<th>" + ((langue == "EN") ? "Max Counter" : "Max Compteur") + "</th>";
        html += "<th>" + ((langue == "EN") ? "Max Marbles" : "Max Billes") + "</th>";
        html += "<th>" + ((langue == "EN") ? "Bid" : "Bid") + "</th>";
        for(var i = 0; i < courses[2].length;i++)
        {
            for(var k = 0; k < ArrayBilles.length;k++) {
                if(ArrayBilles[k].no == courses[2][i]["cou_no"])
                {
                    maxBilles = ArrayBilles[k].maxBilles;
                    maxFois = ArrayBilles[k].maxFois;
                    for(var j = 0; j < ArrayBilles[k].length;j++) {
                        if(ArrayBilles[k][j].id == ensId)
                        {
                            mesBilles = ArrayBilles[k][j].billes;
                            mesFois = ArrayBilles[k][j].fois;
                        }
                    }
                }
            }
            html += "<tr onclick='clickCours(\"" + courses[2][i]["cou_no"] + "\")' id='" + courses[2][i]["cou_no"] + "'>";
            html += "<td class=\"cours\">" + courses[2][i]["cou_no"] + " : " + courses[2][i]["cou_titre"] +"</td>";
            html += "<td>" + mesFois  + " / " +  maxFois + "</td>";
            html += "<td>" + mesBilles  + " / " +  maxBilles + "</td>";
            html += "<td class=\"divDrop\">";
            html += "<div id=\"" + courses[2][i]["cdn_id"] + "\" class=\"elements\"   ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"></div>";
            html += "<input type=\"text\" value=\"\"  name=\"" + courses[2][i]["cdn_id"] + "\"  hidden readonly/>";
            html += "</td>";
            html += "</tr>";
        }
        html += "</table>";
        html += "<br/>";
        html += "<input type=\"submit\" onclick=\"return confirm('" + ((langue == "EN") ? "Are you sure?" : "Etes-vous certain?") + "')\" value=\"" + ((langue == "EN") ? "Send" : "Envoyer") + "\">";
        html += "</form>";
    }else{
        if(choixFait.choixFait.H == false){
            html += "<h3>" + ((langue == "EN") ? "The task has been closed and your choices have not been completed." : "La tâche à été fermée et vos choix n\'ont pas été complétés.") + "</h3>";
        } else {
            html += "<h3>" + ((langue == "EN") ? "Here are the your choices." : "Voici vos choix de cours.") + "</h3>";
            html += "<table  id=\"tRes\">";
            html += "<tr>";
            html += "<th>" + ((langue == "EN") ? "Courses" : "Cours") + "</th>";
            html += "<th>" + ((langue == "EN") ? "Priorities" : "Priorités") + "</th>";
            html += "</tr>";
            for (var i = 0; i < tache[2].length; i++) {
                html += "<tr>";
                html += "<td class=\"cours\">" + tache[2][i]["cou_no"] + " : " + tache[2][i]["cou_titre"] + "</td>";
                html += "<td>" + tache[2][i]["chx_priorite"] + "</td>";
                html += "</tr>";
            }
            html += "</table>";
            html += "<br/>";
        }
    }

    document.getElementById("contentChoix").innerHTML = html;
}

function ClickE() {
    document.getElementById("option3").className = "selected";
    document.getElementById("option1").className = "";
    document.getElementById("option2").className = "";

    var html = "";
    if(choixFait.choixFait.E == false && choixFait.taskClosed == false) {
        html += "<div ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\" id=\"fixer\" >";
        html += "<h1>" + ((langue == "EN") ? "Priorities" : "Priorités") + "</h1>";
        html += "<p id=\"01\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;1&nbsp;</p>";
        html += "<p id=\"02\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;2&nbsp;</p>";
        html += "<p id=\"03\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;3&nbsp;</p>";
        html += "<p id=\"04\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;4&nbsp;</p>";
        html += "<p id=\"05\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;5&nbsp;</p>";
        html += "</div>";
        html += "<div id=\"infoFixe\"><br/><p>" + ((langue == "EN") ? "Please click on a course to see the top 4." : "Veuillez clicker sur un cours pour voir le top 4.") + "</p></div>";
        html += "<form id=\"FormChoix\" name=\"FormChoix\" method=\"post\" action=\"" + RouteSubmit + "\">";
        html += "<input type=\"hidden\" value=\""+ ensId + "\" name=\"ensId\" readonly/>";
        html += "<h3>" + ((langue == "EN") ? "Please make your courses choice." : "Veuillez faire vos choix de cours.") + "</h3>";
        html += "<table>";
        html += "<th>" + ((langue == "EN") ? "Courses" : "Cours") + "</th>";
        html += "<th>" + ((langue == "EN") ? "Max Counter" : "Max Compteur") + "</th>";
        html += "<th>" + ((langue == "EN") ? "Max Marbles" : "Max Billes") + "</th>";
        html += "<th>" + ((langue == "EN") ? "Bid" : "Bid") + "</th>";
        for(var i = 0; i < courses[3].length;i++)
        {
            for(var k = 0; k < ArrayBilles.length;k++) {
                if(ArrayBilles[k].no == courses[3][i]["cou_no"])
                {
                    maxBilles = ArrayBilles[k].maxBilles;
                    maxFois = ArrayBilles[k].maxFois;
                    for(var j = 0; j < ArrayBilles[k].length;j++) {
                        if(ArrayBilles[k][j].id == ensId)
                        {
                            mesBilles = ArrayBilles[k][j].billes;
                            mesFois = ArrayBilles[k][j].fois;
                        }
                    }
                }
            }
            html += "<tr onclick='clickCours(\"" + courses[3][i]["cou_no"] + "\")' id='" + courses[3][i]["cou_no"] + "'>";
            html += "<td class=\"cours\">" + courses[3][i]["cou_no"] + " : " + courses[3][i]["cou_titre"] +"</td>";
            html += "<td>" + mesFois  + " / " +  maxFois + "</td>";
            html += "<td>" + mesBilles  + " / " +  maxBilles + "</td>";
            html += "<td class=\"divDrop\">";
            html += "<div id=\"" + courses[3][i]["cdn_id"] + "\" class=\"elements\"   ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"></div>";
            html += "<input type=\"text\" value=\"\"  name=\"" + courses[3][i]["cdn_id"] + "\"  hidden readonly/>";
            html += "</td>";
            html += "</tr>";
        }
        html += "</table>";
        html += "<br/>";
        html += "<input type=\"submit\" onclick=\"return confirm('" + ((langue == "EN") ? "Are you sure?" : "Etes-vous certain?") + "')\" value=\"" + ((langue == "EN") ? "Send" : "Envoyer") + "\">";
        html += "</form>";
    }else{
        if(choixFait.choixFait.E == false){
            html += "<h3>" + ((langue == "EN") ? "The task has been closed and your choices have not been completed." : "La tâche à été fermée et vos choix n\'ont pas été complétés.") + "</h3>";
        } else {
            html += "<h3>" + ((langue == "EN") ? "Here are the your choices." : "Voici vos choix de cours.") + "</h3>";
            html += "<table  id=\"tRes\">";
            html += "<tr>";
            html += "<th>" + ((langue == "EN") ? "Courses" : "Cours") + "</th>";
            html += "<th>" + ((langue == "EN") ? "Priorities" : "Priorités") + "</th>";
            html += "</tr>";
            for(var i = 0; i < tache[3].length;i++)
            {
                html += "<tr>";
                html += "<td class=\"cours\">" + tache[3][i]["cou_no"] + " : " + tache[3][i]["cou_titre"] +"</td>";
                html += "<td>" + tache[3][i]["chx_priorite"] +"</td>";
                html += "</tr>";
            }
            html += "</table>";
            html += "<br/>";
        }
    }

    document.getElementById("contentChoix").innerHTML = html;
}

function clickCours(cId) {
    listBilles = [];
    listFois = [];    for (var i = 0; i < ArrayBilles.length; i++) {
        if (ArrayBilles[i].no == cId) {
            titre = ArrayBilles[i].titre;
            for (var j = 0; j < ArrayBilles[i].length; j++) {
                listFois.push({key: ArrayBilles[i][j].alias, val: ArrayBilles[i][j].fois});
                listBilles.push({key: ArrayBilles[i][j].alias, val: ArrayBilles[i][j].billes});
            }
        }
    }
    listFois.sort(function (a, b) {
        return b.val - a.val;
    });
    listBilles.sort(function (a, b) {
        return b.val - a.val;
    });

    var html = "";
    html += "<h1>Top 4 " + ((langue == "EN") ? "courses" : "cours") + "</h1>";
    html += "<h3>" + cId + "</h3>";
    html += "<h3>" + ((langue == "EN") ? "Counters:" : "Compteurs:") + "</h3>";
    for(var i = 0; i < 4;i++)
    {
        html += "<p>" + (i + 1) + ". " + listFois[i].key + " : " + listFois[i].val + "</p><br/>";
    }
    html += "<h3>" + ((langue == "EN") ? "Marbles:" : "Billes:") + "</h3>";
    for(var i = 0; i < 4;i++)
    {
        html += "<p>" + (i + 1) + ". " + listBilles[i].key + " : " + listBilles[i].val + "</p><br/>";
    }
    document.getElementById("infoFixe").innerHTML = html;

    $(".highLight").removeClass("highLight");
    document.getElementById(cId).className = "highLight";
}