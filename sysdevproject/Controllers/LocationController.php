<?php
include_once "Controllers/Controller.php";
include_once "Models/LocationModel.php";

class LocationController extends Controller
{
    function route()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : "index";

        if ($action == "index") {
            $this->render("Location", "locations");
        } elseif ($action == "YULAirport") {
            $this->render("Location", "YULAirport");
        }
    }
}
?>
