<div class="row">
    <div class="col-sm-6 border-right">
        <!-- Id Field -->
        <div class="form-group">
            {!! Form::label('id', 'Id:') !!}
            <p>{!! $response['id'] !!}</p>
            <hr>
        </div>

        <!-- Plan Field -->
        <div class="form-group">
            {!! Form::label('plan', 'Plan:') !!}
            <p>{!! $response['plan'] !!}</p>
            <hr>
        </div>

        <!-- Product Type Field -->
        <div class="form-group">
            {!! Form::label('product_type', 'Product Type:') !!}
            <p>{!! $response['product_type'] !!}</p>
            <hr>
        </div>

        <!-- Product Name Field -->
        <div class="form-group">
            {!! Form::label('product_name', 'Product Name:') !!}
            <p>{!! $response['product_name'] !!}</p>
            <hr>
        </div>

        <!-- Product Speed Field -->
        <div class="form-group">
            {!! Form::label('product_speed', 'Product Speed:') !!}
            <p>{!! $response['product_speed'] !!}</p>
            <hr>
        </div>

        <!-- Product Description Field -->
        <div class="form-group">
            {!! Form::label('product_description', 'Product Description:') !!}
            <p>{!! $response['product_description'] !!}</p>
            <hr>
        </div>

        <!-- Product Expiry In Days Field -->
        <div class="form-group">
            {!! Form::label('product_expiry_in_days', 'Product Expiry In Days:') !!}
            <p>{!! $response['product_expiry_in_days'] !!}</p>
            <hr>
        </div>

        <!-- Publish Field -->
        <div class="form-group">
            {!! Form::label('publish', 'Publish:') !!}
            <p>@if( $response['publish']  =='1') true @else false @endif</p>
            <hr>
        </div>
    </div>

    <div class="col-sm-6">
        <h4>Zone Price Table:</h4>
        <!-- Zone Prices -->
        <table class="table table-sm table-bordered">
            <thead class="thead-light">
            <tr>
                <th>Zone Id</th>
                <th>Zone Price</th>
            </tr>
            </thead>
            <tbody>
            @if($response['zone_prices'] != null)
                @foreach($response['zone_prices'] as $zone_price)
                    <tr>
                        <td>{{$zone_price['zone_id']}}</td>
                        <td>{{$zone_price['zone_price']}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="2">No Zone Prices Found.</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>



