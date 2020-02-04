@extends('admin/layouts/default')

@section('title')
RewardsNet1
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>RewardsNet1</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>RewardsNet1</li>
        <li class="active">Rewards List</li>
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
                    RewardsNet1 List
                </h4>
                <div class="float-right">
                    <a class="btn btn-info" href="{{route('admin.rewards.download')}}">Export as Excel</a>
                    <a href="{{ route('admin.rewards.create') }}" class="btn btn-sm btn-default"><span class="fa fa-plus"></span> @lang('button.create')</a>
                </div>
            </div>
            <br />
            <div class="card-body table-responsive">
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.rewards.upload') }}">
                    @csrf
                    <div class="border p-2">
                        <h4>Import</h4>
                        <div class="input-group mb-3">
                            <select name="type" class="custom-select form-control" required>
                            <option value="">Choose type of import...</option>
                            <option value="reward">Reward</option>
                            <option value="redeem">Redeem</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="rewardExcel" name="rewardExcel" required>
                                <label class="custom-file-label" for="rewardExcel">Choose a file with one of these extension (.xls, .xlsx, .xlxt, or .csv)</label>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Import</button>
                            </div> 
                        </div>
                    </div>
                </form>
                 @include('admin.rewards.table')
                 
            </div>
        </div>
        </div>
 </div>
 </div>
</section>
@stop
