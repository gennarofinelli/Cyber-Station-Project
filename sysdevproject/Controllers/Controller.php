<?php

class Controller {
    function route() {
        // To be overridden by child controllers
    }

    function render($controller, $view, $data = []) {
        extract($data);
        include "Views/$controller/$view.php";
    }
}
?>
