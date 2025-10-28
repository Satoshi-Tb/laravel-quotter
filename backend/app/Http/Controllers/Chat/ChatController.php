<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;
use App\Models\Quser;
use App\Models\Message;

class ChatController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $chatId)
    {
        $userId = Auth::id();
        // チャットIDからチャットルームの情報を取得する
        $chat = Chat::where('id', $chatId)->firstOrFail();
        // チャットルームに参加しているユーザーか確認する
        if ($chat->user1_id === $userId || $chat->user2_id === $userId) {
            // ユーザー情報取得
            $user1 = Quser::where('id', $chat->user1_id)->firstOrFail();
            $user2 = Quser::where('id', $chat->user2_id)->firstOrFail();
            $users = array($user1->display_name, $user2->display_name);
            // メッセージ情報取得.生成時刻の昇順で取得
            $messages = Message::where('chat_id', $chatId)->orderBy('created_at', 'asc')->get();
            return view('chat.index')->with([
                'chatId' => $chatId,
                'users' => $users,
                'messages' => $messages,
            ]);
        } else {
            abort(403);
        }
    }
}
