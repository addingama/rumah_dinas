@extends('layouts.print')

@section('additional_head')
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
                            <td>Evy Susyarlin Marakarma, S.Sos</td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Nomor Induk Pegawai (NIP)</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>19730312 199303 2 007</td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Jabatan / Pekerjaan</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>Kasubbag TU dan Kepegawaian pada Sekretariat DPRD Provinsi NTB</td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Jabatan / Pekerjaan</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>Jl. Udayana Eks Komplek DPRD No. 26 Mataram</td>
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td>Golongan Rumah/Type</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>II/70</td>
                        </tr>
                        <tr>
                            <td>6.</td>
                            <td>Sewa Tiap Bulan</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>Dibayar pada Bendahara Penerimaan BPKAD Provinsi NTB</td>
                        </tr>
                        <tr>
                            <td>7.</td>
                            <td>Dasar Pelaksanaan Tarif Sewa</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>Pergub No. 6 Tahun  2014 Tanggal 11 Maret 2014</td>
                        </tr>
                        <tr>
                            <td>8.</td>
                            <td>SIP Berlaku Tanggal</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>03-01-2017 s/d 31-12-2017</td>
                        </tr>
                        <tr>
                            <td>9.</td>
                            <td>Tarif Sewa Per Bulan</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>Rp. 357.405,- (Tiga Ratus Lima Puluh Tujuh Ribu Empat Ratus Lima Rupiah)</td>
                        </tr>
                        <tr>
                            <td>10.</td>
                            <td>Tempat Pembayaran</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>Bendahara Penerimaan pada Badan Pengelolaan Keuangan dan Aset Daerah Provinsi NTB</td>
                        </tr>
                    </tbody>
                </table>

                <br>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">

            </div>
            <div class="off"
        </div>
    </div>
@endsection