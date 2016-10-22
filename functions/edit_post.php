<?php
function edit_post($user_id, $post_id){
    $sql = "SELECT `ID`,`user_id`,`income`,`outgo` FROM `posts` WHERE user_id='".$user_id."' AND ID='".$post_id."'";
    return db_row($sql);
}