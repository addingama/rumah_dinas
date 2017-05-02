@extends('layouts.admin')

@section('title') Dashboard @endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Dashboard</h4></div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li class="active">Dashboard</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-6">
            <a href="{{ url('rumah') }}">
                <div class="white-box">
                    <div class="r-icon-stats"><i class="ti-home bg-megna"></i>
                        <div class="bodystate">
                            <h4>{{ $jumlah_rumah }}</h4> <span class="text-muted">Rumah Dinas</span></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="{{ url('rumah?status=not_available') }}">
                <div class="white-box">
                    <div class="r-icon-stats"><i class="ti-shopping-cart bg-info"></i>
                        <div class="bodystate">
                            <h4>{{ $jumlah_rumah_terpinjam }}</h4> <span class="text-muted">Rumah Terpinjam</span></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="{{ url('rumah?status=available') }}">
                <div class="white-box">
                    <div class="r-icon-stats"><i class="ti-wallet bg-success"></i>
                        <div class="bodystate">
                            <h4>{{ $jumlah_rumah_tersedia }}</h4> <span class="text-muted">Rumah Tersedia</span></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="white-box">
                <div class="r-icon-stats"><i class="ti-wallet bg-inverse"></i>
                    <div class="bodystate">
                        <h4>$34650</h4> <span class="text-muted">Pendapatan BPKAD</span></div>
                </div>
            </div>
        </div>
    </div>
@endsection