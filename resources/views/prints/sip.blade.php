@extends('layouts.print')

@section('additional_head')
    <title>Cetak SIP</title>
<style>
    .header-icon {
        height: 150px;
        margin: 15px;
    }

    .header-text-1 {
        margin-bottom: 0px;
        text-transform: capitalize;
        font-size: 16px;
    }

    .header-text-2 {
        text-transform: capitalize;
        font-weight: bold;
        font-size: 18px;
    }
    
    .header-text-3 {
        margin-bottom: 0px;
        text-align: center;
    }

    .horizontal-line {
        height: 5px;
        background: black;
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .content-table {
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        line-height: 1.42857143;
        color: #333333;
        width: 100%;
    }

    .content-table td {
        padding: 5px;
    }

    .ketentuan li {
        line-height:30px;
    }

    @media print {
        footer {page-break-after: always;}
    }
</style>
@endsection

@section('content')
    <div class="wrapper">
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="/img/instansi-logo.png" class="header-icon float-left"/>
                <div style="margin: 15px">
                    <p class="header-text-1">PEMERINTAH PROVINSI NUSA TENGGARA BARAT</p>
                    <p class="header-text-2">BADAN PENGELOLAAN KEUANGAN DAN ASET DAERAH<br>(BPKAD)</p>
                    <p class="header-text-3">Jl. Pejanggik Nomor 12  Telp. ( 0370 ) 627689, 625345 Fax. 627677</p>
                    <p class="header-text-3">Website : http://bpkad.ntbprov.go.id  Email : bpkad@ntbprov.go.id</p>
                    <p class="header-text-3">
                        M A T A R A M
                    </p>
                </div>

                <div class="horizontal-line"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="text-center">
                    <br>
                    <span class="header-text-2">SURAT IZIN PENGHUNIAN ( S I P )<br>
                    MENEMPATI RUMAH DINAS<br></span>
                    Nomor : 900 / 14.g /BPKAD/2017
                </p>

                <p>
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;Berdasarkan ketentuan Peraturan Daerah Provinsi Nusa Tenggara Barat Nomor 2
                    Tahun 1999 tentang Rumah Daerah, Gubernur Nusa Tenggara Barat memberikan izin untuk menghuni Rumah
                    Dinas Milik Pemerintah Provinsi Nusa Tenggara Barat sebagai tempat tinggal kepada yang
                    namanya tersebut dibawah ini :
                </p>

                <br>
                <table class="content-table">
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Nama</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $peminjaman->pegawai->nama }}</td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Nomor Induk Pegawai (NIP)</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $peminjaman->pegawai->nip }}</td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Jabatan / Pekerjaan</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $peminjaman->pegawai->jabatan->nama }}</td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Alamat Rumah</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $peminjaman->rumah->alamat }}</td>
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td>Golongan Rumah/Type</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $peminjaman->rumah->tipe->nama }}</td>
                        </tr>
                        <tr>
                            <td>6.</td>
                            <td>Sewa Tiap Bulan</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $peminjaman->tempat_pembayaran }}</td>
                        </tr>
                        <tr>
                            <td>7.</td>
                            <td>Dasar Pelaksanaan Tarif Sewa</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $peminjaman->dasar_pelaksanaan_tarif_sewa }}</td>
                        </tr>
                        <tr>
                            <td>8.</td>
                            <td>SIP Berlaku Tanggal</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ formatDate($peminjaman->start, 'Y-m-d', 'd-m-Y') }} s/d {{ formatDate($peminjaman->end, 'Y-m-d', 'd-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td>9.</td>
                            <td>Tarif Sewa Per Bulan</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>Rp. {{ number_format($peminjaman->harga_sewa, 0, ',', '.') }},- ({{ $peminjaman->terbilang }})</td>
                        </tr>
                        <tr>
                            <td>10.</td>
                            <td>Tempat Pembayaran</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $peminjaman->tempat_pembayaran }}</td>
                        </tr>
                    </tbody>
                </table>

                <br>
                <br>
            </div>
        </div>
        <div class="row" style="margin-top: 50px;">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <br><br>
                <div class="img-thumbnail" style="text-align: center; width:120px; height: 150px; display: flex;
    align-items: center;
    justify-content: center;">
                    PHOTO PEMEGANG SIP
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <p style="text-align: center;">
                    Mataram, {{ Carbon\Carbon::now()->format('j F Y') }}<br><br>
                    Kepala Badan Pengelolaan Keuangan dan Aset Daerah<br>
                    Provinsi Nusa Tenggara Barat<br><br><br><br><br><br>

                    <span style="font-weight: bold; text-decoration: underline;">Drs. H. SUPRAN, M.M</span><br>
                    Nip. 19591231 199003 1 077
                </p>
            </div>
        </div>
        <footer>
            <div class="row">
                <div class="col-md-12">
                    <p style="margin-top: 120px;">
                        Lembar 1 untuk Pemegang SIP<br>
                        Lembar 2 untuk Kepala BPKAD Prov.NTB
                        <br>
                        <br>
                        <br>
                        KETENTUAN MENEMPATI RUMAH DINAS
                        TERTERA DI BALIK HALAMAN INI
                    </p>
                </div>

            </div>
        </footer>

        <div class="row">
            <div class="col-md-12">
                <h4 style="text-align: center;">KETENTUAN MENEMPATI RUMAH DINAS<br>
                    MILIK PEMERINTAH PROVINSI NUSA TENGGARA BARAT</h4>
                <br><br>
                <ol class="ketentuan">
                    <li>Pejabat/PNS yang masih aktif mengabdi pada Pemerintah Provinsi.</li>
                    <li>Memiliki Surat Izin Penghunian (SIP) dari Gubernur Nusa Tenggara Barat.</li>
                    <li>Suami dan istri yang masing-masing berstatus sebagai Pegawai Negeri, hanya dapat menghuni 1 (satu) Rumah Dinas.</li>
                    <li>Setiap Pemegang SIP, wajib menempati rumah dinas selambat-lambatnya dalam jangka waktu 30 hari sejak SIP diterima.</li>
                    <li>SIP berakhir apabila
                        <ul>
                            <li>Telah habis masa berlaku dan tidak dilakukan perpanjangan SIP.</li>
                            <li>Penghuni tidak lagi bertugas pada Pemerintah Provinsi NTB.</li>
                            <li>Penggunaan rumah dinas tidak sesuai peruntukannya.</li>
                            <li>Pemegang SIP diberhentikan dengan tidak hormat sebagai Pegawai Negeri.</li>
                            <li>Penghuni meninggal dunia.</li>
                        </ul>
                    </li>
                    <li>
                        Penghuni rumah dinas berkewajiban :
                        <ul>
                            <li>Membayar sewa sesuai dengan Peraturan Gubernur No. 6 Tahun 2014 tentang Perubahan Tarif Retribusi Jasa Usaha.</li>
                            <li>Melakukan pembayaran sewa setiap bulan melalui Bendahara Gaji SKPD kepada Bendahara Penerima BPKAD Provinsi NTB paling lambat setiap tanggal 25 bulan berjalan.</li>
                            <li>Membayar denda keterlambatan sewa rumah sebesar 2 % (dua persen) setiap bulan sesuai Perda No. 3 Tahun 2011.</li>
                            <li>Memelihara rumah dan memanfaatkan sesuai dengan fungsinya.</li>
                            <li>Menyerahkan Kembali apabila Rumah Dinas Tersebut Sewaktu waktu diperlukan oleh Pemerintah Provinsi NTB untuk Menunjang Tupoksi yang strategis.</li>
                            <li>Mengembalikan dalam keadaan baik kepada Pemerintah Provinsi NTB apabila rumah tidak ditempati lagi.</li>
                            <li>Bagi PNS yang sudah memasuki masa pensiun berkewajiban mengembalikan rumah yang ditempati paling lambat 1 (satu) bulan setelah berakhirnya penghunian.</li>
                            <li>Membayar segala pembayaran terkait rumah dinas (PBB, listrik, air dan sejenisnya).</li>
                        </ul>
                    </li>
                    <li>
                        Penghuni Rumah dinas dilarang :
                        <ul>
                            <li>Menyerahkan sebagaian atau seluruh rumah kepada pihak lain.</li>
                            <li>Mengubah sebagian atau seluruh bentuk rumah.</li>
                            <li>Memanfaatkan rumah tidak sesuai dengan fungsinya.</li>
                            <li>Menyewakan rumah kepada orang lain.</li>
                            <li>Memusnahkan/menghilangkan rumah yang ditempati.</li>
                            <li>Meminta ganti rugi dalam bentuk apapun kepada Pemerintah Provinsi NTB maupun kepada Penghuni Baru Pemegang SIP, apabila penghuni lama tidak berhak lagi menempati Rumah Dinas.</li>
                        </ul>
                    </li>
                    <li>SIP berlaku 1 (satu) tahun dan dapat diperpanjang kembali selesai masa berlaku.</li>
                    <li>Bagi Pemegang SIP yang sudah tidak menghuni rumah dinas agar segera mengembalikan SIP beserta kunci rumah dinas dengan melaporkan kepada Sekda Provinsi NTB Cq. Kepala BPKAD Provinsi NTB.</li>
                    <li>Dalam rangka penertiban dan pengamanan rumah dinas, diharapkan memberikan informasi jika ada rumah dinas disekitar yang tidak sesuai dengan peruntukannya.</li>
                </ol>
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-7"></div>
            <div class="col-md-5">
                <p style="text-align: center;">
                    Setuju dengan ketentuan tersebut diatas<br>
                    Penghuni Rumah / Pemegang SIP<br><br><br><br><br>

                    <span style="text-decoration: underline;">{{ $peminjaman->pegawai->nama }}</span><br>
                    Nip. {{ $peminjaman->pegawai->nip }}
                </p>
            </div>
        </div>
    </div>

    <script>
        window.print();
    </script>
@endsection