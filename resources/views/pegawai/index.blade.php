@extends('layouts.admin')

@section('title') Data Pegawai @endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Pegawai</h4></div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="active">Pegawai</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <a href="{{ url('pegawai/create') }}" class="btn btn-info float-right">Tambah</a>
                <h3 class="box-title m-b-0">Daftar Pegawai</h3>
                <p class="text-muted m-b-30">Data pegawai peminjam rumah dinas BPKAD</p>
                <div class="table-responsive">
                    <table id="table_index" class="display nowrap color-table dark-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Golongan</th>
                            <th>Jabatan</th>
                            <th>SKPD</th>
                            <th class="text-right">Menu</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Golongan</th>
                            <th>Jabatan</th>
                            <th>SKPD</th>
                            <th class="text-right">Menu</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @if ($list_pegawai->count() > 0)
                            @foreach($list_pegawai as $pegawai)
                                <tr>
                                    <td>{{ $pegawai->nip }}</td>
                                    <td>{{ $pegawai->nama }}</td>
                                    <td>{{ $pegawai->pangkat->golongan }}</td>
                                    <td>{{ $pegawai->jabatan->nama }}</td>
                                    <td>{{ $pegawai->skpd->nama }}</td>
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ url('pegawai/'. $pegawai->id . '/edit') }}"
                                           class="btn btn-warning"><i
                                                    class="ti-pencil"></i> Ubah</a>
                                        <a href="javascript:submit('{{$pegawai->id}}')" class="btn btn-danger"
                                           onclick="return confirm('Data penyewaan pegawai tersebut akan ikut terhapus dan tidak dapat dikembalikan. Apakah Anda yakin ingin menghapus data ini?')"><i
                                                    class="ti-trash"></i> Hapus</a>
                                        {{ Form::open(array('url' => 'pegawai/' . $pegawai->id, 'class' => 'pull-right', 'id' => 'delete'. $pegawai->id)) }}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td></td>
                                <td class="text-center text-danger">Belum ada data</td>
                                <td></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>


@endsection

@section('additional_script')
    <script>
        $('#table_index').DataTable({
            dom: 'Bfrtip'
            , buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

        function submit(id) {
            $('#delete' + id).submit();
        }
    </script>
@stop