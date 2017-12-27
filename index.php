<?php
include ('db/db.php');

$sql = "SELECT name, address, image, lat, lng FROM users WHERE id ='".$_GET['id']."'";

$response = $connect->query($sql);
$location = $response->fetch_assoc();
//Если никаких данных не пришло то просто показываем столицу Украины - Киев
if ($location == null){
    $location['lat'] = 50.448853;
    $location['lng'] = 30.513346;
    $location['image'] = 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/COA_of_Kyiv_Kurovskyi.svg/200px-COA_of_Kyiv_Kurovskyi.svg.png';
    $location['name'] = 'Киев';
    $location['address'] = 'Столица Украны';

}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Карта Google</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

    <div class="button_section">
        <a class="btn_mng" href="manage_users.php">Manage users</a>

    </div>
    <div id="map">

    </div>

    <script>
        //Работа с гугл картой
        function initMap() {

            var  popupContent = '<div class="map_content">' +
                                    '<div class="image"><img src="<?=$location['image']?>"></div>' +
                                    '<div class="inform"><?=$location['name']?><hr /><?=$location['address']?></div>' +
                                '</div>';

            var lat_lng = {lat: <?=$location['lat'] ?>, lng: <?=$location['lng'] ?>};

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 17,
                center: lat_lng
            });

            var marker = new google.maps.Marker({
                position: lat_lng,
                map: map,
                animation: google.maps.Animation.DROP
            });

            infowindow = new google.maps.InfoWindow({
                content: popupContent
            });

            infowindow.open(map, marker);

            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });

        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDU4ZHinWfj3CxARPHqz2J7GzLt2e3MJmA&callback=initMap">
    </script>

</body>
</html>

