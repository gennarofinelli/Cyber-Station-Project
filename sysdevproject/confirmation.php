<?php
if (isset($_GET['reservation_id'])) {
    $reservationId = htmlspecialchars($_GET['reservation_id']);
    echo "<h2>Payment successful! Your reservation ID: $reservationId</h2>";
} else {
    echo "<h2>Payment not found</h2>";
}
?>
