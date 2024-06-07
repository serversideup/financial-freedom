<?php

namespace Modules\Transaction\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Transaction\Services\IndexTransactions;

class TransactionController extends Controller
{
    public function index( Request $request ): JsonResponse
    {
        $transactions = ( new IndexTransactions() )
            ->execute( $request, false );

        return response()->json( $transactions );
    }
}