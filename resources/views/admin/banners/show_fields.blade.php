<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $response['id'] !!}</p>
    <hr>
</div>

<!-- Banner Name Field -->
<div class="form-group">
    {!! Form::label('banner_name', 'Banner Name:') !!}
    <p>{!! $response['banner_name'] !!}</p>
    <hr>
</div>

<!-- Banner Picture Field -->
<div class="form-group">
    {!! Form::label('banner_picture', 'Banner Picture:') !!}
    <br/>
    <img src="{!! App\Models\Admin\Banner::getBannerPicture($response['id']) !!}"/>
    <hr>
</div>

<!-- Banner Uri Field -->
<div class="form-group">
    {!! Form::label('banner_url', 'Banner Url:') !!}
    <p>{!! $response['banner_url'] !!}</p>
    <hr>
</div>

<!-- Banner Order Field -->
<div class="form-group">
    {!! Form::label('banner_order', 'Banner Order:') !!}
    <p>{!! $response['banner_order'] !!}</p>
    <hr>
</div>

