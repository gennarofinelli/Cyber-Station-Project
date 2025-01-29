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
    <link rel="stylesheet" href=<?= $path . "/CSS/admin.css" ?>>
</head>
<body>
    <div id="notification" class="notification"></div>
    
    <div class="login-container">
        <h2><?=TFA?></h2>

        <p><?=EMAILCHECK?></p>

        <form action=<?=$path."/".$language."/reservation/2FA"?> method="POST">
            <input type="text" id="username" name="2FA" placeholder="<?=TFA?>" required>
            
            <input class="login-btn" type="submit" value="Login">
        </form>
    </div>
</body>
</html>