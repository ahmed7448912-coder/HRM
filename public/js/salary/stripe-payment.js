document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('payment-form');
    if (!form) return;

    const stripeKey = form.dataset.stripeKey;
    const employeeName = form.dataset.employeeName;

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

        btnText.style.display = 'none';
        btnLoading.style.display = 'inline';
        submitBtn.disabled = true;

        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: card,
            billing_details: {
                name: employeeName
            }
        });

        if (error) {
            document.getElementById('card-errors').textContent = error.message;
            btnText.style.display = 'inline';
            btnLoading.style.display = 'none';
            submitBtn.disabled = false;
        } else {
            document.getElementById('payment_method_id').value = paymentMethod.id;
            form.submit();
        }
    });
});
