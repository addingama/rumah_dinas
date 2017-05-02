@extends('layouts.admin')
@section('title') Ubah Peminjaman @endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Peminjaman</h4></div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('peminjaman') }}">Peminjaman</a></li>
                <li class="active">Ubah</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"> Ubah Peminjaman</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        {{ Form::model($peminjaman, ['route' => ['peminjaman.update', $peminjaman->id], 'class'=>'form-horizontal form-bordered', 'method' => 'PUT']) }}
                        <div class="form-body">
                            @include('peminjaman.form', [$list_rumah, $list_pangkat])
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
                                                Simpan
                                            </button>
                                            <a class="btn btn-default" href="{{ url('peminjaman') }}">Batal</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
