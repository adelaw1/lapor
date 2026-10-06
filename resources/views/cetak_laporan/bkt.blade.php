<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak BKT Revitalisasi 2026 SMK Ashhabul Maimanah Sidayu</title>
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
    </style>
</head>
<body>
    
    @php
        $laporan = $master->getDataLaporanGroupBulan()
                        ->filter(function ($item) {
                            return $item->mutasi === 'tarik' || $item->metode_pembayaran === 'tunai';
                        });
        $laporan_berdasarkan_bulan = $laporan->groupBy("bulan_tahun");
        $start = 1;
        $saldo = 0;
        $sisaSaldo = 0;
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
            <strong>BUKU KAS TUNAI REVITALISASI SMK ASHHABUL MAIMANAH SIDAYU</strong><br />
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
                    <th style="width: 15%;">Penerimaan</th>
                    <th style="width: 15%;">Pengeluaran</th>
                    <th style="width: 15%;">Saldo</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 0;
                    $masuk = 0;
                    $keluar = 0;
                @endphp
                @foreach ($groupLaporan as $item)
                    @php
                        $no++;
                        $masuk += ($item->mutasi == 'masuk' or $item->mutasi == 'tarik') ? $item->nominal : 0;
                        $keluar += ($item->mutasi == 'keluar') ? $item->nominal : 0;
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
                        </tr>
                        @php
                            $masuk += $sisaSaldo;
                            $no++;
                        @endphp
                    @endif

                    @php $saldo = ($masuk - $keluar); @endphp

                    @if ($item->kategori == 'belanja_material')
                        @php $saldoRinci = $saldo + $item->nominal; @endphp
                        @foreach ($item->barang as $brg)
                            @php $saldoRinci -= ($brg->qty * $brg->harga); @endphp
                            <tr>
                                <td style="text-align: center;">{{ $no++ }}</td>
                                <td style="text-align: center;">{{ $format->parse($item->tanggal)->isoFormat('D MMMM Y') }}</td>
                                <td style="text-align: center;">{{ $master->getNoBukti($item->mutasi, $item->metode_pembayaran) . $no_bukti }}</td>
                                <td>{{ $brg->nama_barang }}</td>
                                <td style="text-align: right;"></td>
                                <td style="text-align: right;">{{ number_format(($brg->qty * $brg->harga), 0, ',', '.') }}</td>
                                <td style="text-align: right;">{{ number_format($saldoRinci, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td style="text-align: center;">{{ $no }}</td>
                            <td style="text-align: center;">{{ $format->parse($item->tanggal)->isoFormat('D MMMM Y') }}</td>
                            <td style="text-align: center;">{{ $master->getNoBukti($item->mutasi, $item->metode_pembayaran) . $no_bukti }}</td>
                            <td>{{ $item->mutasi == 'tarik' ? 'Masuk Kas Tunai' : $item->uraian }}</td>
                            <td style="text-align: right;">{{ ($item->mutasi == 'masuk' or $item->mutasi == 'tarik') ? number_format($item->nominal, 0, ',', '.') : '' }}</td>
                            <td style="text-align: right;">{{ ($item->mutasi == 'keluar') ? number_format($item->nominal, 0, ',', '.') : '' }}</td>
                            <td style="text-align: right;">{{ number_format($saldo, 0, ',', '.') }}</td>
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
                </tr>
            </tfoot>
        </table>

        @php
            $tahun = Str::substr($groupLaporan->first()->tanggal, 0, 4);
            $bulan = Str::substr($groupLaporan->first()->tanggal, 5, 2);
            $titimangsa = $format->create($tahun, $bulan)->endOfMonth()->toDateString();
        @endphp

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