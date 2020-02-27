<!-- Banner Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('banner_name', 'Banner Name:') !!}
    {!! Form::text('banner_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Banner Picture Field -->
<div class="form-group col-sm-12">
    {!! Form::label('banner_picture', 'Banner Picture:') !!}
    {!! Form::text('banner_picture', null, ['class' => 'form-control']) !!}
</div>

<!-- Banner Url Field -->
<div class="form-group col-sm-12">
    {!! Form::label('banner_url', 'Banner Url:') !!}
    {!! Form::text('banner_url', null, ['class' => 'form-control']) !!}
</div>

<!-- Banner Order Field -->
<div class="form-group col-sm-12">
    {!! Form::label('banner_order', 'Banner Order:') !!}
    {!! Form::text('banner_order', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.bannerNetones.index') !!}" class="btn btn-default">Cancel</a>
</div>
