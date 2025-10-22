<?php

namespace App\Http\Controllers\Quoot\Create;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Quoot\CreateRequest;
use App\Models\Quoot;

class PostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateRequest $request)
    {

        // Quootモデルを使用してデータベースに保存
        $quoot = new Quoot();
        $quoot->user_id = $request->getUserId();
        $quoot->content = $request->getQuoot();
        $quoot->save();

        // 保存後、Quoot一覧ページにリダイレクト
        return redirect()->route('quoot.index');
    }
}
