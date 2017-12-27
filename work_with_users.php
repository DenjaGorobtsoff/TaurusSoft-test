<?php
include ('db/db.php');



//Добавленеи новых пользователей
if (empty($_POST['id']) && $_POST['send']=='add_user') {

    $clear_address = explode(',', str_replace(' ','',$_POST['address']));
    $new_array = array();
    foreach($clear_address as $key=>$value){
        if($key == 0 || $key == 1){
            continue;
        }
        $new_array[] = $value;
    }
    $address_string = implode(' ', $new_array);

    $address = str_replace(' ','+',trim($address_string));

    $location = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&key=AIzaSyDU4ZHinWfj3CxARPHqz2J7GzLt2e3MJmA'))->results;
    $lat = $location[0]->geometry->location->lat;
    $lng = $location[0]->geometry->location->lng;


    $sql = "INSERT INTO users
            (name, address, lat, lng, image)
            VALUES ('$_POST[name]','$_POST[address]','$lat', '$lng', 'https://memegenerator.net/img/images/600x600/11844239/terminator-thumbs-up.jpg')";
    $connect->query($sql);
    header('location: manage_users.php');
}
//Редактирование пользователей
if (isset($_POST['id'])){
    $clear_address = str_replace(' ','',$_POST['address']);
    $clear_address = explode(',', $clear_address);
    $new_array = array();
    foreach($clear_address as $key => $value){
        if($key == 0 || $key == 1){
            continue;
        }
        $new_array[] = $value;
    }
    $address_string = implode(' ', $new_array);

    $address = str_replace(' ','+',trim($address_string));

    $location = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&key=AIzaSyDU4ZHinWfj3CxARPHqz2J7GzLt2e3MJmA'))->results;
    $lat = $location[0]->geometry->location->lat;
    $lng = $location[0]->geometry->location->lng;

    $sql_edit = "UPDATE users
                  SET name='".$_POST['name']."',
                  address='".$_POST['address']."',
                  lat='".$lat."',
                  lng='".$lng."'
                  WHERE id='".$_POST['id']."'";

    $connect->query($sql_edit);

    header('location: manage_users.php');
}

//Удаленеи пользователей
if(isset($_GET['delete'])){

    $sql_delete = "DELETE FROM users WHERE id='".$_GET['delete']."'";
    $connect->query($sql_delete);

    header('location: manage_users.php');
}