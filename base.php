<head>
    <link rel="stylesheet" href="assets/bootstrap/css/menu.css">
</head>


<div class="d-flex flex-column" style="border-style: dashed">
    <div style="font-size: xx-large">
        Clinica Geral
    </div>
    <div class="buttons">
        <div class="minus button">-</div>
        <div class="value">?</div>
        <div class="plus button">+</div>
    </div>
    <div class="state">
        <span class="users">?</span> online
    </div>
    <script>
        var minus = document.querySelector('.minus'),
            plus = document.querySelector('.plus'),
            value = document.querySelector('.value'),
            users = document.querySelector('.users'),
            websocket = new WebSocket("ws://192.168.1.72:6789/");
        minus.onclick = function (event) {
            websocket.send(JSON.stringify({action: 'minus'}));
        }
        plus.onclick = function (event) {
            websocket.send(JSON.stringify({action: 'plus'}));
        }
        websocket.onmessage = function (event) {
            data = JSON.parse(event.data);
            switch (data.type) {
                case 'state':
                    value.textContent = data.value;
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
    </script>
</div>