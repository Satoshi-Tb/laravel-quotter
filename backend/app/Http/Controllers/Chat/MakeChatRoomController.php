<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;
use App\Models\Quser;

class MakeChatRoomController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $userName)
    {
        $user1 = Auth::id();
        $user2 = Quser::where('user_name', $userName)->firstOrFail()->id;

        // user1のidの方が小さくなるように、idを並べ替える
        if ($user1 > $user2) {
            $temp = $user1;
            $user1 = $user2;
            $user2 = $temp;
        }

        // すでにチャットルームが存在するか確認する
        $room = Chat::where([['user1_id', $user1],['user2_id', $user2]])->first();
        if ($room) {
            // すでにチャットルームが存在する場合、そのチャットルームへリダイレクトする
            return redirect()->route('chat.index', ['chatId' => $room->id]);
        } else {
            // チャットルームが存在しない場合、新規作成してそのチャットルームへリダイレクトする
            $newChat = new Chat();
            $newChat->user1_id = $user1;
            $newChat->user2_id = $user2;
            $newChat->save();
            return redirect()->route('chat.index', ['chatId' => $newChat->id]);
        }
    }
}
