<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori - CampRent</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --cream: #f5f1e8;
            --white: #fffefa;
            --forest: #244b38;
            --forest-dark: #193a2b;
            --text: #26392e;
            --muted: #7b817a;
            --border: #e4e2d9;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            background: var(--cream);
            color: var(--text);
            font-family: 'Inter', sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button, input {
            font: inherit;
        }

        .main {
            min-height: 100vh;
            margin-left: 250px;
            padding: 32px 38px 28px;
        }

        #kategori-content {
            animation: contentEnter .3s ease-out;
        }

        @keyframes contentEnter {
            from {
                opacity: 0;
                transform: translateY(6px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            #kategori-content {
                animation: none;
            }
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 23px;
            font-weight: 800;
            letter-spacing: -.6px;
        }

        .page-subtitle {
            margin-top: 7px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .panel {
            padding: 25px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: var(--white);
        }

        .panel-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 22px;
        }

        .panel-heading h2 {
            font-size: 17px;
            letter-spacing: -.3px;
        }

        .panel-heading p {
            margin-top: 7px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .notif {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
            padding: 12px 15px;
            border-radius: 10px;
            font-size: 12px;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        .notif-success {
            border: 1px solid #cfe0cc;
            background: #edf5e9;
            color: #315b3d;
        }

        .notif-error {
            border: 1px solid #ead0cb;
            background: #f8eeeb;
            color: #984c43;
        }

        .notif {
            max-height: 100px;
            overflow: hidden;
            transition: opacity .4s ease, transform .4s ease, margin .4s ease, padding .4s ease, max-height .4s ease;
        }

        .notif.is-hiding {
            opacity: 0;
            transform: translateY(-5px);
            max-height: 0;
            margin-bottom: 0;
            padding-top: 0;
            padding-bottom: 0;
        }

        .notif-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            font-size: 12px;
            font-weight: 800;
        }

        .notif-success .notif-icon {
            background: #d6e9d1;
            color: #315b3d;
        }

        .notif-error .notif-icon {
            background: #f0d8d3;
            color: #984c43;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 40px;
            padding: 10px 15px;
            border: 1px solid transparent;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .btn-primary {
            background: var(--forest);
            color: white;
        }

        .btn-primary:hover {
            background: var(--forest-dark);
        }

        .btn-light {
            border-color: var(--border);
            background: var(--white);
            color: var(--text);
        }

        .btn-light:hover {
            background: var(--cream);
        }

        .btn-edit {
            padding: 8px 11px;
            background: #eaf0e8;
            color: var(--forest);
        }

        .btn-edit:hover {
            background: #dce8d9;
        }

        .btn-delete {
            padding: 8px 11px;
            background: #f8eeeb;
            color: #984c43;
        }

        .btn-delete:hover {
            background: #f2dfda;
        }

        .table-wrap {
            overflow-x: auto;
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead {
            background: #f9f8f2;
        }

        th {
            padding: 15px 18px;
            color: #737b70;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .6px;
            white-space: nowrap;
        }

        td {
            padding: 16px 18px;
            border-top: 1px solid var(--border);
            font-size: 12px;
            line-height: 1.7;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #fcfbf7;
        }

        .number {
            width: 70px;
            color: var(--muted);
        }

        .category-name {
            font-weight: 700;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .delete-form {
            display: inline;
            margin: 0;
        }

        .empty-state {
            padding: 35px 20px;
            color: var(--muted);
            text-align: center;
            line-height: 1.8;
        }

        .footer {
            margin-top: 35px;
            padding-top: 18px;
            border-top: 1px solid #e0ddd3;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(35, 43, 55, .48);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        .modal-overlay.show {
            display: flex;
        }

        .modal {
            width: 100%;
            max-width: 448px;
            max-height: calc(100vh - 40px);
            overflow-y: auto;
            border: 1px solid rgba(255, 255, 255, .7);
            border-radius: 23px;
            background: #fff;
            box-shadow: 0 24px 65px rgba(20, 35, 30, .2);
            animation: modal-in .2s ease-out;
        }

        @keyframes modal-in {
            from {
                opacity: 0;
                transform: translateY(10px) scale(.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 25px 24px;
            border-bottom: 1px solid #f0f1f3;
        }

        .modal-title {
            color: #263449;
            font-size: 17px;
            font-weight: 800;
            letter-spacing: -.4px;
        }

        .modal-close {
            display: grid;
            place-items: center;
            width: 30px;
            height: 30px;
            border: 0;
            border-radius: 8px;
            background: transparent;
            color: #94a3b8;
            font-size: 23px;
            cursor: pointer;
        }

        .modal-close:hover {
            background: #f1f5f9;
            color: #334155;
        }

        .modal-body {
            padding: 24px;
        }

        .form-group {
            margin-bottom: 26px;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            color: #71829d;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .form-input {
            display: block;
            width: 100%;
            min-height: 43px;
            padding: 11px 13px;
            border: 1px solid #e5ebf2;
            border-radius: 9px;
            outline: none;
            background: #f8fafc;
            color: #263449;
            font-size: 13px;
            transition: .2s;
        }

        .form-input::placeholder {
            color: #8792a3;
        }

        .form-input:focus {
            border-color: #8aa795;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(36, 75, 56, .08);
        }

        .form-error {
            margin-top: 8px;
            color: #b42318;
            font-size: 11px;
            line-height: 1.6;
        }

        .alert-error {
            margin-bottom: 18px;
            padding: 12px 13px;
            border: 1px solid #f2ceca;
            border-radius: 9px;
            background: #fff3f1;
            color: #984c43;
            font-size: 12px;
            line-height: 1.7;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
        }

        .modal-actions .btn {
            flex: 1;
            min-height: 43px;
            border-radius: 12px;
            font-size: 12px;
        }

        .modal-actions .btn-light {
            border-color: #e4eaf2;
            background: #fff;
            color: #34445c;
        }

        .modal-actions .btn-light:hover {
            background: #f8fafc;
        }

        .modal-actions .btn-primary {
            border-color: var(--forest);
            background: var(--forest);
        }

        .modal-actions .btn-primary:hover {
            background: var(--forest-dark);
        }

        .warning-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 55px;
            height: 55px;
            margin: 0 auto 18px;
            border-radius: 50%;
            background: #fff1e6;
            color: #c47732;
            font-size: 26px;
            font-weight: 800;
        }

        .warning-message {
            margin-bottom: 22px;
            color: #667085;
            font-size: 13px;
            line-height: 1.8;
            text-align: center;
        }

        .warning-message strong {
            color: #263449;
        }

        .warning-note {
            margin-bottom: 22px;
            padding: 12px 14px;
            border: 1px solid #f0d9c3;
            border-radius: 10px;
            background: #fff8f0;
            color: #96602d;
            font-size: 11px;
            line-height: 1.7;
        }

        .btn-danger {
            border-color: #a94e43 !important;
            background: #a94e43 !important;
            color: white !important;
        }

        .btn-danger:hover {
            background: #8e3d34 !important;
        }

        @media (max-width: 900px) {
            .main {
                margin-left: 215px;
                padding: 28px 24px;
            }
        }

        @media (max-width: 620px) {
            .main {
                margin-left: 0;
                padding: 24px 17px;
            }

            .topbar {
                align-items: flex-start;
                margin-bottom: 22px;
            }

            .page-title {
                font-size: 21px;
            }

            .panel {
                padding: 18px 14px;
            }

            .panel-heading {
                align-items: flex-start;
            }

            .panel-heading h2 {
                font-size: 16px;
            }

            .btn {
                padding: 10px 12px;
            }

            table {
                min-width: 470px;
            }

            .footer {
                margin-top: 28px;
            }

            .modal-overlay {
                padding: 16px;
            }

            .modal {
                max-width: 448px;
                border-radius: 20px;
            }

            .modal-header {
                padding: 21px 20px;
            }

            .modal-body {
                padding: 20px;
            }
        }

        @media (max-width: 380px) {
            .main {
                padding-right: 12px;
                padding-left: 12px;
            }

            .panel-heading {
                flex-direction: column;
            }

            .panel-heading > .btn {
                width: 100%;
            }

            .modal-actions {
                gap: 9px;
            }

            .modal-actions .btn {
                padding: 10px 8px;
            }
        }
    </style>
</head>

<body>

    @include('admin.sidebar')

    <main class="main" id="kategori-content">

        <header class="topbar">
            <div>
                <h1 class="page-title">Data Kategori</h1>
                <p class="page-subtitle">
                    Kelola kategori perlengkapan camping di CampRent.
                </p>
            </div>
        </header>

        <section class="panel">

            <div class="panel-heading">
                <div>
                    <h2>Daftar Kategori</h2>
                    <p>Data kategori yang digunakan untuk mengelompokkan barang sewaan.</p>
                </div>

                <button type="button" class="btn btn-primary" id="openCreateModal">
                    <span>＋</span> Tambah Kategori
                </button>
            </div>

            @if (session('success'))
                <div class="notif notif-success" role="status">
                    <span class="notif-icon">✓</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="notif notif-error" role="alert">
                    <span class="notif-icon">!</span>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th class="number">NO.</th>
                            <th>NAMA KATEGORI</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($kategori as $item)
                            <tr>
                                <td class="number">{{ $loop->iteration }}</td>

                                <td class="category-name">
                                    {{ $item->nama_kategori }}
                                </td>

                                <td>
                                    <div class="actions">

                                        <button
                                            type="button"
                                            class="btn btn-edit open-edit-modal"
                                            data-id="{{ $item->id_kategori }}"
                                            data-name="{{ $item->nama_kategori }}"
                                        >
                                            Edit
                                        </button>

                                        <form
                                            action="{{ route('admin.kategori.destroy', $item->id_kategori) }}"
                                            method="POST"
                                            class="delete-form"
                                            data-jumlah="{{ $item->barang()->count() }}"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-delete">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="3" class="empty-state">
                                    Belum ada kategori. Klik tombol Tambah Kategori untuk menambahkan data.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </section>

        <footer class="footer">
            CampRent — Sistem Informasi Persewaan Alat Camping
        </footer>

    </main>


    <div
        class="modal-overlay {{ $errors->any() && old('_form_type') === 'create' ? 'show' : '' }}"
        id="createModal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="createModalTitle"
    >
        <div class="modal">

            <div class="modal-header">
                <h2 class="modal-title" id="createModalTitle">Tambah Kategori</h2>

                <button type="button" class="modal-close" data-close-modal>
                    &times;
                </button>
            </div>

            <div class="modal-body">

                @if ($errors->any() && old('_form_type') === 'create')
                    <div class="alert-error">
                        <strong>Periksa kembali data yang dimasukkan:</strong>

                        <ul style="padding-left:18px;margin-top:6px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.kategori.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="_form_type" value="create">

                    <div class="form-group">
                        <label for="createNamaKategori" class="form-label">
                            Nama Kategori
                        </label>

                        <input
                            type="text"
                            id="createNamaKategori"
                            name="nama_kategori"
                            class="form-input"
                            value="{{ old('_form_type') === 'create' ? old('nama_kategori') : '' }}"
                            placeholder="Contoh: Tenda, Tas Carrier, Peralatan Masak"
                            maxlength="100"
                            required
                        >

                        @if ($errors->any() && old('_form_type') === 'create')
                            @error('nama_kategori')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn btn-light" data-close-modal>
                            Batal
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div
        class="modal-overlay {{ $errors->any() && old('_form_type') === 'edit' ? 'show' : '' }}"
        id="editModal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="editModalTitle"
    >
        <div class="modal">

            <div class="modal-header">
                <h2 class="modal-title" id="editModalTitle">Edit Kategori</h2>

                <button type="button" class="modal-close" data-close-modal>
                    &times;
                </button>
            </div>

            <div class="modal-body">

                @if ($errors->any() && old('_form_type') === 'edit')
                    <div class="alert-error">
                        <strong>Periksa kembali data yang dimasukkan:</strong>

                        <ul style="padding-left:18px;margin-top:6px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    id="editCategoryForm"
                    action="{{ route('admin.kategori.index') }}"
                    method="POST"
                >
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="_form_type" value="edit">

                    <input
                        type="hidden"
                        name="_edit_id"
                        id="editKategoriId"
                        value="{{ old('_form_type') === 'edit' ? old('_edit_id') : '' }}"
                    >

                    <div class="form-group">
                        <label for="editNamaKategori" class="form-label">
                            Nama Kategori
                        </label>

                        <input
                            type="text"
                            id="editNamaKategori"
                            name="nama_kategori"
                            class="form-input"
                            value="{{ old('_form_type') === 'edit' ? old('nama_kategori') : '' }}"
                            placeholder="Masukkan nama kategori"
                            maxlength="100"
                            required
                        >

                        @if ($errors->any() && old('_form_type') === 'edit')
                            @error('nama_kategori')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn btn-light" data-close-modal>
                            Batal
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    @if (session('warning'))
        @php
            $warning = session('warning');
        @endphp

        <div
            class="modal-overlay show"
            id="deleteWarningModal"
            role="dialog"
            aria-modal="true"
            aria-labelledby="deleteWarningTitle"
        >
            <div class="modal">

                <div class="modal-header">
                    <h2 class="modal-title" id="deleteWarningTitle">
                        Peringatan Penghapusan
                    </h2>

                    <button type="button" class="modal-close" data-close-modal>
                        &times;
                    </button>
                </div>

                <div class="modal-body">

                    <div class="warning-icon">
                        !
                    </div>

                    <div class="warning-message">
                        Kategori <strong>{{ $warning['nama_kategori'] }}</strong>
                        masih digunakan oleh
                        <strong>{{ $warning['jumlah_barang'] }} barang</strong>.

                        <br><br>

                        Jika kategori ini dihapus, seluruh barang yang berada
                        dalam kategori tersebut juga akan ikut dihapus.

                        <br><br>

                        Apakah kamu yakin ingin melanjutkan?
                    </div>

                    <div class="warning-note">
                        <strong>Perhatian:</strong>
                        Penghapusan ini akan menghilangkan data barang dari
                        daftar perlengkapan CampRent dan tidak dapat dibatalkan.
                    </div>

                    <div class="modal-actions">

                        <button
                            type="button"
                            class="btn btn-light"
                            data-close-modal
                        >
                            Batal
                        </button>

                        <form
                            action="{{ route('admin.kategori.destroy', $warning['id_kategori']) }}"
                            method="POST"
                            style="flex:1;display:flex;"
                        >
                            @csrf
                            @method('DELETE')

                            <input
                                type="hidden"
                                name="konfirmasi"
                                value="1"
                            >

                            <button
                                type="submit"
                                class="btn btn-danger"
                                style="width:100%;"
                            >
                                Ya, Hapus
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    @endif

    <script>
        const createModal = document.getElementById('createModal');
        const editModal = document.getElementById('editModal');

        const createInput = document.getElementById('createNamaKategori');
        const editInput = document.getElementById('editNamaKategori');

        const editForm = document.getElementById('editCategoryForm');
        const editIdInput = document.getElementById('editKategoriId');

        const kategoriBaseUrl = @json(url('/admin/kategori'));

        function openModal(modal, input = null) {
            closeAllModals();

            modal.classList.add('show');
            document.body.style.overflow = 'hidden';

            if (input) {
                setTimeout(() => input.focus(), 100);
            }
        }

        function closeAllModals() {
            document.querySelectorAll('.modal-overlay').forEach(modal => {
                modal.classList.remove('show');
            });

            document.body.style.overflow = '';
        }

        document.getElementById('openCreateModal').addEventListener('click', () => {
            openModal(createModal, createInput);
        });

        document.querySelectorAll('.open-edit-modal').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.dataset.id;
                const name = button.dataset.name;

                editIdInput.value = id;

                editForm.action = kategoriBaseUrl + '/' + encodeURIComponent(id);

                editInput.value = name;

                openModal(editModal, editInput);
            });
        });

        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(event) {

                const jumlahBarang = parseInt(this.dataset.jumlah, 10);

                if (jumlahBarang === 0) {
                    const yakin = confirm(
                        'Yakin ingin menghapus kategori ini?'
                    );

                    if (!yakin) {
                        event.preventDefault();
                    }

                    return;
                }

            });
        });

        document.querySelectorAll('[data-close-modal]').forEach(button => {
            button.addEventListener('click', closeAllModals);
        });

        document.querySelectorAll('.modal-overlay').forEach(modal => {
            modal.addEventListener('click', event => {
                if (event.target === modal) {
                    closeAllModals();
                }
            });
        });

        document.addEventListener('keydown', event => {
            if (event.key === 'Escape') {
                closeAllModals();
            }
        });


        @if ($errors->any() && old('_form_type') === 'create')
            openModal(createModal, createInput);

        @elseif ($errors->any() && old('_form_type') === 'edit')

            const previousEditId = @json(old('_edit_id'));

            if (previousEditId) {
                editIdInput.value = previousEditId;

                editForm.action =
                    kategoriBaseUrl + '/' + encodeURIComponent(previousEditId);
            }

            editInput.value = @json(old('nama_kategori', ''));

            openModal(editModal, editInput);

        @endif

        const warningModal = document.getElementById('deleteWarningModal');

        if (warningModal) {
            document.body.style.overflow = 'hidden';
        }

        document.querySelectorAll('.notif').forEach(notif => {
            setTimeout(() => {
                notif.classList.add('is-hiding');
                setTimeout(() => notif.remove(), 400);
            }, 3000);
        });
    </script>

</body>
</html>
