<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penyewaan</title>
</head>
<body>
    <h1>Data Penyewaan</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif

    <form action="{{ route('admin.penyewaan.index') }}" method="GET" id="form-pencarian">
        <input
            type="text"
            name="cari"
            id="cari-penyewaan"
            placeholder="Cari kode penyewaan atau nama pelanggan"
            value="{{ $cari }}"
            autocomplete="off"
        >
        <button type="submit">Cari</button>
    </form>

    <br>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Penyewaan</th>
                <th>Nama Pelanggan</th>
                <th>Barang Disewa</th>
                <th>Tanggal Sewa</th>
                <th>Rencana Kembali</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Denda</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody id="hasil-penyewaan">
            @forelse ($penyewaan as $item)
                @php
                    $dataPengembalian = $pengembalian->get($item->id_penyewaan);
                @endphp

                <tr>
                    <td>{{ $penyewaan->firstItem() + $loop->index }}</td>
                    <td>{{ $item->kode_penyewaan }}</td>
                    <td>{{ $item->user->nama ?? '-' }}</td>

                    <td>
                        @forelse ($item->detailPenyewaan as $detail)
                            {{ $detail->barang->nama_barang ?? 'Barang tidak ditemukan' }}
                            ({{ $detail->jumlah }} unit)
                            @if (!$loop->last)
                                <br>
                            @endif
                        @empty
                            -
                        @endforelse
                    </td>

                    <td>{{ $item->tanggal_sewa->format('d-m-Y') }}</td>
                    <td>{{ $item->tanggal_rencana_kembali->format('d-m-Y') }}</td>
                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>

                    <td>
                        @if ($item->status === 'dikembalikan')
                            Selesai
                        @elseif ($item->status === 'ditolak')
                            Batal
                        @else
                            {{ ucfirst($item->status) }}
                        @endif
                    </td>

                    <td>
                        @if ($dataPengembalian)
                            Rp {{ number_format($dataPengembalian->denda, 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        @if ($item->status === 'menunggu')
                            <form action="{{ route('admin.penyewaan.setujui', $item->id_penyewaan) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit">Setujui</button>
                            </form>

                            <form action="{{ route('admin.penyewaan.tolak', $item->id_penyewaan) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit">Tolak</button>
                            </form>

                        @elseif ($item->status === 'disetujui')
                            <form action="{{ route('admin.penyewaan.konfirmasiPembayaran', $item->id_penyewaan) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button
                                    type="submit"
                                    onclick="return confirm('Pastikan pembayaran sudah diterima. Konfirmasi pembayaran ini?')"
                                >
                                    Konfirmasi Pembayaran
                                </button>
                            </form>

                        @elseif ($item->status === 'dibayar')
                            <form action="{{ route('admin.penyewaan.dikembalikan', $item->id_penyewaan) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button
                                    type="submit"
                                    onclick="return confirm('Pastikan barang sudah dikembalikan. Konfirmasi pengembalian ini?')"
                                >
                                    Kembalikan
                                </button>
                            </form>

                            @php
                                $tanggalKembali = $item->tanggal_rencana_kembali->copy()->startOfDay();
                                $hariIni = now()->startOfDay();
                                $sisaHari = $hariIni->diffInDays($tanggalKembali, false);
                            @endphp

                            @if ($sisaHari <= 1)
                                @php
                                    $nomor = preg_replace('/\D/', '', $item->user?->no_hp ?? '');

                                    if (str_starts_with($nomor, '0')) {
                                        $nomor = '62' . substr($nomor, 1);
                                    } elseif (str_starts_with($nomor, '8')) {
                                        $nomor = '62' . $nomor;
                                    }

                                    $namaPelanggan = $item->user?->nama ?? 'Pelanggan';
                                    $waktu = $sisaHari < 0
                                        ? 'sudah melewati tanggal pengembalian'
                                        : ($sisaHari == 0 ? 'jatuh tempo hari ini' : 'akan berakhir besok');

                                    $pesan = "Halo {$namaPelanggan}, kami ingin mengingatkan bahwa masa sewa alat camping dengan kode {$item->kode_penyewaan} {$waktu}.\n\n"
                                        . "Tanggal rencana kembali: {$item->tanggal_rencana_kembali->format('d-m-Y')}\n\n"
                                        . "Mohon mengembalikan barang sesuai jadwal. Jika terlambat, denda akan dikenakan sesuai ketentuan yang berlaku. Terima kasih.";
                                @endphp

                                @if (strlen($nomor) >= 10 && strlen($nomor) <= 15)
                                    <br>
                                    <a
                                        href="https://wa.me/{{ $nomor }}?text={{ urlencode($pesan) }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        Ingatkan via WhatsApp
                                    </a>
                                @else
                                    <br>
                                    <span>Nomor HP belum valid</span>
                                @endif
                            @endif

                        @elseif ($item->status === 'dikembalikan')
                            <span>Selesai</span>

                        @elseif ($item->status === 'ditolak')
                            <span>Batal</span>

                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">Data penyewaan tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    <div id="pagination-penyewaan">
        {{ $penyewaan->links() }}
    </div>

    <br>

    <a href="{{ route('admin.dashboard') }}">Kembali ke Dashboard</a>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('form-pencarian');
            const input = document.getElementById('cari-penyewaan');
            const hasil = document.getElementById('hasil-penyewaan');
            const pagination = document.getElementById('pagination-penyewaan');
            let timer;

            async function cariPenyewaan(url = new URL(form.action, window.location.origin)) {
                url.searchParams.set('cari', input.value);

                try {
                    const response = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) return;

                    const html = await response.text();
                    const dokumen = new DOMParser().parseFromString(html, 'text/html');
                    const hasilBaru = dokumen.querySelector('#hasil-penyewaan');
                    const paginationBaru = dokumen.querySelector('#pagination-penyewaan');

                    if (hasilBaru && paginationBaru) {
                        hasil.innerHTML = hasilBaru.innerHTML;
                        pagination.innerHTML = paginationBaru.innerHTML;
                    }
                } catch (error) {
                    console.error('Pencarian penyewaan gagal:', error);
                }
            }

            input.addEventListener('input', function () {
                clearTimeout(timer);
                timer = setTimeout(function () {
                    cariPenyewaan();
                }, 300);
            });

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                clearTimeout(timer);
                cariPenyewaan();
            });

            pagination.addEventListener('click', function (event) {
                const link = event.target.closest('a');

                if (!link) return;

                event.preventDefault();
                cariPenyewaan(new URL(link.href));
            });
        });
    </script>
</body>
</html>