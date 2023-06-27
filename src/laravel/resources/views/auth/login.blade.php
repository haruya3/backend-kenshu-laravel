<h1>ログイン</h1>
@if ($errors->any())
<div class="login_error">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div>
    <header>
        <p>まだ登録がお済みでない方はこちらから</p>
        <a href="/register">ユーザ登録</a>
    </header>
    <form action="/login" method="post">
        <label for="email">email<br/>
            <input type="email" name="email" required>
        </label><br/>
        <label for="password">password<br/>
            <input type="password" name="password" required>
        </label><br/>
        <button type="submit">ログイン</button>
    </form>
</div>
