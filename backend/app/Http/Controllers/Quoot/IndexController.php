<?php

namespace App\Http\Controllers\Quoot;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quoot;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $quoots = Quoot::all();
        return view('quoot.index')->with(
            [
            'userName' => 'user1',
            'quoots' => $quoots
            ]
        );
    }
}
