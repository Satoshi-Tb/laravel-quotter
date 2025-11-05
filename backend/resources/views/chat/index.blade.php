<x-layout>
    <x-header></x-header>
    <x-main>
        <p>{{$users[0]}}と{{$users[1]}}のチャット部屋</p>
        <!-- メッセージ一覧 -->
        <x-chat.list :messages="$messages" ></x-chat.list>
        <!-- メッセージ投稿 -->
        <script src="{{ asset('/js/scroll.js') }}"></script>
        <x-chat.post :chatId="$chatId"></x-chat.post>
    </x-main>
</x-layout>
