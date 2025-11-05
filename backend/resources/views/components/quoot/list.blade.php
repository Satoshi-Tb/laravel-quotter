@props([
    'quoots' => [],
    'redirect' => '/quoot',
])

<div class="bg-white rounded-md shadow-lg mt-5 mb-5 overflow-auto">
    <ul>
        @foreach($quoots as $quoot)
            <li class="border-b last:border-0 border-gray-200 p-4">
                <span class="inline-block rounded-full px-2 py-1 text-s font-bold mb-1">
                    <a href="{{route('user.index',['userName'=>$quoot->getUserName()])}}">{{$quoot->getDisplayName()}}</a> 
                </span>
                
                <p class="text-gray-600 px-2 mb-1">{!!nl2br(e($quoot->content))!!}</p>
                <p class="text-xs text-right">posted on {{$quoot->created_at}}</p>
                
                @if(\Illuminate\Support\Facades\Auth::id() === $quoot->user_id)
                    <div class="mt-2 text-xs text-right">
                        <button onClick="location.href='{{ route('quoot.update', ['quootId' => $quoot->id, 'redirect' => $redirect]) }}'">更新</button>
                        <form style="display:inline" action="{{ route('quoot.delete', ['quootId' => $quoot->id, 'redirect' => $redirect]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                        </form>
                    </div>
                @endif
                
            </li>
        @endforeach
    </ul>
</div>
