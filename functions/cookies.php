<?php

/**
 * Формирует данные для отправки кук как JSON, для AJAX
 * @param $arr_names - массив имен куки
 * @param $arr_db_data - массив результата выборки данных одного пользователя из БД
 * @return array
 */
function set_cookie_ajax($arr_names, $arr_db_data){
    //временная метка с датой истечения срока жизни куки
    $exp_date = strtotime(" + 1 week");
    $result = [];

    for($i = 0; $i <= count($arr_names); $i++){
        $result[$i] = [
            "name"=>$arr_names[$i]
            ,"value"=>$arr_db_data[$arr_names[$i]]
            , "exp_y"=>date("Y",$exp_date)
            , "exp_m"=>date("m",$exp_date)
            , "exp_d"=>date("d",$exp_date)
            , "path"=>"/"
            , "domain"=>$_SERVER['HTTP_HOST']
        ];
    }

    return $result;
}