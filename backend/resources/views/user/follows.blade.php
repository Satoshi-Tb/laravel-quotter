<x-layout>
    <x-header></x-header>
    <x-main>
        <div class="flex justify-center">
            <h2 class="text-lg font-bold mb-4">{{$userName}} さんがフォロー中</h2>
        </div>
        <x-user.list :users="$followedUsers"></x-user.list>
    </x-main>
</x-layout>
