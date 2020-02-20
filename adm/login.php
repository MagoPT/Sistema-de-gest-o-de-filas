<?php
require_once '../DB_config.php';
session_start();
session_destroy();
session_start();
if($_POST)
{

    $user_email 	= $_POST['email'];
    $user_password 	= $_POST['pass'];


    //password_hash see : http://www.php.net/manual/en/function.password-hash.php
    $password 	= hash('sha512', $user_password);
    try
    {
        $stmt = $db_con->prepare("SELECT * FROM medicos WHERE email='".$user_email."' and pass='".$password."'");
        $stmt->execute();
        $count = $stmt->rowCount();

        if($count==1){
            foreach ($stmt as $row) {
                $_SESSION["user"] = $row;
            }
                echo "logado";
                header("Location: /python_web/adm");
        }

            else
            {
                echo "<br>Email ou Pass incorreta<br>";
            }


    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}
else{
    header("Location: /python_web/adm/");
}
?>
