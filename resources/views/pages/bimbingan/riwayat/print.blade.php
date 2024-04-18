<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Riwayat Bimbingan Semester {{ $semester->code }}</title>
    <meta http-equiv="Content-Type" content="charset=utf-8" />
    <link rel="stylesheet" href="{{ public_path('css') }}/pdf/bootstrap.min.css" media="all" />
    <style>
        body {
            font-family: 'times new roman';
            font-size: 11px;
        }

        hr {
            margin: 1px;
            ;
            border: none;
            border-top: 2px dashed #000;
        }

        tr {
            margin: 0 !important;
            padding: 0 !important;
        }

        .table-custom {
            border-collapse: collapse;
            width: 100%;
        }

        .table-custom tr,
        .table-custom th,
        .table-custom td {
            padding-left: 5px;
            border: 1px solid black;
        }
    </style>
    <link href="{{ public_path('img/favicon.png') }}" rel="icon" type="image/png">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"> --}}
</head>

<body>
    <main>
        <table style="font-size: 11px; width:100%; margin-bottom:10px;">
            <tr>
                <td style="width: 20%" class="text-center">
                    <img style="width: 100px;" src="{{ public_path('img') }}/musamus.png">
                </td>
                <td class="text-center" style="width: 80%">
                    <b>
                        KEMENTRIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI<br>
                        UNIVERSITAS MUSAMUS<br>
                        FAKULTAS TEKNIK<br>
                        JURUSAN SISTEM INFORMASI<br>
                        Jl.Kamizaun Mopah Lama Merauke 99600<br>
                    </b>
                    Telp/Fax (0971) 3306514/325976

                </td>
                <td style="width: 20%"></td>
            </tr>
        </table>
        <hr>
        <center>
            <b>
                Kartu Kontrol Bimbingan Akademik Mahasiswa Sistem Informasi<br>
                Tahun Akademik {{ $semester->code }}
            </b>
        </center>
        <hr>
        <br>
        <table style="font-size: 11px; width:100%;">
            <tr>
                <td><b>Nama Mahasiswa</b></td>
                <td style="width: 5px;">:</td>
                <td style="width: 30%;">{{ $mahasiswa->name }}</td>
                <td><b>Dosen Pendamping Akademik</b></td>
                <td style="width: 5px;">:</td>
                <td>{{ $dosen_pa ? $dosen_pa->dosen->name . ' ' . $dosen_pa->dosen->last_name : null }}</td>
            </tr>
            <tr>
                <td><b>NPM</b></td>
                <td style="width: 5px;">:</td>
                <td>{{ $mahasiswa->npm }}</td>
                <td><b>NIP/NIDN</b></td>
                <td style="width: 5px;">:</td>
                <td>{{ $dosen_pa ? $dosen_pa->dosen->nip : null }}</td>
            </tr>
            <tr>
                <td><b>Semester</b></td>
                <td style="width: 5px;">:</td>
                <td>{{ $semester_mahasiswa ?? 0 }}</td>
                <td></td>
                <td style="width: 5px;"></td>
                <td></td>
            </tr>
        </table>
        <table class="table-custom my-2">
            <thead>
                <tr>
                    <th style="width:20%;" class="text-center">Tanggal/Bln/Tahun</th>
                    @foreach ($data->sortBy('id_layanan') as $bimbinganItem)
                        @php
                            $hasil = App\Models\BimbinganHasil::where('id_bimbingan', $bimbinganItem->id)->first();
                        @endphp
                        <th class="text-center" style="width:20%;">
                            {{ $hasil ? Carbon\Carbon::parse($hasil->created_at->format('d F Y'))->locale('id')->isoFormat('LL') : '' }}
                        </th>
                    @endforeach
                    @for ($i = 1; $i <= 4 - $data->count(); $i++)
                        <th></th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="widtd:10%;">Nama Kegiatan</td>
                    @foreach ($data->sortBy('id_layanan') as $bimbinganItem)
                        @php
                            $hasil = App\Models\BimbinganHasil::where('id_bimbingan', $bimbinganItem->id)
                                ->where('judul', 'Nama Kegiatan')
                                ->first();
                        @endphp
                        <td>{{ $hasil ? $hasil->isi : '' }}</td>
                    @endforeach
                    @for ($i = 1; $i <= 4 - $data->count(); $i++)
                        <td></td>
                    @endfor
                </tr>
                <tr>
                    <td style="widtd:10%;">Tujuan Kegiatan</td>
                    @foreach ($data->sortBy('id_layanan') as $bimbinganItem)
                        @php
                            $hasil = App\Models\BimbinganHasil::where('id_bimbingan', $bimbinganItem->id)
                                ->where('judul', 'Tujuan Kegiatan')
                                ->first();
                        @endphp
                        <td>{{ $hasil ? $hasil->isi : '' }}</td>
                    @endforeach
                    @for ($i = 1; $i <= 4 - $data->count(); $i++)
                        <td></td>
                    @endfor
                </tr>
                <tr>
                    <td style="widtd:10%;">Hambatan</td>
                    @foreach ($data->sortBy('id_layanan') as $bimbinganItem)
                        @php
                            $hasil = App\Models\BimbinganHasil::where('id_bimbingan', $bimbinganItem->id)
                                ->where('judul', 'Hambatan')
                                ->first();
                        @endphp
                        <td>{{ $hasil ? $hasil->isi : '' }}</td>
                    @endforeach
                    @for ($i = 1; $i <= 4 - $data->count(); $i++)
                        <td></td>
                    @endfor
                </tr>
                <tr>
                    <td style="widtd:10%;">Kesimpulan & Saran</td>
                    @foreach ($data->sortBy('id_layanan') as $bimbinganItem)
                        @php
                            $hasil = App\Models\BimbinganHasil::where('id_bimbingan', $bimbinganItem->id)
                                ->where('judul', 'Kesimpulan & Saran')
                                ->first();
                        @endphp
                        <td>{{ $hasil ? $hasil->isi : '' }}</td>
                    @endforeach
                    @for ($i = 1; $i <= 4 - $data->count(); $i++)
                        <td></td>
                    @endfor
                </tr>
                <tr>
                    <td style="widtd:10%;">Perkembangan PKL, KKN, SEMINAR, SKRIPSI</td>
                    @foreach ($data->sortBy('id_layanan') as $bimbinganItem)
                        @php
                            $hasil = App\Models\BimbinganHasil::where('id_bimbingan', $bimbinganItem->id)
                                ->where('judul', 'Perkembangan PKL,KKN,SEMINAR,SKRIPSI')
                                ->first();
                        @endphp
                        <td>{{ $hasil ? $hasil->isi : '' }}</td>
                    @endforeach
                    @for ($i = 1; $i <= 4 - $data->count(); $i++)
                        <td></td>
                    @endfor
                </tr>
                <tr>
                    <td style="widtd:10%;">Rencana Kegiatan Selanjutnya</td>
                    @foreach ($data->sortBy('id_layanan') as $bimbinganItem)
                        @php
                            $hasil = App\Models\BimbinganHasil::where('id_bimbingan', $bimbinganItem->id)
                                ->where('judul', 'Rencana Kegiatan Selanjutnya')
                                ->first();
                        @endphp
                        <td>{{ $hasil ? $hasil->isi : '' }}</td>
                    @endforeach
                    @for ($i = 1; $i <= 4 - $data->count(); $i++)
                        <td></td>
                    @endfor
                </tr>
                <tr>
                    <td class="text-center">Paraf</td>
                    @for ($i = 1; $i <= 4; $i++)
                        <td class="text-center"><b>{{ $i }}</b></td>
                    @endfor
                </tr>
                <tr>
                    <td class="text-center" style="height:50px;">Dosen PA</td>
                    @for ($i = 1; $i <= 4; $i++)
                        <td class="text-center"></td>
                    @endfor
                </tr>
            </tbody>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="font-size: 10px; width:70%;">
                    Catatan :<br>
                    <span class="text-danger">
                        Mahassiswa wajib melakukan bimbingan akademik minimal 4x dalam 1 semester<br>
                        <ol>
                            <li>Saat registrasi awal semester</li>
                            <li>Konsultasi menjelang UTS</li>
                            <li>Konsultasi menjelang UAS</li>
                            <li>Masalah akademik lainnya</li>
                        </ol>
                    </span>
                </td>
                <td>
                    Mengetahui,<br>
                    <b>
                        Ketua Jurusan Sistem Informasi
                    </b>
                    <br><br><br><br>
                    <b>
                        <u>
                            Ir. Jarot Budiasto, S.T., M.T
                        </u><br>
                        NIP.198103042012121004
                    </b>
                </td>
            </tr>
        </table>
    </main>

</body>

</html>
