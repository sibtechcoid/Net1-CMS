<style>
.btn-zone-prices {
    color: white;
    border-color: white;
}
.zone-prices-hide {
    display: none;
}
.zone-prices-show {
    display: block;
}
.tr-color-prepaid {
    background-color:#28a745 !important; color:white;
}
.tr-color-postpaid {
    background-color:#f4731c !important; color:white;
}

#products-table tbody tr:hover {
    background-color: grey !important; cursor: pointer;
}
.align-center {
    text-align: center;
}
</style>
<div class="card-body table-responsive-lg table-responsive-sm table-responsive-md">
<table class="table table-striped table-bordered" id="products-table" width="100%">
    <thead>
     <tr>
        {{-- <th>Action</th> --}}
        <th>Offer ID</th>
        <th style="width: 16px;">Offer Name</th>
        <th>Display Name</th>
        <th>Description</th>
        <th>charging Type</th>
        <th>offer Type</th>
        <th>service Zone</th>
        <th>Validity Date</th>
        <th>Total Price</th>
     </tr>
    </thead>
    <tbody>
        @foreach ($products as $key => $item)
        <tr>
            {{-- <td>
                 <a href="{{ route('admin.product.show', collect($show ?? '')->first() ) }}">
                     <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view productType"></i>
                 </a>
                 <a href="{{ route('admin.product.edit', collect($show ?? '')->first() ) }}">
                     <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit productType"></i>
                 </a>
                 <a href="{{ route('admin.product.confirm-delete', collect($show ?? '')->first() ) }}" data-toggle="modal" data-target="#delete_confirm" data-id="{{ route('admin.productTypes.delete', collect($productType)->first() ) }}">
                     <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete productType"></i>

                 </a>
            </td> --}}
           <td>{{ $item->offer_id }}</td>
           <td>{{ $item->offer_name }}</td>
           <td>{{ $item->display_name }}</td>
           <td>{{ $item->description }}</td>
           <td>{{ $item->charging_type }}</td>
           <td>{{ $item->offer_type }}</td>
           <td>{{ $item->service_zone }}</td>
           <td>{{ $item->validity_date }}</td>
           <td>{{ $item->total_price }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@section('footer_scripts')

    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="item_delete_confirm_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deleteLabel">Delete Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                Are you sure to delete this Item? This operation is irreversible.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a  type="button" class="btn btn-danger Remove_square">Delete</a>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal Zone Price -->
    <div class="modal fade" id="zonePriceModal" tabindex="-1" role="dialog" aria-labelledby="zonePriceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="zonePriceModalLabel">Add a New Zone Price</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="zonePriceModalMessage"></div>
                    <div class="form-group">
                        <label for="p_plan" class="col-form-label">Plan: </label>
                        <p id="p_plan" class="border-bottom border-secondary">Test</p>
                        <label for="p_product_type" class="col-form-label">Product Type: </label>
                        <p id="p_product_type" class="border-bottom border-secondary">Test</p>
                        <label for="p_product_name" class="col-form-label">Product Name: </label>
                        <p id="p_product_name" class="border-bottom border-secondary">Test</p>
                        <label for="p_product_description" class="col-form-label">Product Description: </label>
                        <p id="p_product_description" class="border-bottom border-secondary">Test</p>
                        <label for="p_product_expiry_in_days" class="col-form-label">Product Expiry In Days: </label>
                        <p id="p_product_expiry_in_days" class="border-bottom border-secondary">Test</p>
                    </div>
                        <div class="form-group">
                            <label for="zone_id" class="col-form-label">Zone Id:</label>
                            <input type="text" class="form-control" name="zone_id" id="zone_id">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Price:</label>
                            <input type="text" class="form-control" id="zone_price" name="zone_price">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="addZonePrice">Add</button>
                </div>
            </div>
        </div>
    </div>

<script>$(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});</script>
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/buttons.bootstrap4.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/dataTables.bootstrap4.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/buttons.bootstrap4.css') }}">
<script type="text/javascript" src="{{ asset('vendors/datatables/js/jquery.dataTables.js') }}" ></script>
<script type="text/javascript" src="{{ asset('vendors/datatables/js/dataTables.bootstrap4.js') }}" ></script>

    <script>
    $(document).ready(function() {
        // $('button.btn-zone-prices').click(function() {
        //     let elem_zone = $(this).closest('tr').next('tr');
        //     if(elem_zone.attr('class')=='zone-prices-hide')
        //         elem_zone.addClass('zone-price-show').removeClass('zone-prices-hide');
        //     else
        //         elem_zone.addClass('zone-prices-hide').removeClass('zone-price-show');
        // });

        // $('button.btn_zonePriceModal').on('click', function() {
        //     let product_id = $(this).val();
        //     let url = '/admin/getProduct/' + product_id;
        //     // alert(url);
        //     $('#zonePriceModalMessage').empty();
        //     $.get(url, function(response) {
        //         console.log(response);
        //         let result = response;
        //         if(result.code==200 && result.product!=null) {
        //             $('#p_plan').text(result.product.plan);
        //             $('#p_product_type').text(result.product.product_type);
        //             $('#p_product_name').text(result.product.product_name);
        //             $('#p_product_description').text(result.product.product_description);
        //             $('#p_product_expiry_in_days').text(result.product.product_expiry_in_days);
        //             $('#addZonePrice').val(product_id);
        //             if(result.product.plan == 'prepaid') {
        //                 $('#zonePriceModal div.modal-header').removeClass('bg-warning').addClass('bg-success');
        //             }
        //             else {
        //                 $('#zonePriceModal div.modal-header').removeClass('bg-success').addClass('bg-warning');
        //             }
        //         }
        //     });
        // });

        // $('#addZonePrice').on('click', function() {
        //     let product_id = $(this).val();
        //     let url = '/admin/products/'+product_id+'/create/zonePrice';
        //     let zone_id = $('input[name=zone_id]').val();
        //     let zone_price = $('input[name=zone_price]').val();
        //     $('#zonePriceModalMessage').empty();
        //     if(zone_id =='') {
        //         $('input[name=zone_id]').addClass('is-invalid');
        //         $('#zonePriceModalMessage').append('<div class="alert alert-danger" role="alert">' +
        //             'Please fill in the value of Zone Id' +
        //             '</div>');
        //         return;
        //     }
        //     $('input[name=zone_id]').removeClass('is-invalid');
        //     if(zone_price == '') {
        //         $('input[name=zone_price]').addClass('is-invalid');
        //         $('#zonePriceModalMessage').append('<div class="alert alert-danger" role="alert">' +
        //             'Please fill in the value of Zone Price' +
        //             '</div>');
        //         return;
        //     }
        //     $('input[name=zone_price]').removeClass('is-invalid');
        //     data = {'product_id': product_id, 'zone_id': zone_id, 'zone_price': zone_price};
        //     $.post(url, data, function(response) {
        //         console.log(response);
        //         let result = response;
        //         if(result.code==200) {
        //             $('#zonePriceModalMessage').append('<div class="alert alert-success" role="alert">' +
        //                 'New Zone Price added.' +
        //                 '</div>');
        //             $('input[name=zone_id]').val('');
        //             $('input[name=zone_price]').val('');
        //         }
        //         else if('errors' in result) {
        //             // console.log(response.errors);
        //             $('input[name=zone_id]').addClass('is-invalid');
        //             $('#zonePriceModalMessage').empty();
        //             $('#zonePriceModalMessage').append('<div class="alert alert-warning" role="alert">' +
        //                 response.errors +
        //                 '</div>');
        //         }

        //     });
        // });

        $('#productExcel').on('change',function(){
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });

        $('#products-table').DataTable({
            responsive: true,
            pageLength: 10,
            columnDefs: [{ orderable: false, targets: [7] }]
        });
        $('#products-table').on( 'page.dt', function () {
            setTimeout(function(){
                $('.livicon').updateLivicon();
            },500);
        } );
        $('#products-table').on( 'length.dt', function ( e, settings, len ) {
            setTimeout(function(){
                $('.livicon').updateLivicon();
            },500);
        } );

        $('#delete_confirm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var $recipient = button.data('id');
            var modal = $(this);
            modal.find('.modal-footer a').prop("href",$recipient);
        })
    });

       </script>

@stop
