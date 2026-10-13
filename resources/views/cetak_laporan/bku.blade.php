<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak BKU Revitalisasi 2026 SMK Ashhabul Maimanah Sidayu</title>
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
            width: 100%;
            margin-top: 20px;
        }

        table.keadaan {
            width: 50%;
            margin: 0 auto;
        }

        table.keadaan,
        table.keadaan tr,
        table.keadaan tr td {
            border: 1px solid #000;
            border-collapse: collapse;
            border-spacing: none;
            padding: 4px;
        }

        table.keadaan tr td:first-child {
            text-align: right;
        }
    </style>
</head>
<body>
    
    @php
        $laporan = $master->getDataLaporanGroupBulan();
        $laporan_berdasarkan_bulan = $laporan->groupBy("bulan_tahun");
        $start = 1;
        $saldo = 0;
        $sisaSaldo = 0;
        $tarik = 0;
        $saldoBank = 0;
        $saldoTunai = 0;
        $bkkb = 0;
        $bkkt = 0;
        $bkmb = 0;
        $bkmt = 0;
        $no_bukti = 0;
    @endphp

    @foreach ($laporan_berdasarkan_bulan as $groupLaporan)
        @if ($start > 1)
            <div class="page-break"></div>
        @endif

        <div style="text-align: center; margin-bottom: 20px;">
            <strong>BUKU KAS UMUM REVITALISASI SMK ASHHABUL MAIMANAH SIDAYU</strong><br />
            <strong>BULAN {{ strtoupper($format->parse($groupLaporan->first()->tanggal)->isoFormat('MMMM')) }}
                TAHUN {{ $format->parse($groupLaporan->first()->tanggal)->isoFormat('Y') }}</strong>
        </div>

        <table class="table-data">
            <thead>
                <tr>
                    <th style="width: 2%;">No</th>
                    <th style="width: 10%;">Tanggal</th>
                    <th style="width: 8%;">No. Bukti</th>
                    <th style="width: 35%;">Uraian</th>
                    <th style="width: 10%;">Penerimaan</th>
                    <th style="width: 10%;">Pengeluaran</th>
                    <th style="width: 10%;">Saldo</th>
                    <th style="width: 15%;">Bukti</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 0;
                    $masuk = 0;
                    $keluar = 0;
                    $transfer = $groupLaporan->where('metode_pembayaran', '=', 'transfer');
                    $tunai = $groupLaporan->where('metode_pembayaran', '=', 'tunai');
                    $tarik += $groupLaporan->where('mutasi', '=', 'tarik')->sum('nominal');
                    $saldoBank += $transfer->where('mutasi', '=', 'masuk')->sum('nominal') - $transfer->where('mutasi', '=', 'keluar')->sum('nominal');
                    $saldoTunai += $tunai->where('mutasi', '=', 'masuk')->sum('nominal') - $tunai->where('mutasi', '=', 'keluar')->sum('nominal');
                @endphp
                @foreach ($groupLaporan as $item)
                    @php
                        $no++;
                        $masuk += $item->mutasi == 'masuk' ? $item->nominal : 0;
                        $keluar += $item->mutasi == 'keluar' ? $item->nominal : 0;
                    @endphp

                    @if ($item->mutasi == 'masuk')
                        @if ($item->metode_pembayaran == 'transfer')
                            @php
                                $bkmb++;
                                $no_bukti = $bkmb;
                            @endphp
                        @else
                            @php
                                $bkmt++;
                                $no_bukti = $bkmt;
                            @endphp
                        @endif
                    @else
                        @if ($item->metode_pembayaran == 'transfer')
                            @php
                                $bkkb++;
                                $no_bukti = $bkkb;
                            @endphp
                        @else
                            @php
                                $bkkt++;
                                $no_bukti = $bkkt;
                            @endphp
                        @endif
                    @endif

                    @php
                        $no_bukti = ($no_bukti < 10 ? "00" : ($no_bukti < 100 ? "0" : "")) . $no_bukti;
                    @endphp

                    @if ($no < 2 && $sisaSaldo)
                        <tr>
                            <td style="text-align: center;">{{ $no }}</td>
                            <td style="text-align: center;">1 {{ $format->parse($item->tanggal)->isoFormat('MMMM Y') }}</td>
                            <td style="text-align: center;"></td>
                            <td>Saldo Bulan Lalu</td>
                            <td style="text-align: right;">{{ number_format($sisaSaldo, 0, ',', '.') }}</td>
                            <td style="text-align: right;"></td>
                            <td style="text-align: right;">{{ number_format($sisaSaldo, 0, ',', '.') }}</td>
                            <td>-</td>
                        </tr>
                        @php
                            $masuk += $sisaSaldo;
                            $no++;
                        @endphp
                    @endif

                    @php $saldo = ($masuk - $keluar); @endphp

                    @if ($item->mutasi == 'tarik')
                        <tr>
                            <td style="text-align: center;">{{ $no++ }}</td>
                            <td style="text-align: center;">{{ $format->parse($item->tanggal)->isoFormat('D MMMM Y') }}</td>
                            <td style="text-align: center;">{{ $master->getNoBukti($item->mutasi, $item->metode_pembayaran) . $no_bukti }}</td>
                            <td>{{ $item->uraian }}</td>
                            <td style="text-align: right;"></td>
                            <td style="text-align: right;">{{ number_format($item->nominal, 0, ',', '.') }}</td>
                            <td style="text-align: right;">{{ number_format($saldo - $item->nominal, 0, ',', '.') }}</td>
                            <td>
                                @if ($item->bukti)
                                    {{ Request::root() }}/storage/{{ $item->bukti }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">{{ $no }}</td>
                            <td style="text-align: center;">{{ $format->parse($item->tanggal)->isoFormat('D MMMM Y') }}</td>
                            <td style="text-align: center;"></td>
                            <td>Kas Masuk Tunai</td>
                            <td style="text-align: right;">{{ number_format($item->nominal, 0, ',', '.') }}</td>
                            <td style="text-align: right;"></td>
                            <td style="text-align: right;">{{ number_format($saldo, 0, ',', '.') }}</td>
                            <td>-</td>
                        </tr>
                    @else
                        <tr>
                            <td style="text-align: center;">{{ $no }}</td>
                            <td style="text-align: center;">{{ $format->parse($item->tanggal)->isoFormat('D MMMM Y') }}</td>
                            <td style="text-align: center;">{{ $master->getNoBukti($item->mutasi, $item->metode_pembayaran) . $no_bukti }}</td>
                            <td>
                                {{ $item->uraian }}
                                @if ($item->status)
                                    @if ($item->status == 'panitia')
                                        @php $jml = $master->getDataPanitia()->count(); @endphp
                                        ({{ $jml }} org)
                                    @else
                                        @php $jml = $master->getDataPekerja()->count(); @endphp
                                        ({{ $jml }} org)
                                    @endif
                                @endif
                            </td>
                            <td style="text-align: right;">{{ $item->mutasi == 'masuk' ? number_format($item->nominal, 0, ',', '.') : '' }}</td>
                            <td style="text-align: right;">{{ $item->mutasi == 'keluar' ? number_format($item->nominal, 0, ',', '.') : '' }}</td>
                            <td style="text-align: right;">{{ number_format($saldo, 0, ',', '.') }}</td>
                            <td style="word-break: break-all; overflow-wrap: anywhere; max-width: 150px;">
                                @if ($item->bukti)
                                    <a href="{{ Request::root() }}/storage/{{ $item->bukti }}">
                                        {{ Request::root() }}/storage/{{ $item->bukti }}
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">TOTAL</th>
                    <th style="text-align: right;">{{ number_format($masuk, 0, ',', '.') }}</th>
                    <th style="text-align: right;">{{ number_format($keluar, 0, ',', '.') }}</th>
                    <th style="text-align: right;">{{ number_format($saldo, 0, ',', '.') }}</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>

        @php
            $tahun = Str::substr($groupLaporan->first()->tanggal, 0, 4);
            $bulan = Str::substr($groupLaporan->first()->tanggal, 5, 2);
            $titimangsa = $format->create($tahun, $bulan)->endOfMonth()->toDateString();
        @endphp

        <p>Pada hari ini, {!! $format->parse($titimangsa)->toSpelledOutIndonesian() !!} Buku kas ditutup dengan keadaan posisi sebagai berikut :</P>
        
        <table class="keadaan">
            <tr>
                <td>Pengeluaran</td>
                <td>{{ number_format($keluar, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Saldo Buku Kas Umum</td>
                <td>{{ number_format($saldo, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Saldo Tunai</td>
                <td>{{ number_format(($saldoTunai + $tarik), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Saldo Bank</td>
                <td>{{ number_format(($saldoBank - $tarik), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Selisih</td>
                <td>{{ number_format(($saldo - ($saldoTunai + $saldoBank)), 0, ',', '.') }}</td>
            </tr>
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
                    Kab. Serang, {{ $format->parse($titimangsa)->isoFormat('D MMMM Y') }}<br>
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
            $sisaSaldo = $saldo;
        @endphp
    @endforeach

</body>
</html>