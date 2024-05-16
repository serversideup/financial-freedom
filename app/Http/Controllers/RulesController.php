<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rules\StoreRuleRequest;
use App\Services\Rules\StoreRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RulesController extends Controller
{
    public function store( StoreRuleRequest $request ): RedirectResponse
    {
        ( new StoreRule() )->execute( $request->toDto() );

        return redirect()->back();
    }
}
