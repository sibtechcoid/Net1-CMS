<!-- Msisdn Field -->
<div class="form-group col-sm-12">
    {!! Form::label('msisdn', 'Msisdn:') !!}
    {!! Form::text('msisdn', null, ['class' => 'form-control']) !!}
</div>

<!-- Point Reward Field -->
<div class="form-group col-sm-12">
    {!! Form::label('point_reward', 'Point Reward:') !!}
    {!! Form::text('point_reward', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.rewards.index') !!}" class="btn btn-default">Cancel</a>
</div>
