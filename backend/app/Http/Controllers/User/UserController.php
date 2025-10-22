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
        // userNameに基づいてQuserを取得する.ユーザー情報が取得できない場合、404エラーを返す
        $quser = Quser::where('user_name', $userName)->firstOrFail();
        $quoots = Quoot::where('user_id', $quser->id)->get();
        return view('user.index')->with([
            'userName' => $userName,
            'displayName' => $quser->display_name,
            'quoots' => $quoots,
        ]);
    }
}
