document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('payment-form');
    if (!form) return;

    const stripeKey = form.dataset.stripeKey;
    const employeeName = form.dataset.employeeName;
    const actionUrl = form.getAttribute('action'); // Route: salary.process

    const stripe = Stripe(stripeKey);
    const elements = stripe.elements();

    const card = elements.create('card', {
        style: {
            base: {
                fontSize: '16px',
                color: '#32325d',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a'
            }
        }
    });
    card.mount('#card-element');

    card.addEventListener('change', (e) => {
        document.getElementById('card-errors').textContent = e.error ? e.error.message : '';
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const btnText = document.getElementById('btn-text');
        const btnLoading = document.getElementById('btn-loading');
        const submitBtn = document.getElementById('submit-btn');
        const cardErrors = document.getElementById('card-errors');
        const csrfToken = form.querySelector('input[name="_token"]').value;

        btnText.style.display = 'none';
        btnLoading.style.display = 'inline';
        submitBtn.disabled = true;
        cardErrors.textContent = '';

        // 1. Create Stripe Payment Method
        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: card,
            billing_details: {
                name: employeeName
            }
        });

        if (error) {
            cardErrors.textContent = error.message;
            btnText.style.display = 'inline';
            btnLoading.style.display = 'none';
            submitBtn.disabled = false;
            return;
        }

        // 2. Submit payment method ID to backend via AJAX
        try {
            const response = await fetch(actionUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    payment_method_id: paymentMethod.id
                })
            });

            const result = await response.json();

            if (result.success) {
                // Payment Succeeded instantly (e.g. standard card)
                window.location.href = '/admin/salary';
            } else if (result.requires_action) {
                // 3D Secure / SCA required: Trigger interactive validation popup
                const { paymentIntent, error: confirmError } = await stripe.confirmCardPayment(
                    result.payment_intent_client_secret
                );

                if (confirmError) {
                    cardErrors.textContent = confirmError.message;
                    btnText.style.display = 'inline';
                    btnLoading.style.display = 'none';
                    submitBtn.disabled = false;
                } else if (paymentIntent && paymentIntent.status === 'succeeded') {
                    // Payment succeeded on Stripe frontend. Confirm on backend to complete record.
                    const confirmUrl = actionUrl.replace('/process', '/confirm-payment');
                    const confirmResponse = await fetch(confirmUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            payment_intent_id: paymentIntent.id
                        })
                    });

                    const confirmResult = await confirmResponse.json();

                    if (confirmResult.success) {
                        window.location.href = '/admin/salary';
                    } else {
                        cardErrors.textContent = confirmResult.message || 'Verification confirmation failed on server.';
                        btnText.style.display = 'inline';
                        btnLoading.style.display = 'none';
                        submitBtn.disabled = false;
                    }
                }
            } else {
                cardErrors.textContent = result.message || 'Payment processing failed.';
                btnText.style.display = 'inline';
                btnLoading.style.display = 'none';
                submitBtn.disabled = false;
            }

        } catch (ajaxError) {
            console.error('AJAX Error:', ajaxError);
            cardErrors.textContent = 'A connection error occurred. Please try again.';
            btnText.style.display = 'inline';
            btnLoading.style.display = 'none';
            submitBtn.disabled = false;
        }
    });
});
