<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $bannerNetone->id !!}</p>
    <hr>
</div>

<!-- Banner Name Field -->
<div class="form-group">
    {!! Form::label('banner_name', 'Banner Name:') !!}
    <p>{!! $bannerNetone->banner_name !!}</p>
    <hr>
</div>

<!-- Banner Picture Field -->
<div class="form-group">
    {!! Form::label('banner_picture', 'Banner Picture:') !!}
    <p><img src="{{ Storage::url($bannerNetone->banner_picture) }}" alt="no image" title="" width="300" height="200">
    </p>
    <hr>
</div>

<!-- Banner Url Field -->
<div class="form-group">
    {!! Form::label('banner_url', 'Banner Url:') !!}
    <p>{!! $bannerNetone->banner_url !!}</p>
    <hr>
</div>

<!-- Banner Order Field -->
<div class="form-group">
    {!! Form::label('banner_order', 'Banner Order:') !!}
    <p>{!! $bannerNetone->banner_order !!}</p>
    <hr>
</div>