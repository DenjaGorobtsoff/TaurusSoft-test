<?php
include "db/db.php";

$sql = "SELECT id,name, address FROM users WHERE id = '".$_GET['edit']."'";
$response = $connect->query($sql);

$inf = $response->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление пользователя</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="js/valid_form.js"></script>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<div class="btn_menu">
    <div class="button_section">
        <a class="btn_mng" href="/">Back to map</a>
    </div>
</div>
<h2>Add User</h2>
<div class="add_users">
    <form action="work_with_users.php" method="post" class="add_form">

        <input type="text" name="id" placeholder="" value="<?=$inf['id']?>" style="display: none;">
        <h4>Name</h4>
        <p class="valid"></p>
        <input type="text" name="name" placeholder="" class="user_input name_input" value="<?=$inf['name']?>" />
        <div class="error-box"></div><!--- блок для отображения ошибок ввода формы--->
        <h4>Address Example: 12345, Украина, Киев, ул.Крещатик, 1/2</h4>
        <p class="valid"></p>
        <input type="text" name="address" placeholder="" class="user_input address_input" value="<?=$inf['address']?>" />
        <div class="error-dox"></div><!--- блок для отображения ошибок ввода формы--->
        <br />
        <button type="submit" name="send" class="btn_add_user" value="add_user">SEND</button>
    </form>
</div>

</body>
</html>