var ip = "192.168.1.85";
var porta = "6788";
var medicoboss = 'Pedrão';
var script = document.createElement('script');
var som;

script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script)


function sound(src) {
    this.sound = document.createElement("audio");
    this.sound.src = src;
    this.sound.setAttribute("preload", "auto");
    this.sound.setAttribute("controls", "none");
    this.sound.style.display = "none";
    document.body.appendChild(this.sound);
    this.play = function(){
        this.sound.play();
    }
    this.stop = function(){
        this.sound.pause();
    }
}

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

function print(data) {
    var a ="";
    for (index = 0; index < data.ordem.length; index++) {
        a = a+ "<tr style='border-style: dotted'><td style='border-style: dotted'>"+data.ordem[index].senha+"</td><td style='border-style: dotted'>"+data.ordem[index].especialidade+"</td><td style='border-style: dotted'>"+data.ordem[index].nome+"</td></tr>"
    }
    return a;
}

function index() {

    var ger_total = document.querySelector('.ger_total'),
        ger_atual = document.querySelector('.ger_atual'),
        oft_total = document.querySelector('.oft_total'),
        oft_atual = document.querySelector('.oft_atual'),
        car_total = document.querySelector('.car_total'),
        car_atual = document.querySelector('.car_atual'),
        psi_total = document.querySelector('.psi_total'),
        psi_atual = document.querySelector('.psi_atual'),
        ordem = document.querySelector('.ordem'),
        users = document.querySelector('.users'),
        websocket = new WebSocket("ws://" + ip + ":" + porta + "/");
        websocket.onmessage = function (event) {
        data = JSON.parse(event.data);
        som = new sound(data.som);
        switch (data.type) {
            case 'state':

                ger_total.textContent = data.total_geral;
                ger_atual.textContent = data.atual_geral;
                oft_total.textContent = data.total_oftalmologista;
                oft_atual.textContent = data.atual_oftalmologista;
                car_total.textContent = data.total_cardiologia;
                car_atual.textContent = data.atual_cardiologia;
                psi_total.textContent = data.total_psicologia;
                psi_atual.textContent = data.atual_psicologia;
                psi_total.textContent = data.total_psicologia;
                ordem.innerHTML="<tr style='border-style: dashed'>\n" +
                    "                    <th style='padding-right: 25px;border-style: dashed'>Senha</th>\n" +
                    "                    <th style='padding-right: 25px;border-style: dashed'>Especialidade</th>\n" +
                    "                    <th style='padding-right: 25px;border-style: dashed'>Médico</th>\n" +
                    "                </tr>" + print(data);
                var cor = "#0af";
                for (i = 0; i <= 4; i++) {
                    if (cor == "#0af") {
                        cor = "#a34"
                    } else {
                        cor = "#0af"
                    }
                    ;
                    if ((data.atual - parseInt(i)) > 0) {
                            document.getElementById("fila").innerHTML += "<tr style='text-align: center; color: " + cor + "'><td style='border-style: dashed'>" + (data.atual - parseInt(i)) + "</td><td style='border-style: dashed; text-align: center'>"+data.especialidade+"</td><td style='border-style: dashed'>" + data.medico + "</td></tr>";
                    }
                }
                som.play();
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
    var ger_plus = document.querySelector('.ger_plus'),
        oft_plus = document.querySelector('.oft_plus'),
        car_plus = document.querySelector('.car_plus'),
        psi_plus = document.querySelector('.psi_plus'),
        users = document.querySelector('.users'),
        websocket = new WebSocket("ws://" + ip + ":" + porta + "/");
        ger_plus.onclick = function (event) {
            websocket.send(JSON.stringify({action: 'senha', esp: 'ger'}));
        }
        oft_plus.onclick = function (event) {
            websocket.send(JSON.stringify({action: 'senha', esp: 'oft'}));
        }
        car_plus.onclick = function (event) {
            websocket.send(JSON.stringify({action: 'senha', esp: 'car'}));
        }
        psi_plus.onclick = function (event) {
            websocket.send(JSON.stringify({action: 'senha', esp: 'psi'}));
        }
    websocket.onmessage = function (event) {
        data = JSON.parse(event.data);
        if (data.last=="ger"){
            alert("A sua senha é: GER_"+data.total_geral)
        }
        else if (data.last=="oft"){
            alert("A sua senha é: OFT_"+data.total_oftalmologista)
        }
        else if (data.last=="car"){
            alert("A sua senha é: CAR_"+data.total_cardiologia)
        }
        else if (data.last=="psi"){
            alert("A sua senha é: PSI_"+data.total_psicologia)
        }
        switch (data.type) {
            case 'state':
                //value.textContent = data.total;
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
        espez = document.cookie.match('especializacao' + '=([^;]*)'),
        medico = document.cookie.match('medico' + '=([^;]*)'),
        websocket = new WebSocket("ws://" + ip + ":" + porta + "/");
        console.log(espez[1]);
        plus.onclick = function (event) {
            websocket.send(JSON.stringify({action: 'proximo', esp: espez[1],"medico":medico[1]}));
        }
    websocket.onmessage = function (event) {
        data = JSON.parse(event.data);
        switch (data.type) {
            case 'state':
                //value.textContent = data.atual;
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
    var newUrl = '/python_web/adm/reg/logout.php';
    location.href=newUrl;
}

function online(user) {
    console.log(user);

}

function index_adm() {
    var total = document.querySelector('.total'),
        atual = document.querySelector('.atual'),
        tamanho = document.querySelector('.tamanho'),
        users = document.querySelector('.users'),
        espez = document.cookie.match('especializacao' + '=([^;]*)'),
        websocket = new WebSocket("ws://" + ip + ":" + porta + "/");
        websocket.onmessage = function (event) {
        data = JSON.parse(event.data);
        switch (data.type) {
            case 'state':
               if (espez[1] == 'Geral'){
                    total.textContent = data.total_geral;
                    atual.textContent = data.atual_geral;
                    tamanho.textContent = (data.total_geral - data.atual_geral);
               }
                else if (espez[1] == 'Oftalmologista'){
                   total.textContent = data.total_oftalmologista;
                   atual.textContent = data.atual_oftalmologista;
                   tamanho.textContent = (data.total_geral - data.atual_geral);
               }
                else if (espez[1] == 'Cardiologia'){
                   total.textContent = data.total_cardiologia;
                   atual.textContent = data.atual_cardiologia;
                   tamanho.textContent = (data.total_cardiologia - data.atual_cardiologia);
               }
                else if (espez[1] == 'Psicologia'){
                   total.textContent = data.total_psicologia;
                   atual.textContent = data.atual_psicologia;
                   tamanho.textContent = (data.total_psicologia - data.atual_psicologia);
               }

                status = data;
                var status = data['status'];
                console.log(status);
                if(status=='error'){
                    alert('Não há mais senhas na fila');
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