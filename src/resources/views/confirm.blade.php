@extends('layouts.app')

@section('title', 'お問い合わせ確認')

@section('content')
<h1>Confirm</h1>
<form action="{{ route('store') }}" method="POST">
    @csrf
    <table class="confirm-table">
        <tr>
            <th>お名前</th>
            <td>{{ $contact['last_name'] }}　{{ $contact['first_name'] }}</td>
        </tr>
        <tr>
            <th>性別</th>
            <td>
                @if($contact['gender'] == 1)男性
                @elseif($contact['gender'] == 2)女性
                @elseその他
                @endif
            </td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td>{{ $contact['email'] }}</td>
        </tr>
        <tr>
            <th>電話番号</th>
            <td>{{ $contact['phone'] }}</td>
        </tr>
        <tr>
            <th>住所</th>
            <td>{{ $contact['address'] }}</td>
        </tr>
        <tr>
            <th>建物名</th>
            <td>{{ $contact['building'] }}</td>
        </tr>
        <tr>
            <th>お問い合わせの種類</th>
            <td>
                @if(isset($contact['category_id']))
                @if($contact['category_id'] == 1) 商品について
                @elseif($contact['category_id'] == 2) サービスについて
                @else その他
                @endif
                @else
                未選択
                @endif
            </td>
        </tr>
        <tr>
            <th>お問い合わせ内容</th>
            <td>{!! nl2br(e($contact['detail'])) !!}</td>
        </tr>
    </table>

    {{-- hiddenで送信処理の際にデータを渡す --}}
    @foreach($contact as $key => $value)
    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach

    <div class="button-group">
        <button type="submit" name="action" value="send">送信</button>
        <button type="submit" name="action" value="back">修正</button>
    </div>
</form>
@endsection