<?php

namespace App\Services\CreditCards;

class UpdateCreditCard
{
    private $request;
    private $creditCard;

    public function __construct( $request, $creditCard )
    {
        $this->request = $request;
        $this->creditCard = $creditCard;
    }

    public function update()
    {
        if( $this->request->has('import_map') ){
            $this->creditCard->import_map = $this->request->get('import_map');
        }

        $this->creditCard->save();
    }
}