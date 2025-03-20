@extends('layouts.app')

@section('title', '送信完了')

@section('content')
<div class="thanks-container">
    <div class="thanks-message">
        お問い合わせありがとうございました
    </div>
    <a href="{{ url('/') }}" class="home-button">HOME</a>
</div>
@endsection