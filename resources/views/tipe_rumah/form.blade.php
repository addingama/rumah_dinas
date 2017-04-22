{{ Html::ul($errors->all()) }}
<div class="form-group">
    <label class="control-label col-md-3">Nama</label>
    <div class="col-md-9">
        {{ Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'II/250', 'required']) }}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3">Harga Sewa / Bulan</label>
    <div class="col-md-9">
        {{ Form::number('harga_sewa', null, ['class' => 'form-control', 'placeholder' => '10000', 'required']) }}
    </div>
</div>