function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    if(ev.target.innerHTML === "") {
        ev.target.appendChild(document.getElementById(data));
        document.getElementsByName(ev.target.getAttribute("id"))[0].setAttribute("value", data);
    }else if(ev.target.getAttribute('id') == 'fixer')
    {
        ev.target.appendChild(document.getElementById(data));

    }
}