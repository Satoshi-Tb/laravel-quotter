<?php

namespace App\Http\Controllers\Quoot\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Quoot\UpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Quoot;

class PutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, $quootId)
    {
        $userId = Auth::id();
        $quoot = Quoot::where('id', $quootId)->FirstOrFail();
        if ($userId === $quoot->user_id) {
            $quoot->content = $request->getQuoot();
            $quoot->save();

            $redirectPath = $request->input('redirect', '/quoot');

            // 許可済みのアプリ内パス以外の場合、一覧画面に戻す。
            if (!is_string($redirectPath) || !preg_match('#^/(?:quoot|user/[^/]+)$#', $redirectPath)) {
                $redirectPath = '/quoot';
            }

            return redirect($redirectPath);
        } else {
            abort(403);
        }
    }
}
