<!-- Offer Name Field -->
{{-- <div class="form-group col-sm-12">
    {!! Form::label('offer_name', 'Offer Name:') !!}
    {!! Form::label('offer_name', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- Display Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('display_name', 'Display Name:') !!}
    {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
</div>

{{-- <!-- Validity Date Field -->
<div class="form-group col-sm-12">
    {!! Form::label('validity_date', 'Validity Date:') !!}
    {!! Form::text('validity_date', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.productNetOnes.index') !!}" class="btn btn-default">Cancel</a>
</div>
