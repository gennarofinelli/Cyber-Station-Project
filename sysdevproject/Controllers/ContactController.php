<?php
    include_once "Controllers/Controller.php";
    include_once "Models/ContactModel.php";

    class ContactController extends Controller {
        function route() {
            $action = isset($_GET['action']) ? $_GET['action'] : "index";
            
            if ($action == "mail") {
                $contacts = Contact::sendMail($_POST);
                $this->render("Contact", "contact");
                exit;
            } elseif ($action == "index") {
                include_once "Views/contact/Contact.php";
            }
        }
    }
?>
