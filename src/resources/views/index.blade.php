@extends('layouts.app')

@section('content')
<h2>Contact</h2>
<form action="/contacts/confirm" method="POST">
    @csrf

    <!-- お名前 -->
    <div class="form-group">
        <label class="label" for="last_name">お名前 <span class="required">※</span></label>
        <div class="name-group">
            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="例: 山田">
            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="例: 太郎">
        </div>
        @error('last_name') <p class="error-message">{{ $message }}</p> @enderror
        @error('first_name') <p class="error-message">{{ $message }}</p> @enderror
    </div>

    <!-- 性別 -->
    <div class="form-group">
        <label class="label">性別 <span class="required">※</span></label>
        <div class="radio-group">
            <input type="radio" id="gender_male" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}>
            <label for="gender_male">男性</label>

            <input type="radio" id="gender_female" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>
            <label for="gender_female">女性</label>

            <input type="radio" id="gender_other" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>
            <label for="gender_other">その他</label>
        </div>
        @error('gender') <p class="error-message">{{ $message }}</p> @enderror
    </div>


    <!-- 電話番号 -->
    <div class="form-group">
        <label class="label" for="phone">電話番号 <span class="required">※</span></label>
        <div class="phone-group">
            <input type="number" id="phone1" name="phone1" value="{{ old('phone1') }}" maxlength="3" placeholder="080">
            <span>-</span>
            <input type="number" id="phone2" name="phone2" value="{{ old('phone2') }}" maxlength="4" placeholder="1234">
            <span>-</span>
            <input type="number" id="phone3" name="phone3" value="{{ old('phone3') }}" maxlength="4" placeholder="5678">
        </div>
        @error('phone1') <p class="error-message">{{ $message }}</p> @enderror
        @error('phone2') <p class="error-message">{{ $message }}</p> @enderror
        @error('phone3') <p class="error-message">{{ $message }}</p> @enderror
    </div>


    <div class="form-group">
        <label class="label" for="email">メールアドレス <span class="required">※</span></label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
        @error('email')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label class="label" for="address">住所 <span class="required">※</span></label>
        <input type="text" id="address" name="address" value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
        @error('address')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label class="label" for="building">建物名</label>
        <input type="text" id="building" name="building" value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101">
        @error('building')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <!-- お問い合わせの種類 -->
    <div class="form-group">
        <label class="label" for="category_id">お問い合わせの種類<span class="required">※</span></label>
        <select id="category_id" name="category_id">
            <option value="" disabled {{ old('category_id') == '' ? 'selected' : '' }}>選択してください</option>
            <option value="1" {{ old('category_id') == '1' ? 'selected' : '' }}>商品について</option>
            <option value="2" {{ old('category_id') == '2' ? 'selected' : '' }}>サービスについて</option>
            <option value="3" {{ old('category_id') == '3' ? 'selected' : '' }}>その他</option>
        </select>
        @error('category_id') <p class="error-message">{{ $message }}</p> @enderror
    </div>


    <div class="form-group">
        <label for="detail">お問い合わせ内容 <span class="required">※</span></label>
        <textarea id="detail" name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
        @error('detail')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">確認画面</button>
</form>
@endsection
