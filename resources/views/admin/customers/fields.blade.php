<!-- Account Customer Segment Field -->
<div class="form-group col-sm-12">
    {!! Form::label('account_customer_segment', 'Account Customer Segment:') !!}
    {!! Form::text('account_customer_segment', null, ['class' => 'form-control']) !!}
</div>

<!-- Residence Type Field -->
<div class="form-group col-sm-12">
    {!! Form::label('residence_type', 'Residence Type:') !!}
    {!! Form::text('residence_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Msisdn Field -->
<div class="form-group col-sm-12">
    {!! Form::label('msisdn', 'Msisdn:') !!}
    {!! Form::text('msisdn', null, ['class' => 'form-control']) !!}
</div>

<!-- Account Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('account_name', 'Account Name:') !!}
    {!! Form::text('account_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Customer Cis To Category Field -->
<div class="form-group col-sm-12">
    {!! Form::label('customer_cis_to_category', 'Customer Cis To Category:') !!}
    {!! Form::text('customer_cis_to_category', null, ['class' => 'form-control']) !!}
</div>

<!-- Customer Cis To Category Field -->
<div class="form-group col-sm-12">
    {!! Form::label('customer_company_regnum', 'Customer Company Regnum:') !!}
    {!! Form::text('customer_company_regnum', null, ['class' => 'form-control']) !!}
</div>

<!-- Customer Identity No Field -->
<div class="form-group col-sm-12">
    {!! Form::label('customer_identity_no', 'Customer Identity No:') !!}
    {!! Form::text('customer_identity_no', null, ['class' => 'form-control']) !!}
</div>

<!-- First Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('first_name', 'First Name:') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
</div>

<!-- First Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('last_name', 'Last Name:') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Kk Number Field -->
<div class="form-group col-sm-12">
    {!! Form::label('kk_number', 'Kk Number:') !!}
    {!! Form::text('kk_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-12">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::text('password', null, ['class' => 'form-control']) !!}
</div>

<!-- Device Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('device_id', 'Device Id:') !!}
    {!! Form::text('device_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Preferred Language Field -->
<div class="form-group col-sm-12">
    {!! Form::label('preferred_language', 'Preferred Language:') !!}
    {!! Form::text('preferred_language', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.customers.index') !!}" class="btn btn-default">Cancel</a>
</div>
