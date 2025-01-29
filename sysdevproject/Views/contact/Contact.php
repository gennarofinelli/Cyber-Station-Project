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
    <link rel="stylesheet" href=<?= $path . "/CSS/contact.css" ?>>
</head>

<body>
    <?php include_once dirname(__DIR__) . "/nav.php"; ?>

    <main>
        <h1><?=CONTACTUS?></h1>
        <p><?=HELP?></p>

        <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
            <p style="color: green; font-weight: bold;">Your message has been sent successfully!</p>
        <?php endif; ?>

        <form action="<?= $path . "/".$language."/contact/mail"?>" method="POST" class="contact-form">
            <p id="reminder">"<span class="asterix-higlighted">*</span>" <?=REQUIRED?></p>
            <select name="subject" id="inquiry-type" required>
                <option value="General Inquiry"><?=GENERAL?></option>
                <option value="Support"><?=CAREER?></option>
                <option value="Feedback"><?=COMPLAINT?></option>
            </select>

            <div class="name-fields">
                <input type="text" name="first_name" placeholder="<?=FIRSTNAME?>" required>
                <input type="text" name="last_name" placeholder="<?=LASTNAME?>" required>
            </div>

            <input type="email" name="email" placeholder="<?=EMAIL?>" required>
            <textarea name="message" placeholder="<?=MESSAGE?>" required></textarea>

            <div class="button">
                <input type="submit" value="<?=SUBMIT?>" class="submit-btn">
            </div>
        </form>
        </div>
    </main>

    <?php include_once dirname(__DIR__) . "/footer.php"; ?>
</body>

</html>