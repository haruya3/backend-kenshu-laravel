<h1>新規登録</h1>
@if ($errors->any())
    <div class="login_error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<script src="{{ asset('/js/image.js') }}"></script>
<div>
    <form action="/register" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">ユーザ名<br/>
            <input name="name" id="name" size="15" value="{{ old('name') }}" required>
        </label><br/>
        <label for="email">メールアドレス<br/>
            <input name="email" id="email" type="email" size="50" value="{{ old('email') }}" required>
        </label><br/>
        <label for="password">パスワード<br/>
            <input name="password" id="password" type="password" minlength="12" oninput="onInputPassword(this)" required>
        </label><br/>
        <div class="display-password-block">
            <p id="display-password" style="font-size: 15px; opacity: 0.7;"></p>
            <button type="button" onclick="onClickHiddenButton()">表示/非表示</button>
        </div>
        <label>パスワードの確認<br/>
            <input name="password_confirmation" type="password" required>
        </label><br/>
        <label for="profile-image">プロフィール画像<br/>
            <input name="profile-image" id="profile-image" type="file" onchange="onChangeLoadedImage(this, 'profile-image', 20)" accept='.jpg, .jpeg, .png' required>
        </label><br/>
        <div id="preview">
            <p>画像を選択してください(任意)</p>
        </div>
        <button type="submit">登録</button>
    </form>
</div>
