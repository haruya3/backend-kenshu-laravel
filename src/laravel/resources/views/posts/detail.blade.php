<h1>詳細ページ</h1>
<div>
    <a href="/posts">一覧ページ</a>
</div>
@if($isOwnPost)
    <div>
        <a href='/posts/{{ $post->id }}/edit'>編集画面</a>
        <form action="/posts/{{ $post->id }}" method="post">
            @csrf
            <input name='_method' hidden value="DELETE">
            <button type="submit">削除</button>
        </form>
    </div>
@endif
<div style="display: flex; justify-content: center; flex-direction: column; align-items: center;">
    <p style="width: 300px">{{ $post->title }}</p>
    <p style="background-color: darkgray; width: 600px; min-height: 200px; max-height: auto;">{{ $post->content }}</p>
    <img style='object-fit: contain;' alt='サムネイル画像' src="{{ asset('storage' . $post->thumnail_url) }}" width='200' height='200'>
    @foreach($images as $image)
        <img style='object-fit: contain;' alt='画像' src="{{ asset('storage' . $image->image_url) }}" width='200' height='200'>
    @endforeach
    @foreach($tags as $tag)
        <p>{{ $tag->name }}</p>
    @endforeach
</div>
