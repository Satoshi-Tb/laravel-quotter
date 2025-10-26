<?php

namespace App\Http\Controllers\Quoot;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quoot;
use App\Models\Quser;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $quoots = Quoot::with('quser')->orderBy('created_at', 'desc')->get(); // User情報をあわせてロード.作成日時の降順で取得
        $loginId = Auth::id();
        if ($loginId) {
            $loginUser = Quser::where('id', $loginId)->first();
            return view('quoot.index')->with(
                [
                'userName' => $loginUser->user_name,
                'quoots' => $quoots
                ]
            );

        } else {

            return view('quoot.index')->with(
                [
                'quoots' => $quoots
                ]
            );

        }

    }
}
