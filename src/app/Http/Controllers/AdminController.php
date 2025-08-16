<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::with('category');

        // 名前検索（姓、名、フルネーム）
        if ($name = $request->get('name')) {
            $query->where(function ($q) use ($name) {
                $q->where('first_name', 'like', "%{$name}%")
                    ->orWhere('last_name', 'like', "%{$name}%")
                    ->orWhereRaw("CONCAT(first_name, last_name) like ?", ["%{$name}%"]);
            });
        }

        // メール検索
        if ($email = $request->get('email')) {
            $query->where('email', 'like', "%{$email}%");
        }

        // 性別検索
        if (($gender = $request->get('gender')) && $gender !== 'all') {
            $query->where('gender', $gender);
        }

        // カテゴリー検索
        if (($category_id = $request->get('category_id')) && $category_id !== 'all') {
            $query->where('category_id', $category_id);
        }

        // 日付検索
        if ($date = $request->get('date')) {
            $query->whereDate('created_at', $date);
        }

        // CSVエクスポート（Shift-JIS変換で文字化け防止）
        if ($request->get('export') === 'csv') {
            $contacts = $query->get();
            $filename = 'contacts_export_' . date('Ymd_His') . '.csv';
            $headers = ['Content-Type' => 'text/csv'];

            $columns = ['ID', '姓', '名', '性別', 'メール', '電話番号', '住所', '建物', 'お問い合わせ種類', '詳細', '作成日'];

            $callback = function () use ($contacts, $columns) {
                $file = fopen('php://output', 'w');

                // ヘッダーをShift-JISに変換
                fputcsv($file, array_map(function ($col) {
                    return mb_convert_encoding($col, 'SJIS-win', 'UTF-8');
                }, $columns));

                foreach ($contacts as $c) {
                    fputcsv($file, array_map(function ($value) {
                        return mb_convert_encoding($value, 'SJIS-win', 'UTF-8');
                    }, [
                        $c->id,
                        $c->first_name,
                        $c->last_name,
                        $c->gender_text,
                        $c->email,
                        $c->tel,
                        $c->address,
                        $c->building,
                        $c->category->content ?? '-',
                        $c->detail,
                        $c->created_at,
                    ]));
                }

                fclose($file);
            };

            return Response::stream($callback, 200, $headers)->send();
        }

        $contacts = $query->paginate(7)->withQueryString();
        $categories = Category::all();

        return view('admin.index', [
            'contacts' => $contacts,
            'search' => $request->all(),
            'categories' => $categories,
        ]);
    }

    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        return view('admin.show', compact('contact'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('admin.index')->with('message', 'お問い合わせを削除しました。');
    }
}
