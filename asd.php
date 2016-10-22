<?php
require_once "functions/DB.php";
require_once "functions/auth.php";

$table = "posts";
//
//$user_id = ($_COOKIE["ID"]) ? $_COOKIE["ID"] : null;

for($i = 0; $i <= 200000; $i++){
    $date = mktime();
    $income = rand(0, 999);
    $outgo = rand(0, 999);
    $user_id = rand(1, 99);

    $array = [
        "date"=>$date
        ,"user_id"=>$user_id
        ,"income"=>$income
        ,"outgo"=>$outgo
    ];

    $query = db_insert($table,$array);
    unset($array);
}
