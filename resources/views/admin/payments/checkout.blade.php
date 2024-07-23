<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    {{-- braintree cdn --}}
    <script src="https://js.braintreegateway.com/web/dropin/1.27.0/js/dropin.min.js"></script>
</head>
<body>
    @extends('layouts.admin')

    @section('content')
    {{-- if succes we print the message succes and a button to return at the home page --}}
    @if (session('success'))
        <div>{{ session('success') }}</div>
        <a href="{{ route('admin.doctors.index') }}">Torna alla home</a>
    @endif

    {{-- else we print an error message --}}
    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif

    {{-- form with payment infos --}}
    <form id="checkout-form" action="{{ route('admin.processPayment') }}" method="post" style="width: 40%; margin: 0 auto;" class="mt-5">
        @csrf
        <div id="dropin-container"></div>
        <button type="submit">Pay</button>
    </form>


    <script>
        var form = document.querySelector('#checkout-form');
        // generated client token
        var clientToken = "{{ $clientToken }}";
        // console.log(clientToken);


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

                    // create the nonce with the inputs
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
    @endsection
    
