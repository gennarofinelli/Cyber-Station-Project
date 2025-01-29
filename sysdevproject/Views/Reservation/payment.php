<?php
// Include Stripe PHP library
require_once 'libs/stripe-php/init.php';

// Set your Stripe secret key (replace with your actual secret key)
\Stripe\Stripe::setApiKey('sk_test_51QS167CDO0UiuJId9mGPXGb3aLXxnvVGu0UXCK9X7FQRBkLa2hWETuSi0li4hQyCXawgCecJOtLTWK1JaIYP6XbE009dmKFD84');

$path = dirname($_SERVER['SCRIPT_NAME']);
$language = isset($_GET['lang']) ? $_GET['lang'] : 'en';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Station</title>
    <link rel="stylesheet" href=<?=$path."/CSS/payment.css"?>>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h1 id="logo">
        <span class="first-letter">C</span>yber <span class="second-letter">S</span>tation
    </h1>

    <main>
        <h1><?=COMPLETE?></h1>
        <p><?=AMOUNT?>: <strong>$<?= number_format($data['amount'] / 100, 2) ?> <?= strtoupper($data['currency']) ?></strong></p>

        <!-- Stripe Elements Placeholder -->
        <form action="<?=$path . "/" . $language . "/reservation/Summary"?>" id="payment-form" data-client-secret="<?= htmlspecialchars($data['clientSecret']) ?>">
            <div id="card-element"><!-- Stripe card element will be injected here --></div>
            <button type="submit"><?=PAY?></button>
        </form>

        <div id="payment-result"></div>
    </main>

    <script>
        // Initialize Stripe
        const stripe = Stripe('pk_test_51QS167CDO0UiuJId8tqsqDRUDt9Mcya8NYVZeeXvmVMgIxpDdY0pJSJgU8Xe2fjSNjPvUI0CaeOL09zBmBgESXnk00evBc5q9V');

        // Get client secret from the form attribute
        const clientSecret = document.getElementById('payment-form').dataset.clientSecret;

        // Create an instance of Elements
        const elements = stripe.elements();
        const cardElement = elements.create('card', {
            style: {
                base: {
                    color: "#333",
                    fontFamily: "Arial, sans-serif",
                    fontSize: "16px",
                    '::placeholder': { color: "#888" },
                },
                invalid: { color: "#e63946" },
            }
        });
        cardElement.mount('#card-element');

        // Handle form submission
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const { paymentIntent, error } = await stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: cardElement,
                }
            });

            if (error) {
                // Display error to the user
                document.getElementById('payment-result').textContent = error.message;
            } else {
                // Payment successful
                document.getElementById('payment-result').textContent = 'Payment successful! Payment ID: ' + paymentIntent.id;

                <?php $_SESSION['amountPaid'] = ($data['amount']/100)?>

                var relativeURL = "<?=$path."/".$language."/reservation/Summary"?>"

                // Redirect to a confirmation page or update the database
                window.location.href = relativeURL;


            }
        });
    </script>
</body>
</html>
