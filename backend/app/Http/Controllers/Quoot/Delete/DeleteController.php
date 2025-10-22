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
        $quoot = Quoot::where('id', $quootId)->FirstOrFail();
        if ($userId === $quoot->user_id) {
            $quoot->delete();
            // 削除後、Quoot一覧ページにリダイレクト
            return redirect()->route('quoot.index');
        } else {
            abort(403);
        }
    }
}
