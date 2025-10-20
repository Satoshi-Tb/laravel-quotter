<?php

namespace App\Http\Controllers\Quoot\Create;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quser;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $loginId = Auth::id();
        if ($loginId) {
            $loginUser = Quser::where('id', $loginId)->first();
            return view('quoot.create')->with(
                [
                'userName' => $loginUser->user_name,
                ]
            );

        } else {
            // ログインページにリダイレクト
            return redirect('/login');
        }
    }
}
