<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quser;
use App\Models\Quoot;
use App\Models\Follows;

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

        // 自身がフォロー済かどうかをチェック
        $hasFollowed = Follows::where('following_user_id', Auth::id())
            ->where('followed_user_id', $quser->id)
            ->exists();

        $isMyPage = Auth::check() && Auth::id() === $quser->id;

        $imagePath = $quser->profile_image_id ? $quser->getImagePath() : null;

        return view('user.index')->with([
            'userName' => $userName,
            'displayName' => $quser->display_name,
            'profile' => $quser->profile,
            'quoots' => $quoots,
            'imagePath' => $imagePath,
            'hasFollowed' => $hasFollowed,
            'isMyPage' => $isMyPage,
        ]);
    }
}
