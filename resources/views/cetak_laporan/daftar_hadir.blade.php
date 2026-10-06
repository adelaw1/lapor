<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Daftar Hadir {{ Str::upper($status) }} Revitalisasi 2026 SMK Ashhabul Maimanah Sidayu</title>
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

        table.table-data td {
            height: 30px;
        }

        table.table-data th {
            background-color: #cfcfcf;
        }

        table#ttd {
            width: 100%;
            margin-top: 20px;
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
            <strong>DAFTAR HADIR {{ ($status == 'panitia' ? 'P2SP' : 'PEKERJA') }}</strong>
            <strong>PROGRAM REVITALISASI</strong><br />
            <strong>SMK ASHHABUL MAIMANAH SIDAYU</strong>
            <strong>BULAN {{ strtoupper($format->parse($item->tanggal)->isoFormat('MMMM')) }}
                TAHUN {{ $format->parse($item->tanggal)->isoFormat('Y') }}</strong>
        </div>

        Periode {{ $format->parse($mulai)->isoFormat('D MMMM Y') }} s.d {{ $format->parse($selesai)->isoFormat('D MMMM Y') }}

        <table class="table-data">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Nama</th>
                    <th rowspan="2">{{ $status == 'panitia' ? 'Jabatan' : 'Job' }}</th>
                    @php
                        $period = $periode->create($mulai, $selesai);
                    @endphp
                    @foreach ($period as $pr)
                        <th>{{ $format->parse($pr->format('Y-m-d'))->translatedFormat('l') }}</th>
                    @endforeach
                    <th rowspan="2">Ket</th>
                </tr>
                <tr>
                    @foreach ($period as $pr)
                        <th>{{ $pr->format('d/m') }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($pelaksana as $plk)
                    <tr>
                        <td style="text-align: center; width: 40px;">{{ $no++ }}</td>
                        <td style="width: 280px;">{{ $plk->nama }}</td>
                        <td style="width: 250px;">{{ $plk->honor->jabatan }}</td>
                        @foreach ($period as $col)
                            <td></td>
                        @endforeach
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table id="ttd">
            <tr>
                <td>
                    <span>Mengetahui,</span><br>
                    <span>Kepala SMK Ashhabul Maimanah Sidayu</span>
                    <br><br><br><br><br>
                    <b>Zamroni, M.pd.I</b>
                    <br>
                    NIP. -
                </td>
                <td>
                    <br>
                    <span>Ketua P2SP SMK Ashhabul Maimanah Sidayu</span>
                    <br><br><br><br><br>
                    <b>Ade Alawi Hasan</b>
                    <br>
                    NIP. -
                </td>
                <td>
                    Kab. Serang, {{ $format->parse($item->rentang_tanggal->tanggal_selesai)->isoFormat('D MMMM Y') }}<br>
                    <span>Bendahara P2SP SMK Ashhabul Maimanah Sidayu</span>
                    <br><br><br><br><br>
                    <b>Yayah Munayah, SE</b>
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