<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsorship;
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
    public function showCheckout($id)
{
    $sponsorship = Sponsorship::findOrFail($id);
    $clientToken = $this->braintree->generateClientToken();
    //dd($sponsorship, $clientToken);

    return view('admin.payments.checkout', [
        'clientToken' => $clientToken,
        'sponsorship' => $sponsorship
    ]);
}

    public function processPayment(Request $request)
    {
      // ID della sponsorizzazione selezionata
    $sponsorshipId = $request->input('id');
    //dd($sponsorshipId);
    
    // Ottieni la sponsorizzazione dalla tabella Sponsorships
    $sponsorship = Sponsorship::find($sponsorshipId);

    if (!$sponsorship) {
        return redirect()->back()->with('error', 'Sponsorizzazione non trovata.');
    }

    // Utilizza il prezzo della sponsorizzazione per la transazione
    $amount = $sponsorship->price;


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
            return redirect()->route('admin.doctors.index')->with('message', 'Transaction ID: ' . $result->transaction->id . 'Importo: ' . $amount);
        } else {
            // returns the error message
            return redirect()->back()->with('error', 'Error: ' . $result->message);
        }
    }
}
