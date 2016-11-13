<?php
require_once "functions/proverki.php";
require_once "functions/path.php";
require_once "functions/DB.php";


//TODO сделать проверку имени и пароля через preg_match
//TODO зарегать и поставить куки через JS, и редирект по setTimeOut
//Регистрируем
$data = array();
if($_POST["method_name"] === "register"){
    $username = (isset($_POST["name"]))? trim(proverka1($_POST["name"])) : null;
    $password = (isset($_POST["password"])) ? md5(trim(proverka1($_POST["password"]))) : null;
    $email = filter_var(strtolower($_POST["email"]), FILTER_VALIDATE_EMAIL);
    //если один из параметров не верный, возвращаем false
    if(!$username || !$password || !$email){
        $data["authed"] = false;
    }else{
        $resDb = db_insert("users", ["name"=>$username, "password"=>$password, "email"=>$email], true);
        setcookie('ID', $resDb["ID"], strtotime("+1 week"));
        setcookie('token', $password, strtotime("+1 week"));
        $redirect = true;
    }
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
</head>
<body>
<? if($redirect){echo "<script>window.location = 'index.php';</script>"; }?>
</body>
</html>