<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quser;
use App\Models\Quoot;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $userName)
    {
        $quser = Quser::where('user_name', $userName)->first();
        // user情報が取得できた場合、紐づくQuootも取得する
        if ($quser) {
            $quoots = Quoot::where('user_id', $quser->id)->get();
        } else {
            // ユーザが見つからなかった場合、空の配列を返す
            $quoots = [];
        }

        return view('user.index')->with([
            'userName' => $userName,
            'displayName' => $quser ? $quser->display_name : '',
            'quoots' => $quoots,
        ]);
    }
}
