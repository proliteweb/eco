<?php
function logout_user(){
    setcookie('ID', $_COOKIE['ID'], strtotime("-1 week"));
    setcookie('token', $_COOKIE['password'], strtotime("-1 week"));
    echo "<script>window.location = 'index.php'</script>";
}