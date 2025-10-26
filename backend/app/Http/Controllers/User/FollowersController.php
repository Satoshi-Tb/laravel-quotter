<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quser;
use App\Models\Follows;

class FollowersController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $userName)
    {
        // URLからユーザ名を取得しqusersテーブルを検索
        $quser = Quser::where('user_name', $userName)->firstOrFail();

        // followsテーブルのfollowed_user_idフィールドをユーザIDで検索
        $followingUserIds = Follows::where('followed_user_id', $quser->id)->get();

        // 検索結果のfollowing_user_idフィールドの値でqusersテーブルを検索しリストを作る
        $followingUsers = Quser::whereIn('id', $followingUserIds->pluck('following_user_id'))->get();

        // リストをViewに渡す。
        return view('user.followers')->with(
            [
                'userName' => $userName,
                'followingUsers' => $followingUsers,
            ]
        );
    }
}
