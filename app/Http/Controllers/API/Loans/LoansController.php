<?php

namespace App\Http\Controllers\API\Loans;

use App\Http\Controllers\Controller;
use App\Http\Requests\Loans\CreateLoanRequest;
use App\Services\Accounts\ShowAccount;
use App\Models\Accounts\Loan;
use App\Services\Accounts\UpdateAccount;
use App\Http\Requests\Loans\UpdateLoanRequest;
use App\Services\Loans\CreateLoan;

class LoansController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
        $this->middleware('can:show,loan')->only('show');
        $this->middleware('can:update,loan')->only('update');
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

    public function store( CreateLoanRequest $request )
    {
        ( new CreateLoan( 
            $request->user(),
            $request->all()
        ) )->create();

        return response()->json( null, 201 );
    }

    public function update( UpdateLoanRequest $request, Loan $loan )
    {
        $updateAccount = new UpdateAccount(
            $request->user(),
            $request->all()
        );

        $updateAccount->update( $loan->id, 'loan');
    }
}