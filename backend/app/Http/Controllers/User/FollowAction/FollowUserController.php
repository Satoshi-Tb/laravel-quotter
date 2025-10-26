<?php

namespace App\Http\Controllers\User\FollowAction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quser;
use App\Models\Follows;

class FollowUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $userName)
    {
        // userNameからフォローする対象のユーザを特定する
        $followedUser = Quser::where('user_name', $userName)->firstOrFail();

        // データ登録済かどうかチェックする
        $existingFollow = Follows::where([
            ['following_user_id', Auth::id()],
            ['followed_user_id', $followedUser->id]
        ])->first();

        // まだ登録されていなければフォロー処理を実行する
        if (!$existingFollow) {
            $follow = new Follows();
            $follow->following_user_id = Auth::id();
            $follow->followed_user_id = $followedUser->id;
            $follow->save();
        }

        // フォロー後、元のユーザーページにリダイレクトする。
        return redirect()->route('user.index', ['userName' => $userName]);
    }
}
