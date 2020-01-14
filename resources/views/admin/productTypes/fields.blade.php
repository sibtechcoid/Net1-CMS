<!-- Product Type Field -->
<div class="form-group col-sm-12">
    {!! Form::label('product_type', 'Product Type:') !!}
    <input class="form-control" name="product_type" type="text" id="product_type" >
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.productTypes.index') !!}" class="btn btn-default">Cancel</a>
</div>
