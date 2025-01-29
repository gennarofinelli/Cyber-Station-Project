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
        <h2><?=LOGIN?></h2>

        <form action=<?=$path."/".$language."/admin/login"?> method="POST">
            <label for="username"></label>
            <input type="text" id="username" name="username" placeholder="<?=USERNAME?>" required>
            
            <label for="password"></label>
            <input type="password" id="password" name="password" placeholder="<?=PASSWORD?>" required>
            
            <input class="login-btn" type="submit" value="Login">
        </form>
    </div>

    <script src="../public/script.js"></script>
</body>
</html>
