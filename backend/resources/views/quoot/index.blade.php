<x-layout>
    <x-header></x-header>
    <x-main>
        @if (\Illuminate\Support\Facades\Auth::check())
            <button onClick="location.href='/quoot/create'">Quoot作成画面へ</button>
            <button onClick="location.href='/user/{{rawurlencode($userName)}}'">マイページへ</button>
            <!-- フォロー中のみ表示チェックを設ける -->
            <form method="GET" action="/quoot" style="display: inline;">
                @csrf
                <input type="hidden" name="onlyFollowees" value="{{ $onlyFollowees ? '0' : '1' }}">
                <button type="submit">{{ $onlyFollowees ? '全てのQuootを表示' : 'フォロー中のユーザのQuootのみ表示' }}</button>
            </form>
        @else
            <button onClick="location.href='/login'">ログイン画面へ</button>
        @endif
        <x-quoot.list :quoots="$quoots" :onlyFollowees="$onlyFollowees"></x-quoot.list>
    </x-main>
</x-layout>

