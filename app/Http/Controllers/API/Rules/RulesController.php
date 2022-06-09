<?php

namespace App\Http\Controllers\API\Rules;

use App\Http\Controllers\Controller;

use App\Models\Transactions\NamingRule;
use Illuminate\Http\Request;

class RulesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
    }

    public function index( )
    {
        $namingRules = NamingRule::with('category')->get();

        return response()->json( $namingRules );
    }

    public function store( Request $request )
    {
        $namingRule = new NamingRule();

        $namingRule->find = $request->get('find');
        $namingRule->replace = $request->get('replace');
        $namingRule->category_id = $request->get('category_id');

        $namingRule->save();

        $namingRule->load('category');

        return response()->json( $namingRule, 201 );
    }

    public function update( Request $request, NamingRule $rule )
    {
        $rule->find = $request->get('find');
        $rule->replace = $request->get('replace');
        $rule->category_id = $request->get('category_id');

        $rule->save();

        return response()->json('', 204);
    }
}