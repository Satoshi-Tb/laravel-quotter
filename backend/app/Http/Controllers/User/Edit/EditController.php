<?php

namespace App\Http\Controllers\User\Edit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quser;

class EditController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $userName)
    {
        // userNameに基づいてQuserを取得する.ユーザー情報が取得できない場合、404エラーを返す
        $quser = Quser::where('user_name', $userName)->firstOrFail();
        return view('user.edit')->with([
            'userName' => $userName,
            'displayName' => $quser->display_name,
            'profile' => $quser->profile,
        ]);
    }
}
