<?php
require_once "functions/DB.php";
require_once "functions/proverki.php";
require_once "functions/path.php";


//Залогиниваем
if($_POST["method_name"] === "auth"){
    $for_return = [];
    $name = ($_POST['name']) ? proverka1(trim($_POST['name'])) : null;
    $password = ($_POST['password']) ? md5( proverka1 (trim($_POST['password']) ) ) : null;

    $resDb = db_row("SELECT * FROM users WHERE name='".$name."' AND password='".$password."'", true )["item"];

    if($resDb['name'] !== $name OR $resDb['password'] !== $password){
        $for_return['error'] = "Не правильный логин или пароль!";
    }
    //Если все ОК , то формируем данные для куки)
    else{
        //временная метка с датой истечения срока жизни куки
        $exp_date = strtotime(" + 1 week");

        //формируем данные для отправки cookie через AJAX
        //TODO оптимизировать формировку данных, возможно написать функцию
        $for_return = [
            ["name"=>"ID"
                , "value"=>$resDb['ID']
                , "exp_y"=>date("Y",$exp_date)
                , "exp_m"=>date("m",$exp_date)
                , "exp_d"=>date("d",$exp_date)
                ,"path"=>"/"
                , "domain"=>$_SERVER['HTTP_HOST']
            ]
            ,["name"=>"token"
                , "value"=>$resDb['password']
                , "exp_y"=>date("Y",$exp_date)
                , "exp_m"=>date("m",$exp_date)
                , "exp_d"=>date("d",$exp_date)
                ,"path"=>"/"
                , "domain"=>$_SERVER['HTTP_HOST']
            ]
        ];
    }//endif
    //возвращаем результат
    $for_return = json_encode($for_return);
    echo $for_return;
}












