@extends('layouts.admin')

@section('title') Data Rumah @endsection

@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Rumah</h4></div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="active">Rumah</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <a href="{{ url('rumah/create') }}" class="btn btn-info float-right">Tambah</a>
                <h3 class="box-title m-b-0">Daftar Rumah</h3>
                <p class="text-muted m-b-30">Data rumah dinas BPKAD</p>
                <div class="table-responsive">
                    <table id="table_index" class="display nowrap color-table dark-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Alamat</th>
                            <th>Tipe Rumah</th>
                            <th>Kondisi Rumah</th>
                            <th class="text-right">Harga Sewa</th>
                            <th>Keterangan</th>
                            <th class="text-right">Menu</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Alamat</th>
                            <th>Tipe Rumah</th>
                            <th>Kondisi Rumah</th>
                            <th class="text-right">Harga Sewa</th>
                            <th>Keterangan</th>
                            <th class="text-right">Menu</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @if ($list_rumah->count() > 0)
                            @foreach($list_rumah as $rumah)
                                <tr>
                                    <td>{{ $rumah->alamat }}</td>
                                    <td>{{ $rumah->tipe_rumah }}</td>
                                    <td>{{ $rumah->kondisi }}</td>
                                    <td class="text-right">{{ number_format($rumah->harga_sewa, 0, ',', '.') }}
                                    </td>
                                    <td>{{ $rumah->keterangan }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('rumah/'. $rumah->id . '/edit') }}"><i class="ti-pencil"></i></a>
                                        <a href="javascript:submit('{{$rumah->id}}')"
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                    class="ti-trash text-danger"></i></a>
                                        {{ Form::open(array('url' => 'rumah/' . $rumah->id, 'class' => 'pull-right', 'id' => 'delete'. $rumah->id)) }}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-center text-danger">Belum ada data</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- /.modal -->
        <div id="import-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true" style="display: none;">
            <div class="modal-dialog" style="margin-top: 150px;">
                <div class="modal-content">
                    {{ Form::open(['url' => 'rumah/import', 'method' => 'POST', 'files' => true]) }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Import Data Rumah</h4></div>
                    <div class="modal-body">

                        <p>
                            Fitur ini berguna untuk melakukan import data rumah dengan format file Microsoft
                            Excel. File contoh untuk format import data dapat diunduh pada link berikut :
                            <a href="{{ URL::to('downloads/Format_Import_Data_Rumah.xlsx') }}"
                               title="Format Import Data Rumah">Format Import Data Rumah</a>
                        </p>
                        <div class="form-group">
                            {{ Form::label('file', 'File') }}
                            {{ Form::file('file', ['required', 'class' => 'form-control', 'autofocus' => 'autofocus', 'accept' => '.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel'])}}
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Import</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->
    </div>



@endsection

@section('additional_script')
    <script src="//cdn.datatables.net/plug-ins/1.10.15/sorting/currency.js"></script>
    <script>
        $('#table_index').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    text: 'Import',
                    className: 'btn btn-info',
                    action: function (e, dt, node, config) {
                        $('#import-modal').modal('show');
                    }
                }
            ]
        });

        function submit(id) {
            $('#delete' + id).submit();
        }
    </script>
@stop