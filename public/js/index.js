const thebtn = document.querySelector("#toogle-btn");

thebtn.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("expand");
});

function changeReadonly() {
    var x = document.getElementById("nomor_hp");
    var y = document.getElementById("email");
    var btn = document.getElementById("sv-btn");
    if (x.readOnly === true && y.readOnly === true) {
        x.readOnly = false;
        y.readOnly = false;
        btn.style.display = "block";
    } else {
        x.readOnly = true;
        y.readOnly = true;
        btn.style.display = "none";
    }
}
