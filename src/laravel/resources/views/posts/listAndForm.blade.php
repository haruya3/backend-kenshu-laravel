<h1>投稿フォームと投稿リスト</h1>
@if ($errors->any())
    <div class="login_error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<header>
    <img style='object-fit: contain;' alt='プロフィール画像' src={{ asset('storage' . $user->profile_image_url) }} width='100' height='100'>
    <p>{{ $user->name }}さんこんにちわ</p>
</header>
<div>

    <div>
        <form action='/posts' method='post' enctype="multipart/form-data">
            @csrf
            <label>
                タイトル<br/>
                <input name='title' type='text' required><br/>
            </label>画像<br/>
            <label style='padding: 5px 10px; color: #ffffff; background-color: #384878; cursor: pointer;'>
                <input style='display: none;' id='image-upload' name='image[]' onchange="onChangeLoadedImage(this, 'image-upload', $maxFileSizeOnUpload)" type='file' accept='.jpg, .jpeg, .png' multiple required>ファイルを選択
            </label><br/>
            <div id="preview">
                <p>サムネイルにしたい画像を最初に選択してください</p>
            </div>
            <label>本文<br/>
                <textarea name='content' required></textarea><br/>
            </label>
            <label>タグ<br/>
                <select name='tag[]' multiple>
                    @foreach(\App\Models\Tag::TAG_NAME_LIST as $tagName)
                        <option name='tag' value='{{ $tagName }}'>{{ $tagName }}</option>
                    @endforeach
                </select>
            </label><br/>
            <button type='submit'>送信</button>
        </form>
    </div>


    <ul style="height: auto; width: 300px">
        @foreach ($posts as $post)
            <li style="height: auto; width: 250px">
                <a href=/posts/{{ $post->id }}>{{ $post->title }}</a><br/>
                <p>サムネイル画像</p>
                <img style='object-fit: contain;' alt='サムネイル画像' src={{ asset('storage' . $post->thumnail_url) }} width='200' height='200'><br/>
                <div>
                @foreach($images[$post->id] as $image)
                    <img style='object-fit: contain;' alt='画像' src={{ asset('storage' . $image->image_url) }} width='200' height='200'><br/>
                @endforeach
                </div>
                @foreach($tags[$post->id] as $tag)
                    <p>{{ $tag->name }}</p>
                @endforeach
            </li>
        @endforeach
    </ul>
</div>
