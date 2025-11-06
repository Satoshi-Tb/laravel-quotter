<?php

namespace App\Http\Controllers\User\Edit;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\EditRequest;
use App\Models\Quser;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

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

        // プロフィール画像がアップロードされた場合の処理
        if ($request->getProfileImage()) {
            // 画像をストレージに保存
            $str = Storage::disk('public')->putFile('', $request->getProfileImage());

            // プロフィール画像パスを保存
            $image = new Image();
            $image->path = $str;
            $image->save();

            // 既存のプロフィール画像情報取得
            $oldImage = $quser->profile_image_id ? Image::where('id', $quser->profile_image_id)->first() : null;

            // Quserモデルのprofile_image_idを更新
            $quser->profile_image_id = $image->id;
            $quser->save();

            // 既存のプロフィール画像がある場合は削除
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage->path);
                $oldImage->delete();
            }
        } else {
            $quser->save();
        }

        return redirect()->route('user.index', ['userName' => $userName]);
    }
}
