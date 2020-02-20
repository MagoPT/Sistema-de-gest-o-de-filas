<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/bootstrap/css/menu.css">-->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="relogio.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="functions.js"></script>
</head>

<body id="page-top" onload="relogio()">
<div id="wrapper">
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
        <div class="container-fluid d-flex flex-column p-0">
            <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="../../..">
                <div class="sidebar-brand-icon"><i class="fas fa-hospital"></i></div>
                <div class="sidebar-brand-text mx-3"><span>Hospital MagoPT</span></div>
            </a>
            <hr class="sidebar-divider my-0">
            <ul class="nav navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item" role="presentation"><a class="nav-link active" href=""><i
                                class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="senha/"><i
                                class="fas fa-plus-circle"></i><span>Retirar senha</span></a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="adm"><i
                                class="fas fa-file-medical"></i><span>Administração</span></a></li>
                <?php
                session_start();
                if (isset($_SESSION["user"])) {
                    $user = $_SESSION["user"];
                    $nome = $user['nome'];
                    echo "<li class='nav-item' role='presentation' onclick='logout()'><a class='nav-link' ><i class='fas fa-sign-out-alt'></i><span >Logout</span></a></li>";
                }
                ?>

            </ul>
            <div class="text-center d-none d-md-inline">
                <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
            </div>
            <div class="text-center d-none d-md-inline">
                <a id="relogio" class="relogio">?</a>
            </div>
        </div>
    </nav>
    <div class="d-flex flex-column"
         style="align-items:center; padding-left: 55px; padding-top: 25px; border-style: dashed">
        <div style="border-style: solid; font-size: xx-large">
            Clinica Geral
        </div>
        <div class="buttons"
             style="padding-inline: 5px; padding-top: 15px;font-size: 30px; align-content: center; display: inline-block">
            <a class="value" style="border-style: dashed"> Senhas totais: <e class="total">?</e></a>
            <a class="value" style="border-style: solid"> Senha atual: <e class="atual">?</e></a>
        </div>
        <div style="padding-inline: 5px; padding-top: 15px;font-size: 30px; align-content: center; display: inline-block">
            <a class="value" style="border-style: solid"> Tamanho da fila atual: <e class="tamanho">?</e></a>
        </div>
        <div class="state">
            <span class="users">?</span> online
        </div>
        <div>
            <table style="font-size: xx-large" id="fila">
                <tr>
                    <th style="padding-right: 25px">Senha</th>
                    <th sstyle="padding-right: 25px">Balcão</th>
                </tr>
                <script> index()</script>
            </table>
        </div>

    </div>

</div>

<a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="assets/js/theme.js"></script>
</body>
</html>
