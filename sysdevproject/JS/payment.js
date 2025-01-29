// Initialize Stripe
const stripe = Stripe('pk_live_51QS167CDO0UiuJIdvgMMtxNosyirs4qU3WrorMY7vNJ6LWgDQiivEraPvgCLVLXSl8Zg4Hq6m5tPjrbg9YpgDSXY006RjBTazN'); // Replace with your Stripe publishable key
const clientSecret = document.getElementById('payment-form').dataset.clientSecret; // Pass clientSecret dynamically

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

        // Redirect to confirmation page
        window.location.href = `confirmation.php?reservation_id=${reservationId}`;
    }
});
