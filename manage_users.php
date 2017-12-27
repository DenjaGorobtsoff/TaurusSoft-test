<?php
include "db/db.php";

$sql = "SELECT * FROM users";

$sql_request = mysqli_query($connect,$sql);

$user_map = array();

while ($users = mysqli_fetch_assoc($sql_request)){
    $user_map[] = $users;
}

foreach ($user_map as $value){
    //var_dump($value);
}
?>



<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Карта Google</title>
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

</head>
<body>
<div class="btn_menu">
    <div class="button_section">
        <a class="btn_mng" href="/">Back to map</a>
    </div>
    <div class="button_section">
        <a class="btn_mng" href="add_user.php">Add user</a>
    </div>
</div>
<div class="table_users">
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

                <?php foreach($user_map as $value){?>
                    <tr>
                        <td><img src="<?=$value['image']?>"></td>
                        <td><a href="index.php?id=<?=$value['id']?>"><?=$value['name']?></a></td>
                        <td><a href="index.php?id=<?=$value['id']?>"><?=$value['address']?></a></td>
                        <td>
                            <a class="btn_engine" href="add_user.php?edit=<?=$value['id']?>">Edit</a>
                            <a onclick="return confirm('Удалить файл?')" class="btn_engine" href="work_with_users.php?delete=<?=$value['id']?>" >Delete</a>

                        </td>
                    </tr>

                <?}?>
        </tbody>

    </table>
</div>

</body>
</html>

