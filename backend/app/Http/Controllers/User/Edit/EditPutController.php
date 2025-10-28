<?php

namespace App\Http\Controllers\User\Edit;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\EditRequest;
use App\Models\Quser;

class EditPutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(EditRequest $request, string $userName)
    {
        //user情報を取得する
        $quser = Quser::where('user_name', $userName)->firstOrFail();

        //取得したuser情報を更新する
        $quser->display_name = $request->getDisplayName();
        $quser->profile = $request->getProfile();
        $quser->save();

        return redirect()->route('user.index', ['userName' => $userName]);
    }
}
