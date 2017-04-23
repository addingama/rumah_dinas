{{ Html::ul($errors->all()) }}
<div class="form-group">
    <label class="control-label col-md-3">NIP <span class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::text('nip', null, ['class' => 'form-control', 'placeholder' => '19790518 201001 2 011', 'data-mask' => '99999999 999999 9 999', 'required']) }}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3">Nama <span class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama Pegawai', 'required']) }}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3">Pangkat <span class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::select('pangkat_id', $list_pangkat, null, ['class' => 'form-control', 'required']) }}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3">Jabatan <span class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::text('jabatan', null, ['class' => 'form-control', 'id' => 'jabatan', 'placeholder' => 'Instruktur Penyelia']) }}
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">SKPD <span class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::text('skpd', null, ['class' => 'form-control', 'id' => 'skpd', 'placeholder' => 'Dinas Perdagangan Provinsi NTB']) }}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3">Telepon </label>
    <div class="col-md-9">
        {{ Form::text('telepon', null, ['class' => 'form-control', 'placeholder' => '087800001111']) }}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3">Jenis Kelamin <span class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::select('jenis_kelamin', ['L' => 'Laki-Laki', 'P' => 'Perempuan'], null, ['class' => 'form-control', 'required']) }}
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
</script>
@endpush
