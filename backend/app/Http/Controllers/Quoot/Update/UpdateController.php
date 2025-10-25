<?php

namespace App\Http\Controllers\Quoot\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quser;
use App\Models\Quoot;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $quootId)
    {
        $userId = Auth::id();
        $quser = Quser::where('id', $userId)->firstOrFail();
        $quoot = Quoot::where('id', $quootId)->firstOrFail();

        // logger()->info('UpdateController invoked', ['userId' => $userId, 'quootId' => $quootId]);

        if ($userId === $quoot->user_id) {
            $redirectPath = $request->query('redirect', '/quoot');

            // 許可済みのアプリ内パス以外の場合、一覧画面に戻す。
            if (!is_string($redirectPath) || !preg_match('#^/(?:quoot|user/[^/]+)$#', $redirectPath)) {
                $redirectPath = '/quoot';
            }

            return view('quoot.update')->with(
                [
                'quootId' => $quoot->id,
                'content' => $quoot->content,
                'userName' => $quser->user_name,
                'redirectPath' => $redirectPath,
                ]
            );
        } else {
            abort(403);
        }
    }
}
