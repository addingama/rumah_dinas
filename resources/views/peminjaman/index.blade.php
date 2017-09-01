@extends('layouts.admin')

@section('title') Data Peminjaman @endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Peminjaman</h4></div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="active">Peminjaman</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <a href="{{ url('peminjaman/create') }}" class="btn btn-info float-right">Tambah</a>
                <h3 class="box-title m-b-0">Daftar Peminjaman</h3>
                <p class="text-muted m-b-30">Data peminjaman rumah dinas BPKAD</p>
                <div class="table-responsive">
                    <table id="table_index" class="display nowrap color-table dark-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Peminjam</th>
                            <th>Rumah</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th class="text-right">Menu</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>NIP</th>
                            <th>Peminjam</th>
                            <th>Rumah</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th class="text-right">Menu</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @if ($list_peminjaman->count() > 0)
                            @foreach($list_peminjaman as $peminjaman)
                                <tr>
                                    <td>{{ $peminjaman->pegawai != null ? $peminjaman->pegawai->nip : '-' }}</td>
                                    <td>{{ $peminjaman->pegawai != null ? $peminjaman->pegawai->nama : '-' }}</td>
                                    <td>{{ $peminjaman->rumah->alamat }}</td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $peminjaman->start)->format('j F Y') }}</td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $peminjaman->end)->format('j F Y') }}</td>
                                    <td class="text-right">
                                        <a href="{{ url('peminjaman/'. $peminjaman->id ) }}"><i class="fa fa-laptop text-warning"></i></a>
                                        <a href="{{ url('peminjaman/'. $peminjaman->id . '/edit') }}"><i class="ti-pencil"></i></a>
                                        <a href="javascript:submit('{{$peminjaman->id}}')" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" ><i class="ti-trash text-danger"></i></a>
                                        {{ Form::open(array('url' => 'peminjaman/' . $peminjaman->id, 'class' => 'pull-right', 'id' => 'delete'. $peminjaman->id)) }}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center text-danger">Belum ada data</td>
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
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]

        });

        function submit(id) {
            $('#delete' + id).submit();
        }
    </script>
@stop
