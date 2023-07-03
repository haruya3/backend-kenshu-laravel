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
    <img style='object-fit: contain;' alt='サムネイル画像' src={{ $user->profile_image_url }} width='100' height='100'>
    <p>{{ $user->name }}さんこんにちわ</p>
</header>
<div>

    <div>
        <form action='/posts' method='post' enctype="multipart/form-data">
            <label>
                タイトル<br/>
                <input name='title' type='text' required>
            </label><br/>
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
                <input name="tag" type="text">
            </label><br/>
            <button type='submit'>送信</button>
        </form>
    </div>


    <ul style="height: auto; width: 300px">
        @foreach ($posts as $post)
            <li style="height: auto; width: 250px">
                <a href=/posts/{{ $post->id }}>{{ $post->title }}</a><br/>
                <img style='object-fit: contain;' alt='サムネイル画像' src={{ $post->thumnail_url }} width='200' height='200'><br/>
    {{--            @foreach($post)--}}
    {{--                <img style='object-fit: contain;' alt='サムネイル画像' src={{ $ }} width='200' height='200'><br/>--}}
    {{--            @endforeach--}}
    {{--            self::get_img_elements_by_post($get_post_list_service_dto->data_linked_post->images, $post->id)--}}
    {{--            self::get_p_elements_about_tag_by_post($get_post_list_service_dto->data_linked_post->tags, $post->id);--}}
            </li>
        @endforeach

    </ul>
</div>
