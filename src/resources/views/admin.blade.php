@extends('layouts.app')

@section('title', 'Admin')

@section('content')
<div class="admin-container">
    <h1>Admin</h1>

    <!-- 検索フォーム -->
    <form action="{{ route('admin.index') }}" method="GET" class="search-form">
        @csrf
        <div class="admin-filter">
            <!-- 名前・メールアドレス検索 -->
            <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">

            <!-- 性別検索 -->
            <select name="gender">
                <option value="">性別</option>
                <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>全て</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>

            <!-- お問い合わせの種類 -->
            <select name="category">
                <option value="">お問い合わせの種類</option>
                <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>全て</option>
                <option value="1" {{ request('category') == '1' ? 'selected' : '' }}>商品の交換について</option>
                <option value="2" {{ request('category') == '2' ? 'selected' : '' }}>サービスの不具合</option>
                <option value="3" {{ request('category') == '3' ? 'selected' : '' }}>その他</option>
            </select>

            <!-- 日付検索 -->
            <input type="date" name="date" value="{{ request('date') }}">

            <!-- 検索・リセットボタン -->
            <button type="submit" class="search-btn">検索</button>
            <button type="button" class="reset-btn" onclick="location.href='{{ route('admin.index') }}'">リセット</button>


        </div>
    </form>

    <!-- エクスポートボタン -->
    <form action="{{ route('admin.export') }}" method="GET" class="export-form">
        <input type="hidden" name="keyword" value="{{ request('keyword') }}">
        <input type="hidden" name="gender" value="{{ request('gender') }}">
        <input type="hidden" name="category" value="{{ request('category') }}">
        <input type="hidden" name="date" value="{{ request('date') }}">

        <button type="submit" class="export-btn">エクスポート</button>
    </form>

    <!-- データ一覧 -->
    <table class="admin-table">
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>
                    @if($contact->gender == 1)男性
                    @elseif($contact->gender == 2)女性
                    @elseその他
                    @endif
                </td>
                <td>{{ $contact->email }}</td>
                <td>
                    @if($contact->category_id == 1)商品の交換について
                    @elseif($contact->category_id == 2)サービスの不具合
                    @elseその他
                    @endif
                </td>
                <td><!-- 詳細ボタン（labelタグに変更） -->
                    <input type="checkbox" id="detail-{{ $contact->id }}" class="modal-toggle" hidden>
                    <label for="detail-{{ $contact->id }}" class="detail-btn">詳細</label>

                    <!-- モーダル本体 -->
                    <div class="modal">
                        <div class="modal-content">
                            <label for="detail-{{ $contact->id }}" class="close-btn">&times;</label>
                            <h2>お問い合わせ詳細</h2>
                            <table class="modal-table">
                                <tr>
                                    <th>お名前</th>
                                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                                </tr>
                                <tr>
                                    <th>性別</th>
                                    <td>{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</td>
                                </tr>
                                <tr>
                                    <th>メールアドレス</th>
                                    <td>{{ $contact->email }}</td>
                                </tr>
                                <tr>
                                    <th>電話番号</th>
                                    <td>{{ $contact->phone }}</td>
                                </tr>
                                <tr>
                                    <th>住所</th>
                                    <td>{{ $contact->address }}</td>
                                </tr>
                                <tr>
                                    <th>建物名</th>
                                    <td>{{ $contact->building }}</td>
                                </tr>
                                <tr>
                                    <th>お問い合わせの種類</th>
                                    <td>{{ $contact->category_id == 1 ? '商品の交換について' : ($contact->category_id == 2 ? 'サービスの不具合' : 'その他') }}</td>
                                </tr>
                                <tr>
                                    <th>お問い合わせ内容</th>
                                    <td>{{ $contact->detail }}</td>
                                </tr>
                            </table>
                            <form action="{{ route('admin.destroy', $contact->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="delete-btn">削除</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ページネーション -->
    <div class="pagination">
        {{ $contacts->links() }}
    </div>
</div>


@endsection