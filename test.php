<?php
require_once "functions/DB.php";
require_once "functions/proverki.php";
require_once "functions/path.php";
require_once "functions/cookies.php";



//Залогиниваем
if($_GET["method_name"] === "auth"){
    $for_return = [];
    $email = (filter_var( $_GET['email'], FILTER_VALIDATE_EMAIL) ) ? $_GET['email'] : null;
    $password = ($_GET['password']) ? md5( proverka1 (trim($_GET['password']) ) ) : null;

    $resDb = db_row("SELECT * FROM users WHERE email='".$email."' AND token='".$password."'", true )["item"];
//    $for_return['error'] = $email.$password;

    if($resDb['email'] !== $email OR $resDb['token'] !== $password){
        $for_return['error'] = "Не правильный логин или пароль!";
    }
    //Если все ОК , то формируем данные для куки)
    else{
        $arr_names = [
            0=>"ID"
            ,1=>"token"
        ];
        $for_return = set_cookie_ajax($arr_names, $resDb);
    }//endif
    //возвращаем результат
    $for_return = json_encode($for_return);
    echo $for_return;
}