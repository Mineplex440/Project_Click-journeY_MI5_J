function Dat () {
    var date = new Date();
    var sec = date.getSeconds();
    var div = document.getElementById("date");
    div.innerHTML = sec + "s" ;
}

var Myvar = setInterval(Dat, 100);
