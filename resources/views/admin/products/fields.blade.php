<!-- Plan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('plan', 'Plan:') !!}
    <select class="form-control" id="plan" name="plan">
        <option value="prepaid">Prepaid</option>
        <option value="postpaid">Postpaid</option>
    </select>
</div>

<!-- Product Type Field -->
<div class="form-group col-sm-12">
    {!! Form::label('product_type', 'Product Type:') !!}
    <select class="form-control" id="product_type_id" name="product_type_id">
    @foreach($response['productTypes'] as $productType)
        <option value="{{$productType['id']}}">{{ucfirst($productType['product_type'])}}</option>
    @endforeach
    </select>
</div>

<!-- Product Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('product_name', 'Product Name:') !!}
    {!! Form::text('product_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Product Speed Field -->
<div class="form-group col-sm-3">
    {!! Form::label('product_speed', 'Product Speed(Mbps):') !!}
    {!! Form::number('product_speed', null, ['class' => 'form-control']) !!}
</div>

<!-- Product Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('product_description', 'Product Description:') !!}
    <textarea class="form-control" name="product_description" id="product_description" rows="3"></textarea>
</div>

<!-- Product Expiry In Days Field -->
<div class="form-group col-sm-3">
    {!! Form::label('product_expiry_in_days', 'Product Expiry In Days:') !!}
    {!! Form::number('product_expiry_in_days', null, ['class' => 'form-control']) !!}
</div>

<!-- Publish Field -->
<div class="form-group col-sm-6">
    {!! Form::label('publish', 'Publish:') !!}
    <label class="checkbox-inline">
        {!! Form::checkbox('publish', '1') !!}
    </label>
</div>

<div class="form-group col-sm-4">
    <label for="zone_price_status">Zone Price: </label><p style="font-size: 12px;">(Will there be any zone pricing? Choose "Yes" if there will be any, and "No" otherwise.)</p>
    <select class="form-control" name="zone_price_status" id="zone_price_status">
        <option value="none">Please select...</option>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>
</div>

<!-- Product Price -->
<div class="form-group col-sm-12">
    {!! Form::label('product_price', 'Product Price:') !!}
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="product_price_label">Rp</span>
        </div>
        <input type="number" class="form-control" name="product_price" id="product_price" aria-label="Product Price" aria-describedby="product_price_label">
    </div>
</div>

<!-- Zone Price Inputs -->
<div class="form-group col-sm-8">
    <table class="table table-sm table-bordered" id="zone_price_table">
        <thead class="thead-light">
        <tr>
            <th>Zone Id</th>
            <th>Zone Price</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="2"><button type="button" class="btn btn-sm btn-success" id="add_rows_zone"><i class="far fa-plus-square"></i> Add more rows</button></td>
        </tr>
        <tr>
            <td>
                <input type="text" class="form-control" placeholder="Zone Id" name="zone_prices[0][zone_id]">
            </td>
            <td>
                <input type="number" class="form-control" placeholder="Zone Price" name="zone_prices[0][zone_price]">
            </td>
        </tr>
        </tbody>
    </table>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.products.index') !!}" class="btn btn-default">Cancel</a>
</div>

