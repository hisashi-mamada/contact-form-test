@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<div class="login-container">
    <h1>Login</h1>

    <!-- エラーメッセージ表示 -->
    @if(session('error'))
    <p class="error-message">{{ session('error') }}</p>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
            @error('email')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" placeholder="例: coachtech1106">
            @error('password')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="login-button">ログイン</button>
    </form>
</div>
@endsection
