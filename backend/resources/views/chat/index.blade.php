<x-layout>
    <x-header></x-header>
    <x-main>
        <p>{{$users[0]}}と{{$users[1]}}のチャット部屋</p>
        <!-- メッセージ投稿 -->
        <x-chat.post :chatId="$chatId"></x-chat.post>

        <h3>メッセージ一覧</h3>
        <x-chat.list :messages="$messages" ></x-chat.list>
    </x-main>
</x-layout>
