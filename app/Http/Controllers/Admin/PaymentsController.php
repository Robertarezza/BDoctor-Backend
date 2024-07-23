<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BraintreeService;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    // variable from BraintreeService
    protected $braintree;

    public function __construct(BraintreeService $braintree)
    {
        $this->braintree = $braintree;
    }

    // We save a client token and we redirect the client to the checkout
    public function showCheckout()
    {
        $clientToken = $this->braintree->generateClientToken();
        // dd($clientToken);
        return view('admin.payments.checkout', ['clientToken' => $clientToken]);
    }

    public function processPayment(Request $request)
    {
        // Amount to pay
        $amount = '10.00'; // da cambiare con il dinamico

        // nonce is a temporary key used to safely pass the payment information (card number ecc...) to the server without exposing them
        $nonce = $request->input('payment_method_nonce');

        // result = variable->personal key's->controls if there's a token->pass the attributes
        $result = $this->braintree->gateway()->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            // returns a succes message with the ID of the transaction
            return redirect()->route('admin.doctors.index')->with('message', 'Transaction ID: ' . $result->transaction->id);
        } else {
            // returns the error message
            return redirect()->back()->with('error', 'Error: ' . $result->message);
        }
    }
}
