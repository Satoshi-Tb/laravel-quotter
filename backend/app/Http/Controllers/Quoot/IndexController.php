<?php

namespace App\Http\Controllers\Quoot;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quoot;
use App\Models\Quser;
use App\Models\Follows;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $quoots = Quoot::with('quser')->orderBy('created_at', 'desc')->get(); // User情報をあわせてロード.作成日時の降順で取得
        $loginId = Auth::id();
        $onlyFollowees = $request->input('onlyFollowees', '0') === '1';
        if ($onlyFollowees && $loginId) {
            // ログインユーザのフォロー中ユーザIDを取得
            $followeeIds = Follows::where('following_user_id', $loginId)
              ->pluck('followed_user_id')
              ->toArray();

            // 自身のIDも含める
            $followeeIds[] = $loginId;

            // フォロー中ユーザ、および自身のQuootのみフィルタリング
            $quoots = $quoots->filter(function ($quoot) use ($followeeIds) {
                return in_array($quoot->quser->id, $followeeIds);
            });
        }

        if ($loginId) {
            $loginUser = Quser::where('id', $loginId)->firstOrFail();
            return view('quoot.index')->with(
                [
                'userName' => $loginUser->user_name,
                'quoots' => $quoots,
                'onlyFollowees' => $onlyFollowees
                ]
            );

        } else {

            return view('quoot.index')->with(
                [
                'quoots' => $quoots,
                'onlyFollowees' => false
                ]
            );

        }

    }
}
