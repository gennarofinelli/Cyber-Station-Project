<?php
$path = dirname($_SERVER['SCRIPT_NAME']);
$language = isset($_GET['lang']) ? $_GET['lang'] : 'en';

if (isset($_SESSION['permission_error'])) {
    echo "<script>alert('" . $_SESSION['permission_error'] . "');</script>";
    unset($_SESSION['permission_error']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Station</title>
    <link rel="icon" type="image/x-icon" href="Images/cyberStation.ico">
    <link rel="stylesheet" href=<?= $path . "/CSS/adminHome.css" ?>>
</head>
<body>
    <?php include_once dirname(__DIR__)."/nav.php"; ?>

    <main class="admin-container">
    <h1 id="logo">
        <span class="first-letter">C</span>yber <span class="second-letter">S</span>tation
    </h1>
    
    <form action=<?=$path."/".$language."/admin/search"?> method="POST">
        <fieldset>
            <div class="date-input">
                <input type="date" name="reservationDate">
            </div>
            <div class="button">
                <input type="submit" value="<?=SUBMIT?>" class="submit-button">
            </div>
        </fieldset>
    </form>

    <table class="reservations">
        <thead>
            <tr>
                <th><?=STATIONID?></th>
                <th><?=NAME?></th>
                <th><?=PHONE?></th>
                <th><?=RESERVATIONTIME?></th>
                <th><?=RESERVATIONDATE?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($data as $row){
                    echo "<tr>";
                    echo "<td>".$row->stationId."</td>";
                    echo "<td>".$row->u_name."</td>";
                    echo "<td>".$row->u_phone."</td>";
                    echo "<td>".$row->reservationTime."</td>";
                    echo "<td>".$row->reservationDate."</td>";
                    echo "<td id='actions'><a href='".$path."/".$language."/admin/reservationInfo/".$row->reservationId."'><img src='".$path."/Images/view.png' height='25' width='25'></a>";
                    echo "<a href='".$path."/".$language."/admin/delete/".$row->reservationId."'><img src='".$path."/Images/trash.png' height='25' width='25'></a></td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

</main>
</body>
</html>
