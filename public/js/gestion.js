function clickopt1() {
    document.getElementById("option1").className = "selected";
    document.getElementById("option2").className = "";
    document.getElementById("option3").className = "";
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