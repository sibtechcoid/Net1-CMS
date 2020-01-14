<div class="card-body table-responsive-lg table-responsive-sm table-responsive-md">
<table class="table table-striped table-bordered" id="customers-table" width="100%">
    <thead>
     <tr>
        <th>Action</th>
        <th>Account Customer Segment</th>
        <th>Residence Type</th>
        <th>Msisdn</th>
        <th>Account Name</th>
        <th>Customer Cis To Category</th>
        <th>Customer Company Regnum</th>
        <th>Customer Id Type</th>
        <th>Customer Identity No</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Kk Number</th>
        <th>Email</th>
        <th>Device Id</th>
        <th>Preferred Language</th>
     </tr>
    </thead>
    <tbody>
    @foreach($response['customers'] as $customer)
        <tr>
            <td>
                <a href="{{ route('admin.customers.show', collect($customer)->first() ) }}">
                    <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view customer"></i>
                </a>
                <!-- <a href="{{ route('admin.customers.edit', collect($customer)->first() ) }}">
                    <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit customer"></i>
                </a> -->
                <!-- <a href="{{ route('admin.customers.confirm-delete', collect($customer)->first() ) }}" data-toggle="modal" data-target="#delete_confirm" data-id="{{ route('admin.customers.delete', collect($customer)->first() ) }}">
                    <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete customer"></i>
                </a> -->
            </td>
            <td>{!! $customer['account_customer_segment'] !!}</td>
            <td>{!! $customer['residence_type'] !!}</td>
            <td>{!! $customer['msisdn'] !!}</td>
            <td>{!! $customer['account_name'] !!}</td>
            <td>{!! $customer['customer_cis_to_category'] !!}</td>
            <td>{!! $customer['customer_company_regnum'] !!}</td>
            <td>{!! $customer['customer_id_type'] !!}</td>
            <td>{!! $customer['customer_identity_no'] !!}</td>
            <td>{!! $customer['first_name'] !!}</td>
            <td>{!! $customer['last_name'] !!}</td>
            <td>{!! $customer['kk_number'] !!}</td>
            <td>{!! $customer['email'] !!}</td>
            <td>{!! $customer['device_id'] !!}</td>
            <td>{!! $customer['preferred_language'] !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
@section('footer_scripts')

    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
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
    <script>$(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});</script>
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/buttons.bootstrap4.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/dataTables.bootstrap4.css') }}"/>
 <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/buttons.bootstrap4.css') }}">
<script type="text/javascript" src="{{ asset('vendors/datatables/js/jquery.dataTables.js') }}" ></script>
<script type="text/javascript" src="{{ asset('vendors/datatables/js/dataTables.bootstrap4.js') }}" ></script>

    <script>
        $('#customers-table').DataTable({
            responsive: true,
            pageLength: 10,
            "columnDefs": [
                { "orderable": false, "targets": 1 }
            ]
        });
        $('#customers-table').on( 'page.dt', function () {
            setTimeout(function(){
                $('.livicon').updateLivicon();
            },500);
        } );
        $('#customers-table').on( 'length.dt', function ( e, settings, len ) {
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

       </script>

@stop
