<?php
require_once "functions/path.php";
require_once "functions/auth.php";//DB & proverki
require_once "functions/edit_post.php";

$edit_post_data = null;//данные для редактирования поста
$this_page = path_withoutGet();
$authed = is_auth();
//TODO переместить удаление постов в posts.php и сделать через AJAX
$post_id = $_POST['post_id'];
$user_id = ($_COOKIE["ID"]) ? $_COOKIE["ID"] : null;

//Данные через GET
if($_GET['logout'] == 1){
    require_once "functions/logout.php";
    logout_user();
}
if($_GET['method']=='edit' && $_GET['edit_post']){
    $edit_post_data = edit_post($_COOKIE['ID'], $_GET['edit_post']);
}
//Удаление поста
if(is_numeric($_GET['delete_post'])){
    $res_delete = db_delete("posts", "user_id='".$user_id."' AND ID='".$_GET['delete_post']."' ", true);
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Менеджер расходов</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">
    <header id="header">
        <div class="container">
            <div class="white clear">
                <div class="logo"><a href="/">ECO</a></div>
                <div class="userAuth clear mt20">
                    <?php if(!$authed):?>
                    <!--   авторизация-->
                    <div class="login dib">
<!--                        <a href="#" class="button">Войдите</a>-->
                        <div id="auth" class="">
                            <form  method="post" action="login.php">
                                <input type="hidden" name="method_name" value="auth">
                                <input type="text" name="name" placeholder="Имя" required="required">
                                <input type="password" name="password" placeholder="пароль" required="required">
                                <div class="submit">
                                    <button>Вперед</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <span class="dib"> или </span>
                    <!--                регистрация-->
                    <div class="register dib">
                        <a href="#" class="button">Зарегистрируйтесь</a>
                        <div id="register" class="dropdown">
                            <form  method="post" action="register.php">
                                <input type="hidden" name="method_name" value="register">
                                <input type="text" name="name" placeholder="Имя" required="required">
                                <input type="email" name="email" placeholder="e-mail" required="required">
                                <input type="password" name="password" placeholder="пароль" required="required">
                                <div class="submit">
                                    <button>Вперед</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php else:?>
                    <div class="logout">
                        <a href="?logout=1">Выйти</a>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </header>
    <section id="content" class="mt20">
        <?php if($authed):?>
       <div class="container clear">
           <div class="archive white">
               <ul>
                   <li><a href="#?">Июль</a></li>
               </ul>
           </div>
           <div class="flr add_box white">
               <div class="dib">
<!--                   Добавление данных-->
                   <form action="posts.php" method="post" enctype="multipart/form-data" name="add_form">
                       <input name="method_name" type="hidden" value="<?php if($edit_post_data){echo "edit";} else{echo "add";}?>">
                       <input name="post_id" type="hidden" value="<?php echo $edit_post_data['item']['ID']?>">
                       <input name="add_income" class="add add_income" type="text" placeholder="Доход" value="<?php echo @$edit_post_data['item']['income']?>">
                       <input name="add_outgo" class="add add_outgo" type="text" placeholder="Расход" value="<?php echo @$edit_post_data['item']['outgo']?>">
                       <input name="submit" class="addSubmit" type="submit" value="<?php if($edit_post_data){echo "Редактировать";} else{echo "Добавить";}?>">
                   </form>
               </div>
           </div>
           <?php $result_query = db_select("SELECT * from `posts` WHERE user_id = ".$_COOKIE['ID']." LIMIT 500", true)?>
           <?php var_dump($result_query);?>
           <div class="currentMonth mt20">
               <table class="white">
                   <tr>
                       <th class="number">Дата</th>
                       <th class="income">Доход</th>
                       <th class="outgo">Расход</th>
                       <th class="edit">редактировать</th>
                       <th class="delete">удалить</th>
                   </tr>
                   <?php foreach($result_query['items'] as $item):?>
                   <tr data-id="<?php echo @$item['ID']?>">
                       <td class="number"><? echo @date("d-H-m/G:i:s",$item["date"])?></td>
                       <td class="income"><?php echo @$item['income']?> грн.</td>
                       <td class="outgo"><?php echo @$item['outgo']?> грн.</td>
                       <td class="edit"><a href="<?php echo @$this_page?>?method=edit&edit_post=<?php echo @$item['ID'] ?>"><span class="icon icon-edit"></span></a></td>
                       <td class="delete"><a href="<?php echo @$this_page?>?delete_post=<?php echo @$item['ID']?>"><span class="icon icon-delete"></span></a></td>
                   </tr>
                   <?php endforeach;?>
               </table>
               <div class="summary">Итого:</div>
           </div>
       </div>
        <?php endif;
        //TODO Вывести альтернативную инфу?>
    </section>
</div>

<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/index.js"></script>



</body>
</html>