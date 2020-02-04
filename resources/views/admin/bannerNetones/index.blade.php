@extends('admin/layouts/default')

@section('title')
BannerNet1
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>BannerNet1</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>BannerNet1</li>
        <li class="active">BannerNet1 List</li>
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
                    BannerNet1 List
                </h4>
                <div class="float-right">
                    <a href="{{ route('admin.bannerNetones.create') }}" class="btn btn-sm btn-default"><span class="fa fa-plus"></span> @lang('button.create')</a>
                </div>
            </div>
            <br />
            <div class="card-body table-responsive">
                 @include('admin.bannerNetones.table')
                 
            </div>
        </div>
        </div>
 </div>
 </div>
</section>
@stop
