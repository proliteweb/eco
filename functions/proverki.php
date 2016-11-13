<?php
require_once "DB.php";

//Функции для разного уровня экранирования
/**
 * Максимальный экран
 * @param $str
 * @return string
 */
function proverka1($str){
    $str = htmlspecialchars($str);
    $str = addslashes($str);
    $str = strip_tags($str);

    return $str;
}

/**
 * Малое экранирование, для админ раздела
 * @param $str
 * @return string
 */
function proverka2($str){
//    $str = htmlspecialchars($str);
    $str = addslashes($str);

    return $str;
}

function sql_send_filter($string){
    global $DB;
    $string = $DB->real_escape_string($string);
    return $string;
}
