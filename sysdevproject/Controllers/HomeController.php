<?php
    include_once "Controllers/Controller.php";

    class HomeController extends Controller{
        function route(){
            $action = isset($_GET['action']) ? $_GET['action'] : "index";
            
            if($action == "index"){
                $this->render("Home", "home");
            }
        }
    }
?>