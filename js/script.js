var api_www_address = "/sprawdzarka/api/";
String.prototype.hashCode = function() {
    var hash = 0,
        i, chr;
    if (this.length === 0) return hash;
    for (i = 0; i < this.length; i++) {
        chr = this.charCodeAt(i);
        hash = ((hash << 5) - hash) + chr;
        hash |= 0;
    }
    return hash;
};

function getcolor(pkt) {
    if (pkt < 0)
        return "#fff";
    if (pkt == 0)
        return "rgba(255,0,0,0.8)";
    if (pkt < 100)
        return "rgba(255,255,0,0.8)";
    return "rgba(0,255,0,0.8)";
}

function entity(str) {
    return str.replace(/[\u00A0-\u9999<>\&]/gim, function(i) {
        return '&#' + i.charCodeAt(0) + ';';
    });
}

function get(file, params, todo, error) {
    args = "";
    for (b in params)
        args += "&" + b + "=" + encodeURIComponent(params[b]);
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", api_www_address + file + ".php?" + args, true);
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if (data.query == 0) {
                if (data.error == -1)
                    alert("Błąd bazy danych");
                else if (data.error == -2) {
                    alert("Zaloguj się ponownie");
                    localStorage = {};
                    window.location.href = '/sprawdzarka/';
                } else if (data.error < 0)
                    alert("Nieznany błąd");
                else
                    alert(error[data.error - 1]);
            } else
                todo(data);
        } else if (this.readyState == 4)
            document.getElementsByClassName("main-head")[0].style.background = "rgba(255,0,0,0.8)";
    };
    xhttp.timeout = 2000;
    xhttp.send();
}