@extends('admin.layouts.default')

@section('title')
Banner
@parent
@stop
@section('assets')
    <style>
        /*#show_uploaded_banner{*/
        /*    width: 500px;*/
        /*    height: 300px;*/
        /*    margin-bottom: 10px;*/
        /*    background-color: white;*/
        /*    float: left;*/
        /*    position: relative;*/
        /*    z-index: 10;*/
        /*}*/
        /*#show_uploaded_banner:after{*/
        /*    background-color: grey;*/
        /*    content: '';*/
        /*    display: block;*/
        /*    position: absolute;*/
        /*    top: 10px;*/
        /*    left: 10px;*/
        /*    right: 10px;*/
        /*    bottom: 10px;*/
        /*    z-index: -1;*/
        /*}*/
    </style>

@section('content')
@include('common.errors')
<section class="content-header">
    <h1>Banner</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Banners</li>
        <li class="active">Create Banner </li>
    </ol>
</section>
<section class="content">
<div class="container">
<div class="row">
    <div class="col-12">
     <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Create New  Banner
                </h4></div>
            <br />
            <div class="card-body">
{{--            {!! Form::open(['route' => 'admin.banners.store']) !!}--}}
                <form enctype="multipart/form-data" action="{{ route('admin.banners.store') }}" method="POST">



                @include('admin.banners.fields')
                </form>
{{--            {!! Form::close() !!}--}}
        </div>
      </div>
      </div>
 </div>

</div>
</section>
 @stop
@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("form").submit(function() {
                $('input[type=submit]').attr('disabled', 'disabled');
                return true;
            });
        });
    </script>
@stop
