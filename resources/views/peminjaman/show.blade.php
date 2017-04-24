@extends('layouts.admin')

@section('title') Detail Data Peminjaman @endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Peminjaman</h4></div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('peminjaman') }}">Peminjaman</a></li>
                <li class="active">Detail</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"> Detail Peminjaman Rumah Dinas</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-body">
                                <div class="form-actions">
                                    <div class="row text-right">
                                        <div class="col-md-12">
                                            <a class="btn btn-default btn-rounded" href="{{ url('peminjaman/'.$peminjaman->id.'/sip') }}" target="_blank"> <i class="fa fa-book" ></i> SIP</a>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="box-title">Info Pegawai</h3>
                                <hr class="m-t-0 m-b-40">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Nama:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{ $peminjaman->pegawai->nama }} </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Golongan:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{ $peminjaman->pegawai->pangkat->golongan }} </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">NIP:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{ $peminjaman->pegawai->nip }} </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Jabatan:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{ $peminjaman->pegawai->jabatan->nama }} </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Jenis Kelamin:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{ $peminjaman->pegawai->jenis_kelamin }} </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">SKPD:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{ $peminjaman->pegawai->skpd->nama }} </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <h3 class="box-title">Info Peminjaman Rumah Dinas</h3>
                                <hr class="m-t-0 m-b-40">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Alamat:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{ $peminjaman->rumah->alamat }} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Awal:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{ $start_date->format('j F Y') }} </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Akhir:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{ $end_date->format('j F Y') }} </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Jumlah Hari:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">  {{ $diff_in_days }} </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Jumlah Bulan:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{ $diff_in_month }} </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Sewa / Bulan:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">  Rp.{{ number_format($peminjaman->harga_sewa, 0, '.', ',') }},- </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Perkiraan Sewa:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{ $perkiraan_total_sewa }} </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>

                            </div>
                            <hr class="m-t-0 m-b-40">
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <a class="btn btn-warning" href="{{ url('peminjaman/'.$peminjaman->id.'/edit') }}"> <i class="fa fa-pencil" ></i> Edit</a>
                                                <a class="btn btn-default" href="{{ url('peminjaman') }}">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"> </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('additional_script')

@stop