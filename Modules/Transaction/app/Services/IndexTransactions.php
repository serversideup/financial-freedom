<?php

namespace Modules\Transaction\Services;

use Illuminate\Http\Request;
use Modules\Transaction\Models\Transaction;

class IndexTransactions
{
    private $query;

    public function execute( Request $request )
    {
        $this->query = Transaction::query();

        $this->query->with( 'category' );
        $this->query->orderBy( 'date', 'desc' );

        return $this->query->paginate();
    }
}