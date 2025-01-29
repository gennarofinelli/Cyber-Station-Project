<?php

include_once "db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'libs/stripe-php/init.php';

\Stripe\Stripe::setApiKey('sk_test_51QS167CDO0UiuJId9mGPXGb3aLXxnvVGu0UXCK9X7FQRBkLa2hWETuSi0li4hQyCXawgCecJOtLTWK1JaIYP6XbE009dmKFD84');

class ReservationModel {
    public $reservationId;
    public $stationId;
    public $u_name;
    public $u_email;
    public $u_phone;
    public $reservationTime;
    public $lengthOfReservation;
    public $reservationDate;

    function __construct($id = -1) {
        if ($id < 0) {
            $this->stationId = "";
            $this->u_name = "";
            $this->u_email = "";
            $this->u_phone = "";
            $this->reservationTime = "";
            $this->lengthOfReservation = "";
            $this->reservationDate = "";
        } else {
            global $conn;
            $sql = "SELECT * FROM `reservation` WHERE `reservationId` = " . $id;

            $result = $conn->query($sql);
            $data = ReservationModel::castToReservation($result->fetch_object());

            $this->reservationId = $id;
            $this->stationId = $data->stationId;
            $this->u_name = $data->u_name;
            $this->u_email = $data->u_email;
            $this->u_phone = $data->u_phone;
            $this->reservationTime = $data->reservationTime;
            $this->lengthOfReservation = $data->lengthOfReservation;
            $this->reservationDate = $data->reservationDate;
        }
    }

    static function castToReservation($obj) {
        $reservation = new ReservationModel();

        $reservation->reservationId = $obj->reservationId;
        $reservation->stationId = $obj->stationId;
        $reservation->u_name = $obj->u_name;
        $reservation->u_email = $obj->u_email;
        $reservation->u_phone = $obj->u_phone;
        $reservation->reservationTime = $obj->reservationTime;
        $reservation->lengthOfReservation = $obj->lengthOfRes;
        $reservation->reservationDate = $obj->reservationDate;

        return $reservation;
    }

    static function list(){
        global $conn;
        $list = array();

        $sql = "SELECT * FROM `reservation`";
        $result = $conn->query($sql);

        while($row = $result->fetch_object()){
            $reservation = ReservationModel::castToReservation($row);

            array_push($list, $reservation);
        }

        return $list;
    }

    static function listByDate($data){
        global $conn;
        $list = array();

        $sql = "SELECT * FROM `reservation` WHERE `reservationDate` = '". $data['reservationDate'] . "';";
        $result = $conn->query($sql);

        while($row = $result->fetch_object()){
            $reservation = ReservationModel::castToReservation($row);

            array_push($list, $reservation);
        }

        return $list;
    }

