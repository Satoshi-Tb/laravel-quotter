<x-layout>
    <x-header></x-header>
    <x-main>
        <div class="h-8"></div>
        <div class="flex justify-between">
            <div class="flex items-center">
                @if ($imagePath)
                    <img src="{{ asset('storage/' . $imagePath) }}" alt="プロフィール画像" class="w-20 h-20 rounded-full object-cover">
                @else
                    <img src="{{ asset('storage/default_profile_icon.png') }}" alt="プロフィール画像" class="w-20 h-20 rounded-full object-cover">
                @endif
                <div class="ml-8">
                    <h2 class="text-3xl font-bold mb-4">{{$displayName}}</h2>
                    <p>{!!nl2br(e($profile))!!}</p>
                </div>
            </div>
            <div>
                <ul class="flex space-x-4">
                    <li><a href="{{route('user.follows',['userName'=>$userName])}}" class="text-center text-gray-500 hover:text-black">Follows</a></li>
                    <li><a href="{{route('user.followers',['userName'=>$userName])}}" class="text-center text-gray-500 hover:text-black">Followers</a></li>
                </ul>
            </div>
        </div>

        <div class="flex flex-wrap justify-center">
            @if (!$isMyPage)
                @if (!$hasFollowed)
                    <div>
                        <form action="/user/{{$userName}}/follow" method="post">
                            @csrf
                            <x-element.button-post>フォローする</x-element.button-post>
                        </form>
                    </div>
                @else
                    <div>
                        <form action="/user/{{$userName}}/follow" method="post">
                            @method('DELETE')
                            @csrf
                            <x-element.button-post>フォロー解除</x-element.button-post>
                        </form>
                    </div>
                @endif
                <div>
                    <form action="/user/{{$userName}}/chat" method="post">
                        @csrf
                        <x-element.button-post>チャットを開始</x-element.button-post>
                    </form>
                </div>
            @else
                <x-element.link-get :href="route('user.edit',['userName'=>$userName])">プロフィールを編集</x-element.link-get>
            @endif
        </div>
        @php
            $redirectUrl = isset($userName) ? '/user/' . $userName : '/quoot';
        @endphp
        <x-quoot.list :quoots="$quoots" :redirect="$redirectUrl"></x-quoot.list>
    </x-main>    
    
</x-layout>