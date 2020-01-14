<!-- Banner Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('banner_name', 'Banner Name:') !!}
    {!! Form::text('banner_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Banner Picture Field -->
<div class="form-group col-sm-12">
    {!! Form::label('banner_picture', 'Banner Picture:') !!}
    <br>
    <img id="show_uploaded_banner" class="img-fluid img-thumbnail" alt="Banner Picture" />
    <input type="file" id="banner_picture" name="banner_picture" class="form-control" />
</div>

<!-- Banner Uri Field -->
<div class="form-group col-sm-12">
    {!! Form::label('banner_url', 'Banner Url:') !!}
    {!! Form::text('banner_url', null, ['class' => 'form-control']) !!}
</div>

<!-- Banner Order Field -->
<div class="form-group col-sm-12">
    {!! Form::label('banner_order', 'Banner Order:') !!}
    {!! Form::number('banner_order', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.banners.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#show_uploaded_banner').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#banner_picture").change(function() {
                readURL(this);
            });
        });
    </script>
@stop

