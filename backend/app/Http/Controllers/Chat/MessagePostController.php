<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\Message\CreateRequest;
use App\Models\Message;
use App\Models\Chat;

class MessagePostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateRequest $request, string $chatId)
    {
        $messageContent = $request->getMessage();
        $userId = $request->getUserId();
        $chatIdInt = (int) $chatId;
        $chat = Chat::where('id', $chatIdInt)->firstOrFail();

        // チャットルームに参加しているユーザーか確認する
        if (!($chat->user1_id === $userId || $chat->user2_id === $userId)) {
            abort(403);
        }
        // メッセージの保存処理
        $message = new Message();
        $message->chat_id = $chatIdInt;
        $message->mentioned_user_id = $userId;
        $message->content = $messageContent;
        $message->save();

        return redirect()->route('chat.index', ['chatId' => $chatIdInt]);
    }
}
