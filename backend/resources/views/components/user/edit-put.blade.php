@props([
    'userName'=>'',
    'displayName'=>'',
    'profile'=>'',
])

<form action="{{route('user.edit.put',['userName'=>$userName])}}" method="post">
    @method('PUT')
    @csrf
    <div class="mb-4">
        <label for="display_name" class="text-m text-gray-700 block mb-1 font-bold">
            表示名
        </label>
        <input type="text" name="display_name" id="display_name" class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700" placeholder="Enter your name" value="{{$displayName}}">
    </div>

    <div class="mb-4">
    <label for="profile" class="text-m text-gray-700 block mb-1 font-bold">
        自己紹介
    </label>
    <textarea
        rows="4"
        cols="50"
        name="profile"
        id="profile"
        value="testing"
        class="bg-gray-100 rounded border border-gray-200 py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700"
        placeholder="Enter your profile"
    >{{$profile}}</textarea>
    </div>

    <div class="mb-4">
        <label for="profile-image" class="text-m text-gray-700 block mb-1 font-bold">
            プロフィール画像
        </label>
        <!-- ここに画像アップロード機能を実装予定 -->
    </div>

    @error('display_name')
        <p style="color:red;">{{$message}}</p>
    @enderror
    @error('profile')
        <p style="color:red;">{{$message}}</p>
    @enderror

    <div class="flex justify-end">
        <x-element.button-post>変更を保存</x-element.button-post>
        <x-element.button-reset>リセット</x-element.button-reset>
    </div>
</form>