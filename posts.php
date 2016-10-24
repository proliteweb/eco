<?php
//данный скрит отвечает за добавление постов,  их обновление и удаление в БД
require_once "functions/auth.php";
require_once "functions/DB.php";
$table = "posts";

$authed = is_auth();
if(!$authed){
    header("Location: index.php");
}

$user_id = ($_COOKIE["ID"]) ? $_COOKIE["ID"] : null;
//$date = mktime();
$income = (is_numeric($_POST["add_income"])) ? $_POST["add_income"] : null;
$outgo = (is_numeric($_POST["add_outgo"])) ? $_POST["add_outgo"] : null;
$post_id = $_POST['post_id'];
$where = "user_id='".$user_id."' AND ID='".$post_id."'";

//Добавление
if( isset($_POST["submit"]) && $_POST["method_name"] === "add" ){
    $array = [
        "date"=>"NOW()"
        ,"user_id"=>$user_id
        ,"income"=>$income
        ,"outgo"=>$outgo
    ];
    $query = db_insert($table,$array, true );
}


//Обновление
if( isset($_POST["submit"]) && $_POST["method_name"] === "edit" ){
     $array = [
        "date"=>$date
        ,"income"=>$income
        ,"outgo"=>$outgo
    ];
    $query = db_update($table,$array, $where, true );
    if($query){
        header("Location: http://".$_SERVER['HTTP_HOST']);
    }
}


////Удаление
//if(is_numeric($_GET['delete_post'])){
//    db_delete($table, $where, true);
//    header("Location:".$_SERVER['HTTP_REFERER']);
//}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление записи</title>
</head>
<body>
<script>window.location = "index.php"</script>


</body>
</html>