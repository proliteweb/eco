<?php
require_once "functions/proverki.php";
require_once "functions/path.php";
require_once "functions/DB.php";



//Залогиниваем
if($_POST["method_name"] === "auth"){
    $resDb = db_row("SELECT * FROM users WHERE name='".$_POST["name"]."' AND password='".md5($_POST["password"])."'", true )["item"];
    if(!$resDb){exit("Ощибка при работе с БД на строке ".__LINE__);}
    else{
        setcookie("ID", $resDb["ID"], strtotime("+1 day"));
        setcookie("token", $resDb["password"], strtotime("+1 day"));?>
        <script>window.location = "index.php"</script>
   <? }
}















