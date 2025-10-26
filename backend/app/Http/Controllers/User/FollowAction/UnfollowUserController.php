<?php

namespace App\Http\Controllers\User\FollowAction;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quser;
use App\Models\Follows;

class UnfollowUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $userName)
    {
        // userNameからフォローする対象のユーザを特定する
        $followedUser = Quser::where('user_name', $userName)->firstOrFail();

        // フォローレコードを削除する
        Follows::where('following_user_id', Auth::id())
            ->where('followed_user_id', $followedUser->id)
            ->delete();

        // フォロー解除後、元のユーザーページにリダイレクトする。
        return redirect()->route('user.index', ['userName' => $userName]);
    }
}
