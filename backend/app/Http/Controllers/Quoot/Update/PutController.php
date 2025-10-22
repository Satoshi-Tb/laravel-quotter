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
            // 更新後、Quoot一覧ページにリダイレクト
            return redirect()->route('quoot.index');
        } else {
            abort(403);
        }
    }
}
