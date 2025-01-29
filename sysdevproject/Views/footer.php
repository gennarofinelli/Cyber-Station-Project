<?php
$path = dirname($_SERVER['SCRIPT_NAME']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href=<?=$path."/CSS/footer.css"?>>
  </head>
  <footer>
    <div class="footer-container">
      <div class="logo-contact">
        <a href="?controller=home&action=index" id="logo">
          <span class="first-letter">C</span>yber
          <span class="second-letter">S</span>tation
        </a>
        <br />
        <div class="contact-info">
          <p>
            <i class="fas fa-phone"></i>
            <a href="tel:+15146384311">+1 (514) 638-4311</a>
          </p>
          <br />
          <p>
            <i class="fas fa-envelope"></i>
            <a href="mailto:sara@cyberstation.ca">sara@cyberstation.ca</a>
          </p>
        </div>
      </div>
    </div>
  </footer>
</html>