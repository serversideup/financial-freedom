<?php

namespace App\Http\Controllers;

use App\Models\CreditCard;
use App\Services\CreditCards\UpdateCreditCard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CreditCardController extends Controller
{
    public function show( CreditCard $creditCard ): Response
    {
        return Inertia::render('CreditCards/Show', [
            'group' => 'accounts',
            'creditCard' => $creditCard,
        ]);
    }

    public function update( Request $request, CreditCard $creditCard ): RedirectResponse
    {
        ( new UpdateCreditCard( $request, $creditCard ) )->update();
        return redirect()->back();
    }

    // public function destroy( Account $account ): RedirectResponse
    // {
    //     ( new DeleteAccount() )->delete( $account );
    //     return redirect()->back();
    // }
}