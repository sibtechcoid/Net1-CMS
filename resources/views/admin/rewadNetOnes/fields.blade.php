<!-- Nama Rewads Field -->
<div class="form-group col-sm-12">
    {!! Form::label('nama_rewads', 'Nama Rewards:') !!}
    {!! Form::text('nama_rewads', null, ['class' => 'form-control']) !!}
</div>

<!-- Validity Date Field -->
<div class="form-group col-sm-12">
    {!! Form::label('validity_date', 'Validity Date:') !!}
    {!! Form::text('validity_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.rewadNetOnes.index') !!}" class="btn btn-default">Cancel</a>
</div>
