<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang - CampRent</title>

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
            --danger: #984c43;
            --soft-green: #eaf0e8;
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

        button, input, select, textarea {
            font: inherit;
        }

        .main {
            min-height: 100vh;
            margin-left: 250px;
            padding: 32px 38px 28px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 26px;
        }

        .topbar-heading {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 7px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            width: 32px;
            height: 32px;
            border-radius: 9px;
            background: var(--white);
            color: var(--forest);
            border: 1px solid var(--border);
            transition: .2s;
        }

        .btn-back:hover {
            background: var(--soft-green);
        }

        .btn-back svg {
            display: block;
            width: 20px;
            height: 20px;
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

        .content-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 270px;
            align-items: start;
            gap: 22px;
        }

        .panel {
            min-width: 0;
            padding: 27px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: var(--white);
            box-shadow: 0 5px 18px rgba(36, 75, 56, .035);
        }

        .panel-heading {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
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

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 21px 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 9px;
            min-width: 0;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-size: 12px;
            font-weight: 700;
        }

        .required {
            color: var(--danger);
        }

        .form-control {
            width: 100%;
            min-height: 43px;
            padding: 11px 13px;
            border: 1px solid var(--border);
            border-radius: 10px;
            outline: none;
            background: var(--white);
            color: var(--text);
            font-size: 12px;
            transition: .2s;
        }

        input[type="file"].form-control {
            padding: 8px;
            cursor: pointer;
        }

        input[type="file"]::file-selector-button {
            margin-right: 10px;
            padding: 7px 10px;
            border: 0;
            border-radius: 7px;
            background: var(--soft-green);
            color: var(--forest);
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        textarea.form-control {
            min-height: 115px;
            resize: vertical;
            line-height: 1.7;
        }

        .form-control:focus {
            border-color: #9aaf98;
            box-shadow: 0 0 0 3px #eaf0e8;
        }

        .form-control::placeholder {
            color: #a0a49d;
        }

        .error-message {
            color: var(--danger);
            font-size: 11px;
            line-height: 1.6;
        }

        .alert-error {
            margin-bottom: 22px;
            padding: 13px 15px;
            border: 1px solid #ead0cb;
            border-radius: 10px;
            background: #f8eeeb;
            color: var(--danger);
            font-size: 12px;
            line-height: 1.8;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid var(--border);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 41px;
            padding: 10px 16px;
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

        .btn-secondary {
            border-color: var(--border);
            background: var(--white);
            color: var(--text);
        }

        .btn-secondary:hover {
            background: #f5f3ec;
        }

        .side-column {
            display: grid;
            gap: 18px;
        }

        .side-card {
            padding: 21px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: var(--white);
            box-shadow: 0 5px 18px rgba(36, 75, 56, .035);
        }

        .side-card h3 {
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 800;
        }

        .side-card p {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.8;
        }

        .preview-box {
            display: grid;
            place-items: center;
            width: 100%;
            min-height: 170px;
            margin: 15px 0 12px;
            overflow: hidden;
            border: 1px dashed #cbd5c8;
            border-radius: 12px;
            background: #f5f7f1;
            color: var(--muted);
            text-align: center;
        }

        .preview-box img {
            display: none;
            width: 100%;
            max-height: 230px;
            object-fit: contain;
        }

        .preview-placeholder {
            padding: 18px;
        }

        .preview-placeholder span {
            display: block;
            margin-bottom: 9px;
        }

        .placeholder-icon {
            display: block;
            width: 40px;
            height: 40px;
            margin: 0 auto;
            object-fit: contain;
        }

        .preview-placeholder strong {
            display: block;
            margin-bottom: 5px;
            color: var(--text);
            font-size: 12px;
        }

        .preview-placeholder small {
            font-size: 10px;
            line-height: 1.6;
        }

        .footer {
            margin-top: 30px;
            padding-top: 18px;
            border-top: 1px solid #e0ddd3;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
        }

        @media (max-width: 1200px) {
            .content-grid {
                grid-template-columns: minmax(0, 1fr) 235px;
                gap: 16px;
            }

            .panel {
                padding: 22px;
            }

            .side-card {
                padding: 17px;
            }
        }

        @media (max-width: 1000px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .side-column {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 900px) {
            .main {
                margin-left: 215px;
                padding: 28px 20px;
            }

            .side-column {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 620px) {
            .main {
                margin-left: 0;
                padding: 24px 17px;
            }

            .topbar {
                margin-bottom: 22px;
            }

            .topbar-heading {
                gap: 10px;
            }

            .page-title {
                font-size: 21px;
            }

            .panel {
                padding: 19px 15px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 19px;
            }

            .form-group.full {
                grid-column: auto;
            }

            .side-column {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    @include('admin.sidebar')

    <main class="main">
        <header class="topbar">
            <div>
                <div class="topbar-heading">
                    {{-- Route diperbaiki --}}
                    <a href="{{ route('admin.barang.index') }}"
                       class="btn-back"
                       aria-label="Kembali ke daftar barang">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             stroke-linecap="round"
                             stroke-linejoin="round"
                             aria-hidden="true">
                            <path d="m12 19-7-7 7-7"/>
                            <path d="M19 12H5"/>
                        </svg>
                    </a>

                    <h1 class="page-title">Tambah Barang</h1>
                </div>

                <p class="page-subtitle">
                    Tambahkan perlengkapan camping baru ke daftar penyewaan.
                </p>
            </div>
        </header>

        @if ($errors->any())
            <div class="alert-error">
                <strong>Data belum berhasil disimpan.</strong>

                <ul style="padding-left:18px;margin-top:7px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="content-grid">
            <section class="panel">
                <div class="panel-heading">
                    <h2>Informasi Barang</h2>
                    <p>
                        Isi informasi barang dengan benar. Kode barang akan dibuat
                        otomatis berdasarkan kategori.
                    </p>
                </div>

                {{-- Route diperbaiki --}}
                <form action="{{ route('admin.barang.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="id_kategori">
                                Kategori <span class="required">*</span>
                            </label>

                            <select name="id_kategori"
                                    id="id_kategori"
                                    class="form-control"
                                    required>
                                <option value="">Pilih kategori barang</option>

                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id_kategori }}"
                                        {{ old('id_kategori') == $item->id_kategori ? 'selected' : '' }}>
                                        {{ $item->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>

                            @error('id_kategori')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_barang">
                                Nama Barang <span class="required">*</span>
                            </label>

                            <input type="text"
                                   name="nama_barang"
                                   id="nama_barang"
                                   class="form-control"
                                   value="{{ old('nama_barang') }}"
                                   placeholder="Contoh: Tenda Camping 4 Orang"
                                   maxlength="100"
                                   required>

                            @error('nama_barang')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group full">
                            <label for="foto">Foto Barang</label>

                            <input type="file"
                                   name="foto"
                                   id="foto"
                                   class="form-control"
                                   accept="image/jpeg,image/png,image/webp">

                            <span class="error-message">
                                Format JPG, JPEG, PNG, atau WebP. Maksimal 2 MB.
                            </span>

                            @error('foto')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group full">
                            <label for="deskripsi">Deskripsi</label>

                            <textarea name="deskripsi"
                                      id="deskripsi"
                                      class="form-control"
                                      placeholder="Masukkan detail atau kondisi barang">{{ old('deskripsi') }}</textarea>

                            @error('deskripsi')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="harga_sewa">
                                Harga Sewa (Rp) <span class="required">*</span>
                            </label>

                            <input type="text"
                                   name="harga_sewa"
                                   id="harga_sewa"
                                   class="form-control"
                                   value="{{ old('harga_sewa') }}"
                                   placeholder="Contoh: 50.000"
                                   inputmode="numeric"
                                   required>

                            @error('harga_sewa')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="stok">
                                Stok <span class="required">*</span>
                            </label>

                            <input type="number"
                                   name="stok"
                                   id="stok"
                                   class="form-control"
                                   value="{{ old('stok', 0) }}"
                                   min="0"
                                   step="1"
                                   required>

                            @error('stok')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group full">
                            <label for="status">
                                Status <span class="required">*</span>
                            </label>

                            <select name="status"
                                    id="status"
                                    class="form-control"
                                    required>
                                <option value="tersedia"
                                    {{ old('status', 'tersedia') === 'tersedia' ? 'selected' : '' }}>
                                    Tersedia
                                </option>

                                <option value="tidak tersedia"
                                    {{ old('status') === 'tidak tersedia' ? 'selected' : '' }}>
                                    Tidak Tersedia
                                </option>
                            </select>

                            @error('status')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        {{-- Route diperbaiki --}}
                        <a href="{{ route('admin.barang.index') }}"
                           class="btn btn-secondary">
                            Batal
                        </a>

                        <button type="submit" class="btn btn-primary">
                            Simpan Barang
                        </button>
                    </div>
                </form>
            </section>

            <aside class="side-column">
                <section class="side-card">
                    <h3>Pratinjau Foto</h3>

                    <div class="preview-box">
                        <img id="preview-foto"
                             src=""
                             alt="Pratinjau foto barang">

                        <div class="preview-placeholder" id="preview-placeholder">
                            <span>
                                <img src="{{ asset('images/barang.png') }}"
                                     alt="Ikon foto"
                                     class="placeholder-icon">
                            </span>

                            <strong>Belum ada foto</strong>

                            <small>
                                Pilih gambar dari perangkatmu untuk melihat pratinjau.
                            </small>
                        </div>
                    </div>

                    <p id="nama-file">Belum ada file yang dipilih.</p>
                </section>
            </aside>
        </div>

        <footer class="footer">
            CampRent — Sistem Informasi Persewaan Alat Camping
        </footer>
    </main>

    <script>
        const hargaSewa = document.getElementById('harga_sewa');

        hargaSewa.addEventListener('input', function () {
            const angka = this.value.replace(/\D/g, '');
            this.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        });

        // Hilangkan titik harga sebelum dikirim ke controller.
        document.querySelector('form').addEventListener('submit', function () {
            hargaSewa.value = hargaSewa.value.replace(/\./g, '');
        });

        const inputFoto = document.getElementById('foto');
        const previewFoto = document.getElementById('preview-foto');
        const placeholderFoto = document.getElementById('preview-placeholder');
        const namaFile = document.getElementById('nama-file');

        inputFoto.addEventListener('change', function () {
            const file = this.files[0];

            if (!file) {
                previewFoto.removeAttribute('src');
                previewFoto.style.display = 'none';
                placeholderFoto.style.display = 'block';
                namaFile.textContent = 'Belum ada file yang dipilih.';
                return;
            }

            const formatDiizinkan = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            if (!formatDiizinkan.includes(file.type)) {
                this.value = '';
                previewFoto.removeAttribute('src');
                previewFoto.style.display = 'none';
                placeholderFoto.style.display = 'block';
                namaFile.textContent = 'Format file tidak didukung.';

                alert('Pilih foto berformat JPG, JPEG, PNG, atau WebP.');
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                this.value = '';
                previewFoto.removeAttribute('src');
                previewFoto.style.display = 'none';
                placeholderFoto.style.display = 'block';
                namaFile.textContent = 'Ukuran foto melebihi 2 MB.';

                alert('Ukuran foto maksimal 2 MB.');
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {
                previewFoto.src = event.target.result;
                previewFoto.style.display = 'block';
                placeholderFoto.style.display = 'none';
                namaFile.textContent = file.name;
            };

            reader.readAsDataURL(file);
        });
    </script>
</body>
</html>