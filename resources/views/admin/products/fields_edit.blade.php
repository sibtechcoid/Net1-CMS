
<!-- Plan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('plan', 'Plan:') !!}
    <select class="form-control" id="plan" name="plan">
        @if($response['product']['plan'] == 'prepaid')
            <option value="prepaid" selected>Prepaid</option>
            <option value="postpaid">Postpaid</option>
        @else
            <option value="postpaid" selected>Postpaid</option>
            <option value="prepaid">Prepaid</option>
        @endif
    </select>
</div>

<!-- Product Type Field -->
<div class="form-group col-sm-12">
    {!! Form::label('product_type', 'Product Type:') !!}
    <select class="form-control" name="product_type_id" id="product_type_id">
    @foreach($response['productTypes'] as $product_type)
        @if($response['product']['product_type_id'] == $product_type['id'])
            <option value="{{$product_type['id']}}" selected>{{$product_type['product_type']}}</option>
        @else
            <option value="{{$product_type['id']}}">{{$product_type['product_type']}}</option>
        @endif
    @endforeach
    </select>
</div>

<!-- Product Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('product_name', 'Product Name:') !!}
    <input type="text" class="form-control" name="product_name" value="{{$response['product']['product_name']}}">
</div>

<!-- Product Speed Field -->
<div class="form-group col-sm-2">
    {!! Form::label('product_speed', 'Product Speed:') !!}
    <input type="text" class="form-control" name="product_speed" value="{{$response['product']['product_speed']}}">
</div>

<!-- Product Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('product_description', 'Product Description:') !!}
    <textarea class="form-control" name="product_description" rows="3">{{$response['product']['product_description']}}</textarea>
</div>

<!-- Product Expiry In Days Field -->
<div class="form-group col-sm-2">
    {!! Form::label('', 'Product Expiry In Days:') !!}
    <input type="text" class="form-control" name="product_expiry_in_days" value="{{$response['product']['product_expiry_in_days']}}">
</div>

<!-- Publish Field -->
<div class="form-group col-sm-6">
    {!! Form::label('publish', 'Publish:') !!}
    <label class="checkbox-inline">
        @if($response['product']['publish'] == 1)
            <input type="checkbox" value="true" name="publish" id="publish" checked/>
        @else
            <input type="checkbox" value="false" name="publish" id="publish"/>
        @endif
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.products.index') !!}" class="btn btn-default">Cancel</a>
</div>
