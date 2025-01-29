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
    <link rel="stylesheet" href=<?= $path . "/CSS/homepage.css" ?>>
</head>
<body>
    <?php include_once dirname(__DIR__) . "/nav.php"; ?>

    <main>
        <!-- Top Image Section -->
        <div class="top-image">
            <img src="<?=$path?>/Images/headerimage.png" alt="Main CyberStation Image">
        </div>

        <!-- How It Works Section -->
        <section class="how-it-works">
    <h2><?=HOW?></h2>
    <div class="features">
        <!-- Replace each image source with your actual image paths -->
        <div class="feature-item">
            <img src="<?=$path?>/Images/placeholder.png" alt="placeholder">
            <p><?=FOUND?></p>
        </div>
        <div class="feature-item">
            <img src="<?=$path?>/Images/hour.png" alt="Time">
            <p><?=DECIDE?></p>
        </div>
        <div class="feature-item">
            <img src="<?=$path?>/Images/wifi.png" alt="High-Speed WiFi">
            <p><?=ENJOY?></p>
        </div>
        <div class="feature-item">
            <img src="<?=$path?>/Images/airplane.png" alt="Airplane">
            <p><?=BOARD?></p>
        </div>
    </div>
</section>

        <!-- Location Section -->
        <section class="location">
    <h2><?=LANDING?></h2>
    <div class="location-images">
        <img src="<?=$path?>/Images/CyberStation2.png" alt="Left Image">
        <img src="<?=$path?>/Images/CyberStation.png" alt="right Image">
    </div>
</section>


        <!-- Amenities Section -->
        <div class="amenities">
            <h2><?=SIT?></h2>
            <p><?=AMENITIES?></p>
            <div class="amenity-items">
                <div class="amenity-box">
                    <img src="<?=$path?>/Images/playstation.png" alt="Current Gen Gaming">
                    <p><?=CURRENT?></p>
                </div>
                <div class="amenity-box">
                    <img src="<?=$path?>/Images/clean.png" alt="Meticulous Cleaning">
                    <p><?=CLEANING?></p>
                </div>
                <div class="amenity-box">
                    <img src="<?=$path?>/Images/headphones.png" alt="Premium Gaming Headphones">
                    <p><?=HEADPHONES?></p>
                </div>
                <div class="amenity-box">
                    <img src="<?=$path?>/Images/charging.png" alt="Charging Stations">
                    <p><?=CHARGING?></p>
                </div>
                <div class="amenity-box">
                    <img src="<?=$path?>/Images/snacks.png" alt="Snacks & Beverages">
                    <p><?=SNACKS?></p>
                </div>
                <div class="amenity-box">
                    <img src="<?=$path?>/Images/wifi.png" alt="High Speed Internet">
                    <p><?=INTERNET?></p>
                </div>
            </div>
        </div>


        <!-- Pricing Section -->
        <section class="pricing">
            <h2><?=PRICES?></h2>
            <p><?=PRICEMEMO?></p>
        </section>

        <!-- About Section -->
        <section class="about">
            <h2><?=ABOUT?></h2>
            <p><?=ABOUTMESSAGE?></p>
        </section>
    </main>

    <?php include_once dirname(__DIR__) . "/footer.php"; ?>
</body>
</html>
