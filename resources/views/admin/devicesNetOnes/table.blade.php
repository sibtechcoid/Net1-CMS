<div class="card-body table-responsive-lg table-responsive-sm table-responsive-md">
<table class="table table-striped table-bordered" id="devicesNetOnes-table" width="100%">
    <thead>
     <tr>
        <th>Devices  Name</th>
        <th>I C C I D</th>
        <th>I M S I</th>
        <th>R S R P</th>
        <th>Version  Apps</th>
        <th>S S I D</th>
        <th>User  Connection</th>
        <th>I P  Address</th>
        <th>M A C  Address</th>
        <th >Action</th>
     </tr>
    </thead>
    <tbody>
    @foreach($devicesNetOnes as $devicesNetOne)
        <tr>
            <td>{!! $devicesNetOne->devices__name !!}</td>
            <td>{!! $devicesNetOne->i_c_c_i_d !!}</td>
            <td>{!! $devicesNetOne->i_m_s_i !!}</td>
            <td>{!! $devicesNetOne->r_s_r_p !!}</td>
            <td>{!! $devicesNetOne->version__apps !!}</td>
            <td>{!! $devicesNetOne->s_s_i_d !!}</td>
            <td>{!! $devicesNetOne->user__connection !!}</td>
            <td>{!! $devicesNetOne->i_p__address !!}</td>
            <td>{!! $devicesNetOne->m_a_c__address !!}</td>
            <td>
                 <a href="{{ route('admin.devicesNetOnes.show', collect($devicesNetOne)->first() ) }}">
                     <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view devicesNetOne"></i>
                 </a>
                 <a href="{{ route('admin.devicesNetOnes.edit', collect($devicesNetOne)->first() ) }}">
                     <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit devicesNetOne"></i>
                 </a>
                 <a href="{{ route('admin.devicesNetOnes.confirm-delete', collect($devicesNetOne)->first() ) }}" data-toggle="modal" data-target="#delete_confirm" data-id="{{ route('admin.devicesNetOnes.delete', collect($devicesNetOne)->first() ) }}">
                     <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete devicesNetOne"></i>

                 </a>
            </td>
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
        $('#devicesNetOnes-table').DataTable({
                      responsive: true,
                      pageLength: 10
                  });
                  $('#devicesNetOnes-table').on( 'page.dt', function () {
                     setTimeout(function(){
                           $('.livicon').updateLivicon();
                     },500);
                  } );
                  $('#devicesNetOnes-table').on( 'length.dt', function ( e, settings, len ) {
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
