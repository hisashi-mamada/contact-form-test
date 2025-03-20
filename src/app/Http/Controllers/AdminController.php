<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContactsExport;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', "%{$request->keyword}%")
                    ->orWhere('last_name', 'like', "%{$request->keyword}%")
                    ->orWhere('email', 'like', "%{$request->keyword}%");
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->orderBy('created_at', 'desc')->paginate(7)->withQueryString();

        return view('admin', compact('contacts'));
    }

    // お問い合わせの詳細表示
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin_show', compact('contact'));
    }

    // 編集画面の表示
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin_edit', compact('contact'));
    }

    // 更新処理
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update($request->all());
        return redirect()->route('admin.index')->with('success', '更新しました');
    }

    // 削除処理
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin.index')->with('success', '削除しました');
    }

    public function export(Request $request)
    {
        // CSVのヘッダー
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ];

        // StreamedResponseでCSVを生成
        return new StreamedResponse(function () use ($request) {

            // CSVの書き込み準備
            $handle = fopen('php://output', 'w');

            // Excelで文字化けしないようBOM追加（UTF-8対応）
            fwrite($handle, "\xEF\xBB\xBF");

            // CSVの列名（ヘッダー）
            fputcsv($handle, [
                '名前',
                '性別',
                'メールアドレス',
                '電話番号',
                '住所',
                '建物名',
                'お問い合わせの種類',
                'お問い合わせ内容',
                '登録日'
            ]);

            // 絞り込み条件の処理（検索条件に合わせてデータ取得）
            $query = Contact::query();

            if ($request->filled('keyword')) {
                $query->where(function ($q) use ($request) {
                    $q->where('last_name', 'like', "%{$request->keyword}%")
                        ->orWhere('first_name', 'like', "%{$request->keyword}%")
                        ->orWhere('email', 'like', "%{$request->keyword}%");
                });
            }

            if ($request->filled('gender') && $request->gender !== 'all') {
                $query->where('gender', $request->gender);
            }

            if ($request->filled('category') && $request->category !== 'all') {
                $query->where('category_id', $request->category);
            }

            if ($request->filled('date')) {
                $query->whereDate('created_at', $request->date);
            }

            // 取得したデータを順にCSVに書き込む
            $contacts = $query->get();

            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->last_name . ' ' . $contact->first_name,
                    ($contact->gender == 1) ? '男性' : (($contact->gender == 2) ? '女性' : 'その他'),
                    $contact->email,
                    $contact->phone,
                    $contact->address,
                    $contact->building,
                    ($contact->category_id == 1 ? '商品の交換について' : ($contact->category_id == 2 ? 'サービスの不具合' : 'その他')),
                    $contact->detail,
                    $contact->created_at->format('Y-m-d'),
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }
}
