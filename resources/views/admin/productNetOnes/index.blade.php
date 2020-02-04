@extends('admin/layouts/default')

@section('title')
ProductNet1
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>ProductNet1</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>ProductNet1</li>
        <li class="active">ProductNet1 List</li>
    </ol>
</section>

<section class="content">
<div class="container">
    <div class="row">
     <div class="col-12">
     @include('flash::message')
        <div class="card border-primary ">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title float-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    ProductNet1 List
                </h4>
                {{-- <div class="float-right">
                    <a href="{{ route('admin.productNetOnes.create') }}" class="btn btn-sm btn-default"><span class="fa fa-plus"></span> @lang('button.create')</a>
                </div> --}}
                <div class="float-right">
                    <a class="btn btn-info" href="{{route('admin.products.download')}}">Export as Excel</a>
                    <a href="{{ route('admin.productNetOnes.reload') }}" class="btn btn-sm btn-default"><span class="fa fa-plus"></span> @lang('Reload')</a>
                </div>
            </div>
            <br />
            <div class="card-body table-responsive">
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.productNetOnes.upload') }}">
                    @csrf
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="productExcel" name="productExcel">
                            <label class="custom-file-label" for="productExcel">Choose a file with one of these extensions (.xls, .xlsx, .xlxt, or .csv)</label>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Import</button>
                        </div> 
                    </div>
                </form>
                 @include('admin.productNetOnes.table')
                 
            </div>
        </div>
        </div>
 </div>
 </div>
</section>
@stop
