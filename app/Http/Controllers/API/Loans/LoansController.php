<?php

namespace App\Http\Controllers\API\Loans;

use App\Http\Controllers\Controller;

class LoansController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
    }

    public function show( \Illuminate\Http\Request $request, Loan $loan )
    {
        $showAccount = new ShowAccount( 
            $request->user(), 
            $loan->id, 
            'loan' 
        );

        return response()->json( $showAccount->show() );
    }
}