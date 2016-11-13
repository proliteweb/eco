<?php
require_once "functions/DB.php";
require_once "functions/proverki.php";
require_once "functions/path.php";


//Залогиниваем
if($_POST["method_name"] === "auth"){
    $name = ($_POST['name']) ? proverka1(trim($_POST['name'])) : null;
    $password = ($_POST['password']) ? proverka1( md5 (trim($_POST['password']) ) ) : null;

    $resDb = db_row("SELECT * FROM users WHERE name='".$name."' AND password='".$password."'", true )["item"];
    //Если результат true, то все 200 ОК )
//    var_dump($resDb);
    echo $password;
    if($resDb['name'] === $name AND $resDb['password'] === $password){
        var_dump($resDb);
    }
}