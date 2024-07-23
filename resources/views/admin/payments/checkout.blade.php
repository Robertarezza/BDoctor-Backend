<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <script src="https://js.braintreegateway.com/web/dropin/1.27.0/js/dropin.min.js"></script>
</head>
<body>
    @if (session('success'))
        <div>{{ session('success') }}</div>
        <a href="{{ route('admin.doctors.index') }}">Torna alla home</a>
    @endif

    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif

    <form id="checkout-form" action="{{ route('admin.processPayment') }}" method="post">
        @csrf
        <div id="dropin-container"></div>
        <button type="submit">Pay</button>
    </form>

    <script>
        var form = document.querySelector('#checkout-form');
        var clientToken = "{{ $clientToken }}";

        braintree.dropin.create({
            authorization: clientToken,
            container: '#dropin-container'
        }, function (createErr, instance) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                instance.requestPaymentMethod(function (err, payload) {
                    if (err) {
                        console.log('Error:', err);
                        return;
                    }

                    // Inserisci il nonce nel form e invia il form
                    var nonceInput = document.createElement('input');
                    nonceInput.setAttribute('type', 'hidden');
                    nonceInput.setAttribute('name', 'payment_method_nonce');
                    nonceInput.setAttribute('value', payload.nonce);
                    form.appendChild(nonceInput);

                    form.submit();
                });
            });
        });
    </script>
</body>
</html>
