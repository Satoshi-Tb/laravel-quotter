<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\Message\CreateRequest;
use App\Models\Message;

class MessagePostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateRequest $request, string $chatId)
    {
        $messageContent = $request->getMessage();
        $userId = $request->getUserId();

        // メッセージの保存処理
        $message = new Message();
        $message->chat_id = $chatId;
        $message->mentioned_user_id = $userId;
        $message->content = $messageContent;
        $message->save();

        return redirect()->route('chat.index', ['chatId' => $chatId]);
    }
}
