<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BraintreeService;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    protected $braintree;

    public function __construct(BraintreeService $braintree)
    {
        $this->braintree = $braintree;
    }

    public function showCheckout()
    {
        $clientToken = $this->braintree->generateClientToken();
        // dd($clientToken);
        return view('admin.payments.checkout', ['clientToken' => $clientToken]);
    }

    public function processPayment(Request $request)
    {
        $amount = '10.00'; // L'importo della transazione, potrebbe essere dinamico
        $nonce = $request->input('payment_method_nonce');

        $result = $this->braintree->gateway()->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            return redirect()->back()->with('success', 'Transaction ID: ' . $result->transaction->id);
        } else {
            return redirect()->back()->with('error', 'Error: ' . $result->message);
        }
    }
}
