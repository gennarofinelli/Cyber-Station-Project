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
    <link rel="stylesheet" href=<?= $path . "/CSS/reserve.css" ?>>
</head>
<body>
    <?php include_once dirname(__DIR__)."/nav.php"; ?>

    <main>
        <h1><?=THANK?></h1>

        <p><?=CONFIRMATION?></p>

        <fieldset style="text-align: left; margin: 0 auto;">
            <h1><?=SUMMARY?></h1>

            <label><?=STATION?>: </label>
            <input type="text" disabled value="<?php echo $data['station']?>"><br>
            <label><?=NAME?>:</label>
            <div class="name-inputs">
                <input type="text" disabled value="<?php echo $data['firstName']?>">
                <input type="text" disabled value="<?php echo $data['lastName']?>">
            </div>
            <label><?=EMAIL?>:</label>
            <input type="text" disabled value="<?php echo $data['email']?>"><br>
            <label><?=PHONE?>:</label>
            <input type="text" disabled value="<?php echo $data['phone']?>"><br>
            <label><?=RESERVATIONTIME?>:</label>
            <input type="text" disabled value="<?php echo $data['hour'].":".$data['minute']." ".$data['morningOrNight']?>"><br>
            <label><?=LENGTH?>:</label>
            <input type="text" disabled value="<?php
                switch($data['length']){
                    case "30":
                        echo "30 minutes";
                        break;
                    case "60":
                        echo "1 hour";
                        break;
                    case "120":
                        echo "2 hours";
                        break;
                }
            ?>"><br>
            <label><?=RESERVATIONDATE?>:</label>
            <input type="text" disabled value="<?php echo $data['reservationDate']?>"><br>
            <label><?=AMOUNTPAID?>:</label>
            <input type="text" disabled value="<?php echo $data['amountPaid']?>"><br>
        </fieldset>
    </main>

    <?php include_once dirname(__DIR__) . "/footer.php"; ?>
</body>
</html>