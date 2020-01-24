@extends('admin/layouts/default')

@section('title')
Products
@parent
@stop

@section('assets')
<style>
    .content {
        margin-left: 10px;
        margin-right: 15px;
    }
</style>

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Products</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16"
                    data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Products</li>
        <li class="active">Products List</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-12">
            @include('flash::message')
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title float-left"> <i class="livicon" data-name="list-ul" data-size="16"
                            data-loop="true" data-c="#fff" data-hc="white"></i>
                        Products List
                    </h4>
                    {{-- <div class="float-right">
                        <a href="" class="btn btn-sm btn-default"><span
                                class="fa fa-plus"></span> @lang('button.create')</a>
                    </div> --}}
                    <div class="input-group-prepend">
                    <button class="btn btn-outline-dark" type="submit">reload</button>
                    {{-- <a href="{{ControllerName::store}}"> --}}
                    </div>
                </div>
                <br />
                <div class="card-body table-responsive">
                    <div class="input-group mb-3">
                        <form method="POST" enctype="multipart/form-data" action="{{route('admin.products.upload')}}">
                            @csrf
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-dark" type="submit">Upload</button>
                            </div>
                            <div class="custom-file">
                                <input type="file" name="productExcel" formenctype="multipart/form-data" class="custom-file-input" id="productExcel"
                                    aria-describedby="productExcel">
                                <label class="custom-file-label" for="productExcel">Choose file, excel
                                    only</label>
                            </div>
                        </form>
                    </div>
                    @include('admin.products.table')
                </div>
            </div>
        </div>
    </div>
</section>
@stop
