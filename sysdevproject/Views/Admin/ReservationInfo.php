<?php
$path = dirname($_SERVER['SCRIPT_NAME']);
$language = isset($_GET['lang']) ? $_GET['lang'] : 'en';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Station</title>
    <link rel="icon" type="image/x-icon" href="Images/cyberStation.ico">
    <link rel="stylesheet" href=<?= $path . "/CSS/adminReservations.css" ?>>
</head>
<body>
    <?php include_once dirname(__DIR__)."/nav.php"; ?>

    <main class="admin-container">
    <h1 id="logo">
        <span class="first-letter">C</span>yber <span class="second-letter">S</span>tation
    </h1>

    <table class="reservations">
        <tbody>
        <tr>
            <th><?=RESERVATIONID?></th>
            <td><?=$_GET['id']?></td>
        </tr>
        <tr>
            <th><?=STATIONNUM?></th>
            <td><?=$data[0]->stationId?></td>
        </tr>
        <tr>
            <th><?=EMAIL?></th>
            <td><?=$data[0]->u_email?></td>
        </tr>
        <tr>
            <th><?=PHONE?></th>
            <td><?=$data[0]->u_phone?></td>
        </tr>
        <tr>
            <th><?=RESERVATIONTIME?></th>
            <td><?=$data[0]->reservationTime?></td>
        </tr>
        <tr>
            <th><?=LENGTH?></th>
            <td><?=$data[0]->lengthOfReservation?> <?=MINUTES?></td>
        </tr>
        <tr>
            <th><?=RESERVATIONDATE?></th>
            <td><?=$data[0]->reservationDate?></td>
        </tr>
        </tbody>
    </table>
    <a href=<?=$path."/".$language."/admin/home"?>><?=BACK?></a>
</main>
</body>
</html>
