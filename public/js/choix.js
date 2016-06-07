window.onload = function() {
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
    if(choixFait.choixFait.A == false) {
        html += "<div ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\" id=\"fixer\" >";
        html += "<h1>" + ((langue == "EN") ? "Priorities" : "Priorités") + "</h1>";
        html += "<p id=\"01\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;1&nbsp;</p>";
        html += "<p id=\"02\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;2&nbsp;</p>";
        html += "<p id=\"03\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;3&nbsp;</p>";
        html += "<p id=\"04\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;4&nbsp;</p>";
        html += "<p id=\"05\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;5&nbsp;</p>";
        html += "</div>";
        html += "<form id=\"FormChoix\" name=\"FormChoix\" method=\"post\" action=\"" + RouteSubmit + "\">";
        html += "<input type=\"hidden\" value=\""+ ensId + "\" name=\"ensId\" readonly/>";
        html += "<h3>" + ((langue == "EN") ? "Please make you\'re courses choice." : "Veuillez faire vos choix de cours.") + "</h3>";
        html += "<table>";
        for(var i = 0; i < courses[1].length;i++)
        {
            html += "<tr>";
            html += "<td class=\"cours\">" + courses[1][i]["cou_no"] + " : " + courses[1][i]["cou_titre"] +"</td>";
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
        html += "<h3>" + ((langue == "EN") ? "Here are the you\'re choices." : "Voici vos choix de cours.") + "</h3>";
        html += "<table  id=\"tRes\">";
        html += "<tr>";
        html += "<th>" + ((langue == "EN") ? "Courses" : "Cours") + "</th>";
        html += "<th>" + ((langue == "EN") ? "Priorities" : "Priorités") + "</th>";
        html += "</tr>";
        for(var i = 0; i < tache[1].length;i++)
        {
            html += "<tr>";
            html += "<td class=\"cours\">" + tache[1][i]["cou_no"] + " : " + tache[1][i]["cou_titre"] +"</td>";
            html += "<td>" + tache[1][i]["chx_priorite"] +"</td>";
            html += "</tr>";
        }
        html += "</table>";
        html += "<br/>";
    }

    document.getElementById("contentChoix").innerHTML = html;
}

function ClickH() {
    document.getElementById("option2").className = "selected";
    document.getElementById("option1").className = "";
    document.getElementById("option3").className = "";

    var html = "";
    if(choixFait.choixFait.H == false) {
        html += "<div ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\" id=\"fixer\" >";
        html += "<h1>" + ((langue == "EN") ? "Priorities" : "Priorités") + "</h1>";
        html += "<p id=\"01\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;1&nbsp;</p>";
        html += "<p id=\"02\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;2&nbsp;</p>";
        html += "<p id=\"03\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;3&nbsp;</p>";
        html += "<p id=\"04\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;4&nbsp;</p>";
        html += "<p id=\"05\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;5&nbsp;</p>";
        html += "</div>";
        html += "<form id=\"FormChoix\" name=\"FormChoix\" method=\"post\" action=\"" + RouteSubmit + "\">";
        html += "<input type=\"hidden\" value=\""+ ensId + "\" name=\"ensId\" readonly/>";
        html += "<h3>" + ((langue == "EN") ? "Please make you\'re courses choice." : "Veuillez faire vos choix de cours.") + "</h3>";
        html += "<table>";
        for(var i = 0; i < courses[2].length;i++)
        {
            html += "<tr>";
            html += "<td class=\"cours\">" + courses[2][i]["cou_no"] + " : " + courses[2][i]["cou_titre"] +"</td>";
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
        html += "<h3>" + ((langue == "EN") ? "Here are the you\'re choices." : "Voici vos choix de cours.") + "</h3>";
        html += "<table  id=\"tRes\">";
        html += "<tr>";
        html += "<th>" + ((langue == "EN") ? "Courses" : "Cours") + "</th>";
        html += "<th>" + ((langue == "EN") ? "Priorities" : "Priorités") + "</th>";
        html += "</tr>";
        for(var i = 0; i < tache[2].length;i++)
        {
            html += "<tr>";
            html += "<td class=\"cours\">" + tache[2][i]["cou_no"] + " : " + tache[2][i]["cou_titre"] +"</td>";
            html += "<td>" + tache[2][i]["chx_priorite"] +"</td>";
            html += "</tr>";
        }
        html += "</table>";
        html += "<br/>";
    }

    document.getElementById("contentChoix").innerHTML = html;
}

function ClickE() {
    document.getElementById("option3").className = "selected";
    document.getElementById("option1").className = "";
    document.getElementById("option2").className = "";

    var html = "";
    if(choixFait.choixFait.E == false) {
        html += "<div ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\" id=\"fixer\" >";
        html += "<h1>" + ((langue == "EN") ? "Priorities" : "Priorités") + "</h1>";
        html += "<p id=\"01\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;1&nbsp;</p>";
        html += "<p id=\"02\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;2&nbsp;</p>";
        html += "<p id=\"03\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;3&nbsp;</p>";
        html += "<p id=\"04\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;4&nbsp;</p>";
        html += "<p id=\"05\" draggable=\"true\" ondragstart=\"drag(event)\">&nbsp;5&nbsp;</p>";
        html += "</div>";
        html += "<form id=\"FormChoix\" name=\"FormChoix\" method=\"post\" action=\"" + RouteSubmit + "\">";
        html += "<input type=\"hidden\" value=\""+ ensId + "\" name=\"ensId\" readonly/>";
        html += "<h3>" + ((langue == "EN") ? "Please make you\'re courses choice." : "Veuillez faire vos choix de cours.") + "</h3>";
        html += "<table>";
        for(var i = 0; i < courses[3].length;i++)
        {
            html += "<tr>";
            html += "<td class=\"cours\">" + courses[3][i]["cou_no"] + " : " + courses[3][i]["cou_titre"] +"</td>";
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
        html += "<h3>" + ((langue == "EN") ? "Here are the you\'re choices." : "Voici vos choix de cours.") + "</h3>";
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

    document.getElementById("contentChoix").innerHTML = html;
}