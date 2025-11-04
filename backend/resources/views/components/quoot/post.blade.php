<form action="/quoot/create" method="post">
    @csrf
    <textarea 
        id="quoot-content" 
        rows="3"
        type="text" 
        name="quoot"
        class="focus:ring-blue-400 focus:border-blue-400 mt-1 block w-full text:text-sm border border-gray-300 rounded-md p-2"
        placeholder="つぶやきを入力"></textarea>
    @error('quoot')
        <p style="color:red;">{{$message}}</p>
    @enderror
    <div class="flex flex-wrap justify-end gap-1">
        <x-element.button-post>投稿</x-element.button-post>
        <x-element.button-reset>リセット</x-element.button-reset>
        <x-element.button-return :href="url('/quoot')" />
    </div>
</form>
