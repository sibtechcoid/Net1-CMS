<!-- Banner Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('banner_name', 'Banner Name:') !!}
    <input class="form-control" name="banner_name" type="text" id="banner_name" required>
</div>

<!-- Banner Picture Field -->
<div class="form-group col-sm-12">
    {!! Form::label('banner_picture', 'Banner Picture:') !!}
    <div class="custom-file">
        <input type="file" name="banner_picture" id="banner_picture" class="custom-file-input" required>
        <label class="custom-file-label" for="customFile">Choose a picture</label>
    </div>
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