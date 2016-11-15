<?php
require_once "functions/DB.php";
require_once "functions/proverki.php";
require_once "functions/path.php";
require_once "functions/cookies.php";


//TODO сделать проверку имени и пароля через preg_match
//TODO зарегать и поставить куки через JS, и редирект по setTimeOut

//Регистрируем

if($_POST["method_name"] === "register" AND !empty($_POST["method_name"])){
    $for_return = [];

    $name = ( preg_match("/^[a-zА-я]+$/i", $_POST['name']) ) ? proverka1( trim($_POST['name']) ) : $for_return['error']= "Должны быть только латиница или кирилица в ".$_POST['name'];
    $email = (filter_var($_POST['email'])) ? trim($_POST['email']) : $for_return['error'] = "Не правильный формат Email ".$_POST['email'];
    $password = (preg_match("/^[0-9a-z]+$/i", $_POST['password'])) ? md5( proverka1 (trim($_POST['password']) ) ) : $for_return['error'] = "Не допустимые символы в пароле ".$_POST['password'] ;

//    $resDb = db_row("SELECT * FROM users WHERE name='".$name."' AND token='".$password."'", true )["item"];

//    if($resDb['name'] !== $name OR $resDb['token'] !== $password){
//        $for_return['error'] = "Не правильный логин или пароль!";
//    }
    //Если все ОК , то формируем данные для куки)
//    else{
//        $arr_names = [
//            0=>"ID"
//            ,1=>"token"
//        ];
//        $for_return = set_cookie_ajax($arr_names, $resDb);
//    }//endif
    //возвращаем результат
    $for_return = json_encode($for_return);
    echo $for_return;
}

?>