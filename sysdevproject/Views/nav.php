<?php
$path = dirname($_SERVER['SCRIPT_NAME']);

$controller = isset($_GET['controller']) ? $_GET['controller'] : "";
$language = isset($_GET['lang']) ? $_GET['lang'] : 'en';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
?>
<html lang="en">

<head>
    <link rel="stylesheet" href=<?= $path . "/CSS/nav.css" ?>>
</head>
<script>
    function changeLanguage(lang) {
        const basePath = "<?= rtrim($path, '/') ?>";
        const controller = "<?= $controller ?>";
        const action = "<?= $action ?>"; // Include the action
        let url;

        if (controller) {
            // Include the action if it exists
            url = action
                ? `${basePath}/${lang}/${controller}/${action}`
                : `${basePath}/${lang}/${controller}`;
        } else {
            // Default to base path and language if no controller is present
            url = `${basePath}/${lang}`;
        }

        window.location.href = url;
    }
    function showSidebar() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.style.display = 'flex';
    }
    function hideSidebar() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.style.display = 'none';
    }
</script>
<header>
    <nav>
        <ul class="sidebar">
            <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26px"
                        viewBox="0 -960 960 960" width="26px" fill="black">
                        <path
                            d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                    </svg></a></li>
            <?php if ($controller != "admin") { ?>
                <li><a href="<?php echo $path . "/" . $language . "/Location"; ?>" class="menu-items"><?= LOCATIONS ?></a></li>
                <li><a href="<?php echo $path . "/" . $language . "/Contact"; ?>" class="menu-items"><?= CONTACTUS ?></a></li>
                <li><a href="<?php echo $path . "/" . $language . "/Reservation"; ?>" class="menu-items"><?= RESERVE ?></a></li>
            <?php } elseif ($controller == "admin") { ?>
                <li><a href="<?php echo $path . "/" . $language . "/Admin/Logout"; ?>" class="menu-items"><?= LOGOUT ?></a></li>
            <?php }?>
            <li>
                <select id="languages" onchange="changeLanguage(this.value)">
                    <option disabled selected><?= LANGUAGES ?></option>
                    <option value='en' <?= $language == 'en' ? 'selected' : '' ?>><?= ENGLISH ?></option>
                    <option value='fr' <?= $language == 'fr' ? 'selected' : '' ?>><?= FRENCH ?></option>
                </select>
            </li>
        </ul>
        <ul>
            <li>
                <?php if ($controller != "admin") { ?>
                    <a href=<?php echo $path . "/" . $language ?> id="logo">
                        <span class="first-letter">C</span>yber <span class="second-letter">S</span>tation
                    </a>
                <?php } elseif ($controller == "admin") { ?>
                    <a href=<?php echo $path . "/" . $language ."/admin/home" ?> id="logo">
                        <span class="first-letter">C</span>yber <span class="second-letter">S</span>tation
                    </a>
                <?php } ?>
            </li>
                <?php if ($controller != "admin") { ?>
                    <li class="hideOnMobile"><a href="<?php echo $path . "/" . $language . "/Location"; ?>"
                        class="menu-items"><?= LOCATIONS ?></a></li>
                    <li class="hideOnMobile"><a href="<?php echo $path . "/" . $language . "/Contact"; ?>"
                            class="menu-items"><?= CONTACTUS ?></a></li>
                    <li class="hideOnMobile"><a href="<?php echo $path . "/" . $language . "/Reservation"; ?>"
                            class="menu-items"><?= RESERVE ?></a></li>
                    <li class="hideOnMobile"></li>
                    <li class="hideOnMobile">
                        <select id="languages" onchange="changeLanguage(this.value)">
                            <option disabled selected><?= LANGUAGES ?></option>
                            <option value='en' <?= $language == 'en' ? 'selected' : '' ?>><?= ENGLISH ?></option>
                            <option value='fr' <?= $language == 'fr' ? 'selected' : '' ?>><?= FRENCH ?></option>
                        </select>
                    </li>
                <?php } elseif ($controller == "admin") { ?>
                <li class="hideOnMobile">
                    <a class="menu-items" href=<?php echo $path . "/" . $language . "/Admin/logout"; ?> id="account">
                        <?= LOGOUT ?>
                    </a>
                </li>
                <li class="hideOnMobile">
                        <select id="languages" onchange="changeLanguage(this.value)">
                            <option disabled selected><?= LANGUAGES ?></option>
                            <option value='en' <?= $language == 'en' ? 'selected' : '' ?>><?= ENGLISH ?></option>
                            <option value='fr' <?= $language == 'fr' ? 'selected' : '' ?>><?= FRENCH ?></option>
                        </select>
                    </li>
            <?php } ?>
            </li>
            <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg"
                        height="26px" viewBox="0 -960 960 960" width="26px" fill="black">
                        <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                    </svg></a></li>
        </ul>
    </nav>
</header>

</html>