{{ Html::ul($errors->all()) }}
<div class="form-group">
    <label class="control-label col-md-3">Alamat Lengkap <span class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::text('alamat', null, ['class' => 'form-control', 'placeholder' => 'Jl. Langko No. 31 Mataram', 'required']) }}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3">Tipe Rumah <span class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::select('tipe_rumah_id', $list_tipe_rumah, null, ['class' => 'form-control', 'required']) }}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3">Kondisi <span class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::text('kondisi', null, ['class' => 'form-control', 'placeholder' => 'Baik', 'required']) }}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3">Keterangan</label>
    <div class="col-md-9">
        {{ Form::text('keterangan', null, ['class' => 'form-control', 'placeholder' => 'Komplek Pertanian']) }}
    </div>
</div>