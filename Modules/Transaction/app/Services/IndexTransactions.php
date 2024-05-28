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

        return $this->query->get();
    }
}