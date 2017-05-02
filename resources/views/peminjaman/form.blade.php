@push('styles')
<!-- Date picker plugins css -->
<link href="/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet"
      type="text/css"/>
<!-- Daterange picker plugins css -->
<link href="/plugins/bower_components/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
<link href="/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
@endpush

{{ Html::ul($errors->all()) }}

<div class="form-group">
    <label class="control-label col-md-3">Nama <span
                class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::text('nama', null, ['class' => 'form-control pegawai-search', 'placeholder' => 'Nama Pegawai', 'required', 'id' => 'nama']) }}
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">Nomor Induk Pegawai (NIP) <span
                class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::text('nip', null, ['class' => 'form-control pegawai-search', 'placeholder' => '19790518 201001 2 011', 'required', 'id' => 'nip']) }}
    </div>
</div>


<div class="form-group">
    <label class="control-label col-md-3">Telepon </label>
    <div class="col-md-9">
        {{ Form::text('telepon', null, ['class' => 'form-control', 'placeholder' => '087800001111', 'id' => 'telepon']) }}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3">Jenis Kelamin <span
                class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::select('jenis_kelamin', ['L' => 'Laki-Laki', 'P' => 'Perempuan'], null, ['class' => 'form-control', 'required', 'id' => 'jenis_kelamin']) }}
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">Pangkat <span
                class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::select('pangkat_id', $list_pangkat, null, ['class' => 'form-control', 'required', 'id' => 'pangkat']) }}
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">Jabatan <span
                class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::text('jabatan', null, ['class' => 'form-control', 'id' => 'jabatan', 'placeholder' => 'Instruktur Penyelia', 'id' => 'jabatan']) }}
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">SKPD <span
                class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::text('skpd', null, ['class' => 'form-control', 'id' => 'skpd', 'placeholder' => 'Dinas Perdagangan Provinsi NTB', 'id' => 'skpd']) }}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3">Alamat Rumah Dinas <span
                class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::select('rumah_id', $list_rumah, null, ['class' => 'form-control', 'required']) }}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3">Tanggal Peminjaman <span
                class="text-danger">*</span></label>
    <div class="col-md-9">
        <div class="input-daterange input-group" id="date-range">
            {{ Form::text('start', null, ['class' => 'form-control', 'required']) }}
             <span class="input-group-addon bg-info b-0 text-white">s/d</span>
            {{ Form::text('end', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3">Dasar Pelaksanaan Tarif Sewa <span
                class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::text('dasar_pelaksanaan_tarif_sewa', 'Pergub No. 6 Tahun 2014 Tanggal 11 Maret 2014', ['class' => 'form-control', 'required']) }}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3">Tempat Pembayaran <span
                class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::text('tempat_pembayaran', 'Bendahara Penerimaan pada Badan Pengelolaan Keuangan dan Aset Daerah Provinsi NTB', ['class' => 'form-control', 'required']) }}
    </div>
</div>


@push('scripts')
<style>
    .twitter-typeahead {
        width: 100%;
    }

    .tt-menu {
        width: 100%;
        background: white;
        border-radius: 5px;
        border: 1px solid grey;
    }

    .tt-suggestion {
        padding: 5px;
    }
</style>
<script src="/js/typeahead.js"></script>
<script src="/js/mask.js"></script>
<!-- Plugin JavaScript -->
<script src="/plugins/bower_components/moment/moment.js"></script>
<!-- Date Picker Plugin JavaScript -->
<script src="/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<!-- Date range Plugin JavaScript -->
<script src="/plugins/bower_components/timepicker/bootstrap-timepicker.min.js"></script>
<script src="/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script>
    var substringMatcher = function (strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;
            // an array that will be populated with substring matches
            matches = [];
            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');
            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function (i, str) {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });
            cb(matches);
        };
    };

    $('#nip').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'list_nip',
        source: substringMatcher(list_nip)
    });

    $('#nama').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'list_nama',
        source: substringMatcher(list_nama)
    });
    $('#nama').bind('typeahead:select', function(ev, suggestion) {
        searchPegawai('nama', suggestion);
    });
    $('#nip').bind('typeahead:select', function(ev, suggestion) {
        searchPegawai('nip', suggestion);
    });

    function searchPegawai(source, suggestion) {
        var matches = [];
        // cari di array pegawai, jika ada 1, maka isi form nya, jika lebih dari satu, tampilkan modal
        $.each(list_pegawai, function (i, pegawai) {
            switch (source) {
                case 'nama':
                    if (pegawai.nama === suggestion) {
                        matches.push(pegawai);
                    }
                    break;
                case 'nip':
                    if (pegawai.nip === suggestion) {
                        matches.push(pegawai);
                    }
                    break;
            }
        });

        if (matches.length == 1) {
            updateField(matches[0]);
        } else {
            alert('Pegawai yang anda pilih memiliki lebih dari satu data, gunakan pencarian NIP agar lebih spesifik');
        }
    }

    function updateField(pegawai) {
        $('#nama').val(pegawai.nama).change();
        $('#nip').typeahead('val', pegawai.nip);
        $('#telepon').focus().val(pegawai.telepon).change();
        $('#jenis_kelamin').val(pegawai.jenis_kelamin);
        $('#jabatan').typeahead('val', pegawai.jabatan.nama);
        $('#skpd').typeahead('val', pegawai.skpd.nama);
    }

    $('#jabatan').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'list_jabatan',
            source: substringMatcher(list_jabatan)
        });

    $('#skpd').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'list_skpd',
            source: substringMatcher(list_skpd)
        });

    $('#date-range').datepicker({
        toggleActive: true
    });
</script>
@endpush