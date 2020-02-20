var ip = "127.0.0.1";
var porta = "6789";
var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script)

function login() {
    $.ajax({
        type: "POST",
        url: '/adm/login.php',
        data: {
            email: $("#email").val(),
            pass: $("#pass").val()
        },
        success: function (data) {
            if (data === 'Login') {
                window.location.replace('/user/');
            } else {
                alert('Invalid Credentials');
            }
        }
    });

}

function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
};

function relogio() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('relogio').innerHTML =
        h + ":" + m + ":" + s;
    var t = setTimeout(relogio, 500);
}

function index() {
    var total = document.querySelector('.total'),
        total2 = document.querySelector('.total2'),
        atual = document.querySelector('.atual'),
        tamanho = document.querySelector('.tamanho'),
        users = document.querySelector('.users'),
        websocket = new WebSocket("ws://" + ip + ":" + porta + "/");
    websocket.onmessage = function (event) {
        data = JSON.parse(event.data);
        switch (data.type) {
            case 'state':
                total.textContent = data.total;
                //total2.textContent = data.atual;
                atual.textContent = data.atual;
                console.log(data);
                tamanho.textContent = (data.total - data.atual);
                var cor = "#0af";
                for (i = 0; i <= 4; i++) {
                    if (cor == "#0af") {
                        cor = "#a34"
                    } else {
                        cor = "#0af"
                    }
                    ;
                    if ((data.atual - parseInt(i)) > 0) {
                        document.getElementById("fila").innerHTML += "<tr style='text-align: center; color: " + cor + "'><td style='border-style: dashed'>" + (data.atual - parseInt(i)) + "</td><td style='border-style: dashed; text-align: center'>A</td></tr>";
                    }
                }
                break;
            case 'users':
                users.textContent = (
                    data.count.toString() + " Terminal" +
                    (data.count == 1 ? "" : "s"));
                break;
            default:
                console.error(
                    "unsupported event", data);
        }
    };
}

function senha() {
    var plus = document.querySelector('.plus'),
        users = document.querySelector('.users'),
        websocket = new WebSocket("ws://" + ip + ":" + porta + "/");
    plus.onclick = function (event) {
        websocket.send(JSON.stringify({action: 'senha', medico:'das'}));
    }
    websocket.onmessage = function (event) {
        data = JSON.parse(event.data);
        switch (data.type) {
            case 'state':
                value.textContent = data.total;
                break;
            case 'users':
                users.textContent = (
                    data.count.toString() + " Terminal" +
                    (data.count == 1 ? "" : "s"));
                break;
            default:
                console.error(
                    "unsupported event", data);
        }
    };
}

function adm() {
    var plus = document.querySelector('.plus'),
        value = document.querySelector('.value'),
        users = document.querySelector('.users'),
        websocket = new WebSocket("ws://" + ip + ":" + porta + "/");
    plus.onclick = function (event) {
        websocket.send(JSON.stringify({action: 'proximo'}));
    }
    websocket.onmessage = function (event) {
        data = JSON.parse(event.data);
        switch (data.type) {
            case 'state':
                value.textContent = data.atual;
                break;
            case 'users':
                users.textContent = (
                    data.count.toString() + " Terminal" +
                    (data.count == 1 ? "" : "s"));
                break;
            default:
                console.error(
                    "unsupported event", data);
        }
    };
}

function logout() {
    var newUrl = 'http://magopt-notebook.local/python_web/adm/reg/logout.php';
    location.href=newUrl;
}

function online(user) {
    console.log(user);

}