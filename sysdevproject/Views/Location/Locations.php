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
    <link rel="stylesheet" href=<?= $path . "/CSS/location.css" ?>>
</head>

<body>
    <?php include_once dirname(__DIR__) . "/nav.php"; ?>
    <div class="container">
        <h1><?=LOCATIONS?></h1>
        <p><?=TIME?></p>

        <div class="location-icon">
            <img src=<?=$path."/Images/placeholder.png"?> alt="Location Icon">
        </div>
    </div>
    <h2 class="airport-header"><?=AIRPORT?></h2>
    <div class="location-section">
        <div class="location-details">
            <p><?=AIRPORT?></p>
            <h2>YUL</h2>
            <p><?=NEAR?></p>
            <div class="status">
                <span class="open"><?=OPEN?></span>
                <span><?=OPENTIME?></span>
            </div>
            <a href=<?=$path."/".$language."/location/YULAirport"?> class="more-info"><?=MORE?> →</a>
        </div>
        <div class="location-image">    
            <img src=<?=$path."/Images/CyberStation.png"?> id="cyberStation" alt="Airport Image">
        </div>
    </div>

    <?php include_once dirname(__DIR__) . "/footer.php"; ?>
</body>

</html>