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