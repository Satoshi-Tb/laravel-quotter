@props(['href' => null])

<button 
type="button"
@if($href) onclick="window.location.href={{ json_encode($href) }}" @endif
class="py-1.5 px-4 bg-gray-50 hover:bg-gray-100 active:bg-gray-200 rounded-lg ml-4 mt-4 mb-4">
    戻る
</button>
