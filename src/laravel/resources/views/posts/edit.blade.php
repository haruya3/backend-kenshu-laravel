<div>
    <form action="/posts/{{ $post->id }}" method='post' enctype="multipart/form-data">
        @method('patch')
        @csrf
        <input name='_method' hidden value='PUT'>
        <label>
            タイトル<br/>
            <input name='title' type='text' value="{{ $post->title }}" required>
        </label><br/>
        <label>本文<br/>
            <textarea name='content' required>{{ $post->content }}</textarea><br/>
        </label>
        <button type='submit'>更新</button>
    </form>
</div>
