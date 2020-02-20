<?php
require_once '../../DB_config.php';

if($_POST)
{
    $user_nome 		=  $_POST['nome'];
    $user_apelido 		= $_POST['apelido'];
    $user_email 	= $_POST['email'];
    $user_especialidade 	= $_POST['especialidade'];
    $user_password 	= $_POST['pass'];
    $joining_date 	= date('Y-m-d H:i:s');

    //password_hash see : http://www.php.net/manual/en/function.password-hash.php
    $password 	= hash('sha512', $user_password );
    try
    {
        $stmt = $db_con->prepare("SELECT * FROM medicos WHERE email=:email");
        $stmt->execute(array(":email"=>$user_email));
        $count = $stmt->rowCount();

        if($count==0){
            $stmt = $db_con->prepare("INSERT INTO medicos(nome,apelido,pass,email,especializacao,registo) VALUES(:nome, :apelido, :pass, :email, :especialidade, :jdate)");
            $stmt->bindParam(":nome",$user_nome);
            $stmt->bindParam(":apelido",$user_apelido);
            $stmt->bindParam(":email",$user_email);
            $stmt->bindParam(":especialidade",$user_especialidade);
            $stmt->bindParam(":pass",$password);
            $stmt->bindParam(":jdate",$joining_date);
            if($stmt->execute())
            {
                echo "registered";
                header("Location: /python_web/adm/");
            }
            else
            {
                echo "Query could not execute !";
            }

        }
        else{

            echo "1"; //  not available
        }

    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}
else{
    header("Location: /python_web/adm/reg/");
}
?>
