<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'last_name'   => 'required|string|max:255',
            'first_name'  => 'required|string|max:255',
            'gender'      => 'required|in:1,2,3',
            'email'       => 'required|email|max:255',
            'phone1'      => 'required|digits:3|numeric',
            'phone2'      => 'required|digits:4|numeric',
            'phone3'      => 'required|digits:4|numeric',
            'address'     => 'required|string|max:255',
            'building'    => 'nullable|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'detail'      => 'required|string|max:120',
        ];
    }
    public function messages()
    {
        return [
            'last_name.required'   => '姓を入力してください',
            'first_name.required'  => '名を入力してください',
            'gender.required'      => '性別を選択してください',
            'email.required'       => 'メールアドレスを入力してください',
            'email.email'          => 'メールアドレスはメール形式で入力してください',
            'phone1.required'      => '電話番号を入力してください',
            'phone1.numeric'       => '電話番号は半角数字で入力してください',
            'phone1.digits'        => '電話番号は3桁で入力してください',
            'phone2.required'      => '電話番号を入力してください',
            'phone2.numeric'       => '電話番号は半角数字で入力してください',
            'phone2.digits'        => '電話番号は4桁で入力してください',
            'phone3.required'      => '電話番号を入力してください',
            'phone3.numeric'       => '電話番号は半角数字で入力してください',
            'phone3.digits'        => '電話番号は4桁で入力してください',
            'address.required'     => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required'      => 'お問い合わせ内容を入力してください',
            'detail.max'           => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
