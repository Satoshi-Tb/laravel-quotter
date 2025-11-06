@props([
    'users'=>[],
])

<div class="bg-white rounded-md shadow-lg mt-5 mb-5 ">
    <ul>
        @foreach($users as $user)
            <li class="border-b last:border-0 border-gray-200 p-4">
                <div class="flex">
                    @if ($user->getImagePath())
                        <img src="{{ asset('storage/' . $user->getImagePath()) }}" alt="プロフィール画像" class="w-12 h-12 rounded-full object-cover">
                    @else
                        <img src="{{ asset('storage/default_profile_icon.png') }}" alt="プロフィール画像" class="w-12 h-12 rounded-full object-cover">
                    @endif
                    <div class="ml-8">
                        <p class="text-xl"><a href="/user/{{$user->user_name}}">{{$user->display_name}}</a></p>
                        <p>{!!nl2br(e($user->profile))!!}</p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>