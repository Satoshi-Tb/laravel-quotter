<?php

namespace App\Http\Controllers\Quoot\Delete;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quoot;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $quootId)
    {
        $userId = Auth::id();
        $quoot = Quoot::where('id', $quootId)->firstOrFail();
        if ($userId === $quoot->user_id) {
            $redirect_path = $request->input('redirect', '/quoot');
            $quoot->delete();

            // 許可済みのアプリ内パス以外の場合、一覧画面に戻す。
            if (!preg_match('#^/(?:quoot|user/[^/]+)$#', $redirect_path)) {
                $redirect_path = '/quoot';
            }

            return redirect($redirect_path);
        } else {
            abort(403);
        }
    }
}
