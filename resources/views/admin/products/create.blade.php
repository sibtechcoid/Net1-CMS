@extends('admin/layouts/default')

@section('title')
Product
@parent
@stop
@section('assets')
    <style>
        #zone_price_table, #product_price, #product_price_label {
            display: none;
        }
    </style>

@section('content')
@include('common.errors')
<section class="content-header">
    <h1>Product</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Products</li>
        <li class="active">Create Product </li>
    </ol>
</section>
<section class="content">
<div class="container">
    <div class="row">
        <div class="col-12">
         <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Create New  Product
                    </h4></div>
                <br />
                <div class="card-body">
                {!! Form::open(['route' => 'admin.products.store']) !!}

                    @include('admin.products.fields')

                {!! Form::close() !!}
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
            let rows_i = 1;
            let selected = $('#zone_price_status').val();
            // alert(selected);
            if(selected == 'true' || selected == true || selected == 1) {
                // alert('true');
                $('#zone_price_table').show();
                $('#product_price_label').hide();
                $('#product_price').hide();
            }
            else if(selected == 'false' || selected == false || selected == 0) {
                // alert('false');
                $('#zone_price_table').hide();
                $('#product_price_label').show();
                $('#product_price').show();
            }
            else if(selected = 'none') {
                $('#zone_price_table').hide();
                $('#product_price_label').hide();
                $('#product_price').hide();
            }
            $(document).on('click', '#add_rows_zone', function() {
                let html =
                    '<tr>'+
                    '<td>'+
                    '<input type="text" class="form-control" placeholder="Zone Id" name=zone_prices['+ rows_i +'][zone_id]>'+
                    '</td>'+
                    '<td>'+
                    '<input type="number" class="form-control" placeholder="Zone Price" name="zone_prices['+ rows_i +'][zone_price]">'+
                    '</td>'+
                    '</tr>';
                $('#zone_price_table tbody').append(html);
                rows_i++;
            });
            $('#zone_price_status').on('change', function() {
                // alert($(this).val());
                selected = $(this).val();
                if(selected == 'true' || selected == true || selected == 1) {
                    // alert('true');
                    $('#zone_price_table').show();
                    $('#product_price_label').hide();
                    $('#product_price').hide();
                }
                else if(selected == 'false' || selected == false || selected == 0) {
                    // alert('false');
                    $('#zone_price_table').hide();
                    $('#product_price_label').show();
                    $('#product_price').show();
                }
                else if(selected = 'none') {
                    $('#zone_price_table').hide();
                    $('#product_price_label').hide();
                    $('#product_price').hide();
                }
            });
            $("form").submit(function() {
                $('input[type=submit]').attr('disabled', 'disabled');
                return true;
            });
        });
    </script>
@stop
