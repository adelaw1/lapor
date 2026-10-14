<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Honorarium {{ Str::upper($status) }} Revitalisasi 2026 SMK Ashhabul Maimanah Sidayu</title>
    <style>
        .page-break {
            page-break-after: always;
        }
        
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        table.table-data {
            width: 100%;
        }

        table.table-data,
        table.table-data tr,
        table.table-data tr th,
        table.table-data tr td {
            border: 1px solid #000;
            border-collapse: collapse;
            border-spacing: none;
            padding: 4px;
        }

        table.table-data th,
        table.table-data td {
            height: 30px;
        }

        table.table-data th {
            background-color: #cfcfcf;
        }

        table#ttd {
            width: 90%;
            margin: 0 auto;
            margin-top: 20px;
        }

        table#ttd tr td:last-child {
            width: 250px;
        }
    </style>
</head>
<body>

    @php $start = 1; @endphp
    @foreach ($laporan as $item)
        @if ($start > 1)
            <div class="page-break"></div>
        @endif

        @php
            $mulai = $item->rentang_tanggal->tanggal_mulai;
            $selesai = $item->rentang_tanggal->tanggal_selesai;
        @endphp

        <div style="text-align: center; margin-bottom: 20px;">
            <strong>DAFTAR {{ ($status == 'panitia' ? 'HONORARIUM P2SP' : 'UPAH PEKERJA') }}</strong>
            <strong>PROGRAM REVITALISASI</strong><br />
            <strong>SMK ASHHABUL MAIMANAH SIDAYU</strong>
            <strong>BULAN {{ strtoupper($format->parse($item->tanggal)->isoFormat('MMMM')) }}
                TAHUN {{ $format->parse($item->tanggal)->isoFormat('Y') }}</strong>
        </div>

        Periode {{ $format->parse($mulai)->isoFormat('D MMMM Y') }} s.d {{ $format->parse($selesai)->isoFormat('D MMMM Y') }}

        <table class="table-data">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>{{ $status == 'panitia' ? 'Jabatan' : 'Job' }}</th>
                    <th>VOL</th>
                    <th>Satuan</th>
                    <th>{{ $status == 'panitia' ? 'Honor' : 'Upah' }}</th>
                    <th>Jumlah</th>
                    <th>Tanda Tangan</th>
                    <th>Ket</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                    $tanggalAwal = $format->parse($mulai);
                    $tanggalAkhir = $format->parse($selesai);
                    $jmlHari = $tanggalAwal->diffInDays($tanggalAkhir) + 1;
                    $jumlah = 0;
                    $total = 0;
                @endphp
                @foreach ($pelaksana as $plk)
                    @php
                        $jumlah = ($status == 'panitia' ? $plk->honor->nominal : ($jmlHari * $plk->honor->nominal));
                        $total += ($status == 'panitia' ? $plk->honor->nominal : ($jmlHari * $plk->honor->nominal));
                    @endphp
                    <tr>
                        <td style="text-align: center; width: 40px;">{{ $no++ }}</td>
                        <td style="width: 230px;">{{ $plk->nama }}</td>
                        <td style="width: 200px;">{{ $plk->honor->jabatan }}</td>
                        <td style="text-align: center;">
                            {{ ($status == 'panitia' ? '1' : $jmlHari) }}
                        </td>
                        <td style="text-align: center;">
                            {{ ($status == 'panitia' ? 'Minggu' : 'Hari') }}
                        </td>
                        <td style="text-align: right;">
                            {{ number_format($plk->honor->nominal, 0, ',', '.') }}
                        </td>
                        <td style="text-align: right;">
                            {{ number_format($jumlah, 0, ',', '.') }}
                        </td>
                        <td>{{ $no - 1 }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6">Total</th>
                    <th style="text-align: right;">{{ number_format($total, 0, ',', '.') }}</th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>

        <table id="ttd">
            <tr>
                <td>
                    <br>
                    <span>Setuju dibayar,</span><br>
                    <span>Kepala SMK Ashhabul Maimanah Sidayu</span>
                    <br><br><br><br><br>
                    <b>Zamroni, M.Pd.I</b>
                    <br>
                    NIP. -
                </td>
                <td>
                    Kab. Serang, {{ $format->parse($item->rentang_tanggal->tanggal_selesai)->isoFormat('D MMMM Y') }}<br>
                    <span>Lunas dibayar,</span><br>
                    <span>Bendahara</span>
                    <br><br><br><br><br>
                    <b>Yayah Makiyah, S.Pd.I</b>
                    <br>
                    NIP. -
                </td>
            </tr>
        </table>

        @php
            $start++;
        @endphp
    @endforeach

</body>
</html>