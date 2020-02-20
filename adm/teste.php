<html>
<head>
    <title>Login</title>
    <style>

         .x {
            background: #fff;
            width: 475px;
            width: 35%;
            height: 46%;
            padding-left: 2%;
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-height: 200px;
            background-size: auto 100%;
            background-height: no-repeat;
            opacity: 10%;
        }
        .z {
            background: #fff;
            width: 475px;
            width: 35%;
            height: 46%;
            padding-left: 2%;
            position: absolute;
            top: 45%;
            left: 23%;
            font-size: medium;
            transform: translate(-50%, -50%);
            opacity: 1;

        }
        .opacity {
            opacity: 100%;
        }
        .opcaity > .x{
            opacity: 100%;
        }


        form {
            display: table;
        }

        p {
            display: table-row;
        }

        label {
            display: table-cell;
        }

        input {
            display: table-cell;
        }



    </style>
</head>
<body style="width: auto; background-image: url('../img/wallpaper.jpg'); max-height: 1080px; max-width: 1080px ">
<div style="height: 100%">
    <div class="x">
        <div class="z opacity">
            <form action="logado/index.php" id="form1" method="post">
                <p style="align-self: end" class="opacity">
                    <label>Email: </label>
                    <input type="text" name="email"><br/><br>
                </p>
                <p>
                    <label>Pass: </label>
                    <input type="password" name="pass"><br/>
                </p>
                <p>
                    <input type="submit" value="Entrar">
                </p>
            </form>
        </div>
    </div>
</div>
</body>
</html>