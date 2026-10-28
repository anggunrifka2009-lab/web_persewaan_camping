<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang - CampRent</title>

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
            border: 1px solid var(--border);
            border-radius: 9px;
            background: var(--white);
            color: var(--forest);
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
            width: 100%;
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

        textarea.form-control {
            min-height: 115px;
            resize: vertical;
            line-height: 1.7;
        }

        .form-control:focus {
            border-color: #9aaf98;
            box-shadow: 0 0 0 3px var(--soft-green);
        }

        .form-control::placeholder {
            color: #a0a49d;
        }

        .form-control[readonly] {
            background: #f5f3ec;
            color: var(--muted);
            cursor: not-allowed;
        }

        .error-message {
            color: var(--danger);
            font-size: 11px;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .file-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            min-height: 43px;
            padding: 6px 9px;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--white);
        }

        .file-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            min-height: 29px;
            padding: 7px 10px;
            border-radius: 7px;
            background: var(--soft-green);
            color: var(--forest);
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        .file-button:hover {
            background: #dce8d9;
        }

        #nama-file-input {
            display: block;
            min-width: 0;
            overflow: hidden;
            color: var(--muted);
            font-size: 12px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        #foto {
            position: absolute;
            width: 1px;
            height: 1px;
            overflow: hidden;
            opacity: 0;
            pointer-events: none;
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
            min-width: 0;
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
            overflow-wrap: anywhere;
        }

        .preview-box {
            display: grid;
            place-items: center;
            width: 100%;
            min-height: 175px;
            margin: 15px 0 12px;
            overflow: hidden;
            border: 1px dashed #cbd5c8;
            border-radius: 12px;
            background: #f5f7f1;
            color: var(--muted);
            text-align: center;
        }

        .preview-box img {
            display: block;
            width: 100%;
            max-height: 240px;
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
            <div class="topbar-heading">
                <a href="{{ route('barang.index') }}" class="btn-back" aria-label="Kembali ke daftar barang">
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

                <h1 class="page-title">Edit Barang</h1>
            </div>

            <p class="page-subtitle">Perbarui informasi perlengkapan camping.</p>
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
                    <p>Periksa kembali perubahan sebelum menyimpan data.</p>
                </div>

                <form action="{{ route('barang.update', $barang->id_barang) }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="kode_barang">Kode Barang</label>
                            <input type="text"
                                   id="kode_barang"
                                   class="form-control"
                                   value="{{ $barang->kode_barang }}"
                                   readonly>
                        </div>

                        <div class="form-group">
                            <label for="id_kategori">Kategori <span class="required">*</span></label>
                            <select name="id_kategori" id="id_kategori" class="form-control" required>
                                <option value="">Pilih kategori barang</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id_kategori }}"
                                        {{ old('id_kategori', $barang->id_kategori) == $item->id_kategori ? 'selected' : '' }}>
                                        {{ $item->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kategori')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group full">
                            <label for="nama_barang">Nama Barang <span class="required">*</span></label>
                            <input type="text"
                                   name="nama_barang"
                                   id="nama_barang"
                                   class="form-control"
                                   value="{{ old('nama_barang', $barang->nama_barang) }}"
                                   maxlength="100"
                                   required>
                            @error('nama_barang')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group full">
                            <label for="foto">Foto Barang</label>

                            <div class="file-input-wrapper">
                                <label for="foto" class="file-button">Choose File</label>

                                <span id="nama-file-input">
                                    {{ $barang->foto ? basename($barang->foto) : 'No file chosen' }}
                                </span>

                                <input type="file"
                                       name="foto"
                                       id="foto"
                                       accept="image/jpeg,image/png,image/webp">
                            </div>

                            <span class="error-message">
                                Kosongkan jika tidak ingin mengganti foto. Format JPG, JPEG, PNG, atau WebP, maksimal 2 MB.
                            </span>

                            @error('foto')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group full">
                            <label for="deskripsi">Deskripsi <span class="required">*</span></label>
                            <textarea name="deskripsi"
                                      id="deskripsi"
                                      class="form-control"
                                      required>{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="harga_sewa">Harga Sewa (Rp) <span class="required">*</span></label>
                            <input type="text"
                                   name="harga_sewa"
                                   id="harga_sewa"
                                   class="form-control"
                                   value="{{ old('harga_sewa', number_format($barang->harga_sewa, 0, ',', '.')) }}"
                                   inputmode="numeric"
                                   required>
                            @error('harga_sewa')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="stok">Stok <span class="required">*</span></label>
                            <input type="number"
                                   name="stok"
                                   id="stok"
                                   class="form-control"
                                   value="{{ old('stok', $barang->stok) }}"
                                   min="0"
                                   step="1"
                                   required>
                            @error('stok')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group full">
                            <label for="status">Status <span class="required">*</span></label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="tersedia"
                                    {{ old('status', $barang->status) === 'tersedia' ? 'selected' : '' }}>
                                    Tersedia
                                </option>
                                <option value="tidak tersedia"
                                    {{ old('status', $barang->status) === 'tidak tersedia' ? 'selected' : '' }}>
                                    Tidak Tersedia
                                </option>
                            </select>
                            @error('status')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </section>

            <aside class="side-column">
                <section class="side-card">
                    <h3>Pratinjau Foto</h3>

                    <div class="preview-box">
                        <img id="preview-foto"
                             src="{{ $barang->foto ? asset('storage/' . $barang->foto) : '' }}"
                             alt="Foto {{ $barang->nama_barang }}"
                             style="{{ $barang->foto ? '' : 'display:none;' }}">

                        <div class="preview-placeholder"
                             id="preview-placeholder"
                             style="{{ $barang->foto ? 'display:none;' : '' }}">
                            <span>
                                <img src="{{ asset('images/barang.png') }}"
                                     alt="Icon barang"
                                     class="placeholder-icon">
                            </span>
                            <strong>Belum ada foto</strong>
                            <small>Pilih foto baru untuk menambahkan gambar barang.</small>
                        </div>
                    </div>

                    <p id="nama-file">
                        {{ $barang->foto ? basename($barang->foto) : 'Belum ada foto barang.' }}
                    </p>
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

        const inputFoto = document.getElementById('foto');
        const previewFoto = document.getElementById('preview-foto');
        const placeholderFoto = document.getElementById('preview-placeholder');
        const namaFile = document.getElementById('nama-file');
        const namaFileInput = document.getElementById('nama-file-input');

        const fotoAwal = {
            src: previewFoto.getAttribute('src'),
            nama: namaFileInput.textContent.trim()
        };

        inputFoto.addEventListener('change', function () {
            const file = this.files[0];

            if (!file) {
                namaFileInput.textContent = fotoAwal.nama;
                namaFile.textContent = fotoAwal.nama;

                if (fotoAwal.src) {
                    previewFoto.src = fotoAwal.src;
                    previewFoto.style.display = 'block';
                    placeholderFoto.style.display = 'none';
                } else {
                    previewFoto.removeAttribute('src');
                    previewFoto.style.display = 'none';
                    placeholderFoto.style.display = 'block';
                }

                return;
            }

            const formatDiizinkan = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            if (!formatDiizinkan.includes(file.type)) {
                alert('Pilih foto berformat JPG, JPEG, PNG, atau WebP.');
                this.value = '';
                this.dispatchEvent(new Event('change'));
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran foto maksimal 2 MB.');
                this.value = '';
                this.dispatchEvent(new Event('change'));
                return;
            }

            namaFileInput.textContent = file.name;
            namaFile.textContent = file.name;

            const reader = new FileReader();

            reader.onload = function (event) {
                previewFoto.src = event.target.result;
                previewFoto.style.display = 'block';
                placeholderFoto.style.display = 'none';
            };

            reader.readAsDataURL(file);
        });
    </script>
</body>
</html>