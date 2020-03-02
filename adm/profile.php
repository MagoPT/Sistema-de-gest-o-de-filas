<!DOCTYPE html>
<html>
<?php
session_start();
$user = $_SESSION["user"];
$nome = $user['nome'];
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Administração - <?= $nome ?></title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/bootstrap/css/menu.css">-->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../relogio.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="../functions.js"></script>
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
                <li class="nav-item" role="presentation"><a class="nav-link " href="../"><i
                                class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="../senha/"><i
                                class="fas fa-plus-circle"></i><span>Retirar senha</span></a></li>
                <li class="nav-item" role="presentation"><a class="nav-link active" href=" "><i
                                class="fas fa-file-medical"></i><span>Administração</span></a></li>
                <?php
                session_start();
                if (isset($_SESSION["user"])) {
                    echo "<li class='nav-item medico' role='presentation' onclick='logout()'><a class='nav-link' ><i class='fas fa-sign-out-alt'></i><span >Logout</span></a></li>";
                }
                ?>
                <script type="text/javascript">
                    document.cookie = "especializacao=<?php echo $user['especializacao'] ?>";
                    document.cookie = "medico=<?php echo $user['nome']." ".$user['apelido'] ?>";
                </script>
            </ul>
            <div class="text-center d-none d-md-inline">
                <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
            </div>
            <div class="text-center d-none d-md-inline">
                <a id="relogio" class="relogio">?</a>
            </div>
        </div>
    </nav>
    <div style="align-items:center; padding-left: 55px; padding-top: 25px; padding-bottom: 25px; text-align: left">
        <div style="font-size: 50px; font-weight: bold; text-align: left" class="medico">
           <?= 'Médico: ' . $user['nome'] . ' ' . $user['apelido'] ?>
        </div>
        <br>
        <div style="font-size: 50px; font-weight: bold; text-align: left">
            <?= 'Especialidade: <a id="especializacao"> ' . $user['especializacao'].'</a>' ?>
        </div>
        <hr>
        <div>
            <table style="font-size: 45px; align-content: center">
                <tr>
                    <th style="border-style:dashed; padding-right: 20px; padding-left: 20px; text-align: center ">Total de senhas</th>
                    <th style="border-style:dashed; padding-left: 20px; padding-right: 20px; text-align: center">Senha atual</th>
                </tr>
                <tr>
                    <td style="border-style:dashed; padding-right: 20px; text-align: center " class="total">?</td>
                    <td style="border-style:dashed; padding-left: 20px; text-align: center" class="atual">?</td>
                </tr>
                <tr>
                    <th colspan="2" style="border-style: dashed; text-align: center;">Tamanho da fila</th>
                </tr>
                <tr>
                    <td colspan="2" style="border-style: dashed; text-align: center" class="tamanho">?</td>
                </tr>
                <tr>
                    <td colspan="2" style="border-style: dashed; text-align: center;background-color: #4e73df;" class="plus"><a style="color: black">+</a></td>
                </tr>
            </table>
        </div>
        <script>adm()</script>
        <footer style="text-align: center" class="state">
            <span style="text-align: center" class="users">?</span> online
            <script>
                status = index_adm();
                console.log(status);
            </script>
        </footer>
    </div>

</div>

<a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="../assets/js/theme.js"></script>
</body>

</html>
