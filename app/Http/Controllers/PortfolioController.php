<?php

namespace App\Http\Controllers;

use App\Http\Requests\Portfolio\UpdatePortfolioRequest;
use App\Services\Portfolio\UpdatePortfolio;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PortfolioController extends Controller
{
    public function update( UpdatePortfolioRequest $request ): RedirectResponse
    {
        ( new UpdatePortfolio() )->update( $request );
        return redirect()->back();
    }
}