    static function addSave($data) {
        global $conn;

        $stmt = $conn->prepare("INSERT INTO `reservation` 
            (`stationId`, `u_name`, `u_email`, `u_phone`, `reservationTime`, `lengthOfRes`, `reservationDate`, `payment_status`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')");

        $name = $data['lastName'].", ".$data['firstName'];
        $reservationTime = $data['hour'].":".$data['minute']." ".$data['morningOrNight'];

        $stmt->bind_param("issssss", $data['station'], $name, $data['email'], $data['phone'], $reservationTime, $data['length'], $data['reservationDate']);

        $stmt->execute();

        return $conn->insert_id;
    }

    static function validateReservation($data) {
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM `reservation` WHERE `stationID` LIKE ? AND `reservationTime` LIKE ? AND `reservationDate` LIKE ?");

        $reservationTime = $data['hour'] . ":" . $data['minute'] . " " . $data['morningOrNight'];

        $stmt->bind_param("sss", $data['station'], $reservationTime, $data['reservationDate']);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows < 1) {
            return true; // Time slot is available
        } else {
            echo "<script>alert('The selected time is already reserved. Please choose a different time.');</script>";
            return false;
        }
    }

    function delete(){
        global $conn;
        $sql = "DELETE FROM `reservation` WHERE `reservationId` = ". $this->reservationId;

        $conn->query($sql);
    }


    public static function send2FACode($data, $code) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'sysdevproj69@gmail.com';
            $mail->Password   = 'wmjcogrprrikolhh';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('sysdevproj69@gmail.com', 'Cyber Station');
            $mail->addAddress($data['email'], $data['firstName'] . " " . $data['lastName']);

            // Content
            $mail->isHTML(true);
            $mail->Subject = '2FA Code';
            $mail->Body    = "
                <h1>2FA CODE</h1>
                <p>Here is your 2FA code:</p>
                <p>$code</p>
                <p>We look forward to welcoming you!</p>
            ";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Mailer Error: " . $mail->ErrorInfo);
            return false;
        }
    }

    static function validate2FA($data) {
        if ($data['2FA'] == $_SESSION['2FA']) {
            return true;
        } else {
            return false;
        }
    }

    public static function sendReservationEmail($data) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; 
            $mail->SMTPAuth   = true;
            $mail->Username   = 'sysdevproj69@gmail.com';
            $mail->Password   = 'wmjcogrprrikolhh';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('sysdevproj69@gmail.com', 'Cyber Station');

            $mail->addAddress($data['email'], $data['firstName'] . " " . $data['lastName']); // Uncomment if you want to send the email to the user
            // ONLY UNCOMMENT ONE
            // $mail->addAddress('sysdevproj69@gmail.com', 'Admin'); // Uncomment if you want to send the email to the admin.


            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Reservation Confirmation';
            $mail->Body    = "
                <h1>Thank you for your reservation!</h1>
                <p>Here are your reservation details:</p>
                <p>
                    <strong>Station:</strong> {$data['station']}<br>
                    <strong>Name:</strong> {$data['firstName']} {$data['lastName']}<br>
                    <strong>Email:</strong> {$data['email']}<br>
                    <strong>Phone:</strong> {$data['phone']}<br>
                    <strong>Reservation Time:</strong> {$data['hour']}:{$data['minute']} {$data['morningOrNight']}<br>
                    <strong>Reservation Date:</strong> {$data['reservationDate']}<br>
                    <strong>Length:</strong> {$data['length']} minutes
                </p>
                <p>We look forward to welcoming you!</p>
            ";

            $mail->AltBody = "Thank you for your reservation!\n\nHere are your reservation details:\n"
                . "Station: {$data['station']}\n"
                . "Name: {$data['firstName']} {$data['lastName']}\n"
                . "Email: {$data['email']}\n"
                . "Phone: {$data['phone']}\n"
                . "Reservation Time: {$data['hour']}:{$data['minute']} {$data['morningOrNight']}\n"
                . "Reservation Date: {$data['reservationDate']}\n"
                . "Length: {$data['length']} minutes\n\n"
                . "We look forward to welcoming you!";

            $mail->send();

            return true;
        } catch (Exception $e) {
            // Log the error
            error_log("Mailer Error: " . $mail->ErrorInfo);
            return false;
        }
    }

    function fetchReservationDetails(){
        // Calculate the amount based on reservation details
        $amount = $this->calculateAmount(); // Example function to calculate payment amount
        $currency = 'cad'; // Set currency for the payment

        // Create a payment intent
        try {
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $amount, // Amount in cents
                'currency' => $currency,
                'description' => 'Reservation Payment - ID ' . $this->reservationId,
            ]);

            // Get the client secret to pass to the frontend
            return ["amount"=>$paymentIntent['amount'], "currency"=>$paymentIntent['currency'], "clientSecret"=>$paymentIntent->client_secret, "reservationID"=>$this->reservationId];
        } catch (Exception $e) {
            die('Error creating payment intent: ' . $e->getMessage());
        }
    }

    function calculateAmount() {
        switch($this->lengthOfReservation){
            case 30:
                $ratePerHour = 7.99;
                break;
            case 60:
                $ratePerHour = 9.99;
                break;
            case 120:
                $ratePerHour = 19.99;
                break;
        }; // Price in CAD per hour
        return $ratePerHour * 100; // Convert to cents
    }
}
?>
