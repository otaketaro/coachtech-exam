@extends('layouts.app')

@section('title','Admin')
@section('body_class','is-admin-page')

{{-- 管理画面専用CSS --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

{{-- ヘッダー：中央「Admin」＋右上 logout（教材風） --}}
@section('header')
<div class="fl-admin-header">
    <h1 class="fl-admin-title">Admin</h1>
    @auth
    <form method="POST" action="{{ route('logout') }}" class="fl-logout-form">
        @csrf
        <button type="submit" class="fl-logout-btn">logout</button>
    </form>
    @endauth
</div>
@endsection

@section('content')
<div class="fl-admin">

    {{-- 検索フォーム（教材のUI） --}}
    <form method="GET" action="{{ route('admin.index') }}" class="fl-admin-search" id="adminSearch">
        <div class="fl-search-row">
            {{-- 1つの検索ボックス（名前/メールどちらでもOK） --}}
            <input type="text" id="q" class="fl-input fl-input--wide"
                placeholder="名前やメールアドレスを入力してください"
                value="{{ $search['name'] ?? $search['email'] ?? '' }}">
            {{-- コントローラ互換用 hidden（送信時に自動振り分け） --}}
            <input type="hidden" name="name" id="nameHidden" value="{{ $search['name'] ?? '' }}">
            <input type="hidden" name="email" id="emailHidden" value="{{ $search['email'] ?? '' }}">

            @php $g = $search['gender'] ?? 'all'; @endphp
            <select name="gender" class="fl-select">
                <option value="all" {{ $g==='all'?'selected':'' }}>性別</option>
                <option value="1" {{ (string)$g==='1'?'selected':'' }}>男性</option>
                <option value="2" {{ (string)$g==='2'?'selected':'' }}>女性</option>
                <option value="0" {{ (string)$g==='0'?'selected':'' }}>その他</option>
            </select>

            @php $cid = $search['category_id'] ?? 'all'; @endphp
            <select name="category_id" class="fl-select">
                <option value="all" {{ $cid==='all'?'selected':'' }}>お問い合わせの種類</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ (string)$cid===(string)$category->id?'selected':'' }}>
                    {{ $category->content }}
                </option>
                @endforeach
            </select>

            <input type="date" name="date" value="{{ $search['date'] ?? '' }}" class="fl-input fl-date">

            <button type="submit" class="fl-btn fl-btn-primary">検索</button>
            <a href="{{ route('admin.index') }}" class="fl-btn fl-btn-outline">リセット</a>
        </div>

        <div class="fl-export-wrap">
            <button type="submit" name="export" value="csv" class="fl-btn fl-btn-export">エクスポート</button>
        </div>
    </form>

    {{-- ページネーション（フォーム直下・コンパクト） --}}
    <div class="fl-admin-pagination fl-admin-pagination--compact">
        {{ $contacts->withQueryString()->onEachSide(1)->links('vendor.pagination.fl') }}
    </div>

    {{-- 一覧テーブル --}}
    <div class="fl-admin-tablewrap">
        <table class="fl-admin-table">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th class="fl-col-actions">詳細</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                <tr>
                    {{-- ★DBの格納が「first_name=苗字 / last_name=名前」想定で表示を入れ替える --}}
                    <td>{{ $contact->first_name }}　{{ $contact->last_name }}</td>
                    <td>{{ $contact->gender_text }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content ?? '-' }}</td>
                    <td class="fl-col-actions">
                        {{-- ★ 詳細モーダル起動ボタン（モーダルも苗字→名前に組み立てる） --}}
                        <a href="#"
                            class="fl-detail-btn js-open-detail"
                            data-id="{{ $contact->id }}"
                            data-first="{{ $contact->first_name }}" {{-- 苗字 --}}
                            data-last="{{ $contact->last_name }}" {{-- 名前 --}}
                            data-gender="{{ $contact->gender_text }}"
                            data-email="{{ $contact->email }}"
                            data-tel="{{ $contact->tel }}"
                            data-address="{{ $contact->address }}"
                            data-building="{{ $contact->building }}"
                            data-category="{{ $contact->category->content ?? '-' }}"
                            data-detail="{{ $contact->detail }}">
                            詳細
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="fl-empty">データがありません</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ===== モーダル（1つだけ置いて内容はJSで差し替え） ===== --}}
<div id="flModal" class="fl-modal" aria-hidden="true">
    <div class="fl-modal__backdrop js-close-modal" aria-hidden="true"></div>

    <div class="fl-modal__panel" role="dialog" aria-modal="true" aria-labelledby="flModalTitle">
        <button type="button" class="fl-modal__close js-close-modal" aria-label="閉じる">×</button>

        <h2 id="flModalTitle" class="fl-modal__title">お問い合わせ詳細</h2>

        <dl class="fl-modal__grid">
            <dt>お名前</dt>
            <dd id="m_name"></dd>
            <dt>性別</dt>
            <dd id="m_gender"></dd>
            <dt>メールアドレス</dt>
            <dd id="m_email"></dd>
            <dt>電話番号</dt>
            <dd id="m_tel"></dd>
            <dt>住所</dt>
            <dd id="m_address"></dd>
            <dt>建物名</dt>
            <dd id="m_building"></dd>
            <dt>お問い合わせの種類</dt>
            <dd id="m_category"></dd>
            <dt>お問い合わせ内容</dt>
            <dd id="m_detail" class="fl-pre"></dd>
        </dl>

        <div class="fl-show-actions">
            <form id="m_delete_form" method="POST" class="fl-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="fl-btn fl-btn-danger">削除</button>
            </form>
        </div>
    </div>
</div>

{{-- 名前/メールの自動振り分け + モーダル制御 --}}
<script>
    (function() {
        // 検索ボックスのname/email自動振り分け
        const form = document.getElementById('adminSearch');
        const q = document.getElementById('q');
        const nameH = document.getElementById('nameHidden');
        const emailH = document.getElementById('emailHidden');
        form.addEventListener('submit', function() {
            const v = (q.value || '').trim();
            if (v.includes('@')) {
                emailH.value = v;
                nameH.value = '';
            } else {
                nameH.value = v;
                emailH.value = '';
            }
        });

        // ===== モーダル制御 =====
        const modal = document.getElementById('flModal');
        const closeEls = modal.querySelectorAll('.js-close-modal');

        const fill = (d) => {
            // ★ 苗字(first) → 名前(last) の順で表示（DB格納の逆転に対応）
            const family = d.first || ''; // 苗字
            const given = d.last || ''; // 名前
            document.getElementById('m_name').textContent = `${family}　${given}`;
            document.getElementById('m_gender').textContent = d.gender || '';
            document.getElementById('m_email').textContent = d.email || '';
            document.getElementById('m_tel').textContent = d.tel || '';
            document.getElementById('m_address').textContent = d.address || '';
            document.getElementById('m_building').textContent = d.building || '';
            document.getElementById('m_category').textContent = d.category || '';
            document.getElementById('m_detail').textContent = d.detail || '';
            // 削除フォームのactionを対象IDに差し替え
            document.getElementById('m_delete_form').action = "{{ url('/admin') }}/" + (d.id || '');
        };

        const open = () => {
            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
        };
        const close = () => {
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
        };

        document.querySelectorAll('.js-open-detail').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                fill(btn.dataset);
                open();
            });
        });
        closeEls.forEach(el => el.addEventListener('click', close));
        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') close();
        });
    })();
</script>
@endsection