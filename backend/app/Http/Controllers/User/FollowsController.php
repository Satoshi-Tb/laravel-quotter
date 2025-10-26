<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quser;
use App\Models\Follows;

class FollowsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $userName)
    {
        // URLからユーザ名を取得しqusersテーブルを検索
        $quser = Quser::where('user_name', $userName)->firstOrFail();

        // followsテーブルのfollowing_user_idフィールドをユーザIDで検索
        $followedUserIds = Follows::where('following_user_id', $quser->id)->get() ?? [];

        // 検索結果のfollowed_user_idフィールドの値でqusersテーブルを検索しリストを作る
        $followedUsers = Quser::whereIn('id', $followedUserIds->pluck('followed_user_id'))->get() ?? [];

        // リストをViewに渡す。
        return view('user.follows')->with(
            [
                'userName' => $userName,
                'followedUsers' => $followedUsers,
            ]
        );
    }
}
