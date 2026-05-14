<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi - Citra Wedding Organizer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Pengaturan Dasar Kertas A4 Landscape */
        @page {
            size: A4 landscape;
            margin: 15mm;
        }

        body {
            background-color: #f3f4f6;
            /* Warna latar saat dilihat di browser */
            font-family: 'Inter', 'Tahoma', sans-serif;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color: #1f2937;
        }

        /* Container Kertas (Tampilan Browser) */
        .page-container {
            width: 297mm;
            min-height: 210mm;
            background: white;
            margin: 20px auto;
            padding: 20mm;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Pengaturan Khusus Saat Dicetak (Print) */
        @media print {
            body {
                background-color: white;
            }

            .page-container {
                margin: 0;
                padding: 0;
                box-shadow: none;
                width: 100%;
            }

            /* Mencegah tabel terpotong di tengah baris jika berlanjut ke halaman 2 */
            tr {
                page-break-inside: avoid;
            }
        }

        /* Kustomisasi Tabel Cetak */
        .print-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 11pt;
        }

        .print-table th,
        .print-table td {
            border: 1px solid #d1d5db;
            padding: 8px 10px;
            vertical-align: top;
        }

        .print-table th {
            background-color: #f8fafc;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 9pt;
            letter-spacing: 0.05em;
            text-align: center;
            color: #4b5563;
        }

        .print-table td {
            color: #374151;
        }

        /* Utilitas Garis Kop Surat */
        .kop-line {
            border-top: 3px solid #111827;
            border-bottom: 1px solid #111827;
            padding-bottom: 2px;
            margin-top: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="page-container">

        <div class="text-center">
            <h1 class="text-2xl font-bold tracking-widest uppercase text-gray-900">Citra Wedding Organizer</h1>
            <p class="text-sm text-gray-600 mt-1">Jl. Contoh Alamat Bisnis No. 123, Kota Bandung, Jawa Barat</p>
            <p class="text-sm text-gray-600">Telepon: 0812-3456-7890 | Email: info@citrawedding.com</p>
        </div>
        <div class="kop-line"></div>

        <div class="text-center mb-6">
            <h2 class="text-lg font-semibold uppercase underline decoration-gray-400 underline-offset-4">Laporan
                Transaksi & Booking</h2>
            <p class="text-xs text-gray-500 mt-2">Dicetak pada:
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y - H:i') }} WIB</p>
        </div>

        <table class="print-table">
            <thead>
                <tr>
                    <th style="width: 4%;">NO</th>
                    <th style="width: 10%;">TGL BOOKING</th>
                    <th style="width: 12%;">INVOICE</th>
                    <th style="width: 15%;">NAMA KLIEN</th>
                    <th style="width: 12%;">PAKET</th>
                    <th style="width: 15%;">DETAIL UTAMA</th>
                    <th style="width: 10%;">TGL ACARA</th>
                    <th style="width: 10%;">STATUS</th>
                    <th style="width: 12%;">TOTAL (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $index => $d)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($d->tanggal)->format('d/m/Y') }}</td>
                        <td class="text-center font-mono text-xs">{{ $d->kode_invoice }}</td>
                        <td>
                            <div class="font-medium">{{ optional($d->client)->namapl }}</div>
                            <div class="text-xs text-gray-500">& {{ optional($d->client)->namapr }}</div>
                        </td>
                        <td class="text-center">
                            {{ optional($d->paket)->kode_paket }}<br>
                            <span class="text-xs text-gray-500">{{ optional($d->paket)->jenis_paket }}</span>
                        </td>
                        <td class="text-xs">
                            - Makeup: {{ optional(optional($d->paket)->makeup)->type_makeup ?? '-' }}<br>
                            - Dekor: {{ optional(optional($d->paket)->dekorasi)->type_dekorasi ?? '-' }}
                        </td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($d->tanggal_acara)->format('d/m/Y') }}</td>
                        <td class="text-center">
                            @if (\Carbon\Carbon::parse($d->tanggal_acara)->isPast())
                                Selesai
                            @else
                                {{ $d->status }}
                            @endif
                        </td>
                        <td class="text-right font-medium">
                            {{ number_format($d->total_bayar, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-6 text-gray-500 italic">
                            Tidak ada data transaksi pada periode yang dipilih.
                        </td>
                    </tr>
                @endforelse

                @if(count($data) > 0)
                    <tr>
                        <td colspan="8" class="text-right font-bold uppercase text-xs" style="background-color: #f8fafc;">
                            Total Pendapatan Keseluruhan:
                        </td>
                        <td class="text-right font-bold" style="background-color: #f8fafc;">
                            {{ number_format($data->sum('total_bayar'), 0, ',', '.') }}
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

        <div class="mt-12 flex justify-end pr-8">
            <div class="text-center">
                <p class="text-sm mb-16">Bandung, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>Mengetahui,
                </p>
                <p class="text-sm font-bold underline decoration-gray-400 underline-offset-4">Owner Citra Wedding</p>
                <p class="text-xs text-gray-500 mt-1">Pimpinan / Manajemen</p>
            </div>
        </div>

    </div>

    <script>
        // Otomatis membuka dialog print saat halaman selesai dimuat
        window.onload = function () {
            window.print();
        };
    </script>
</body>

</html>