@extends('layouts.app-backend')
@section('content')
<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <p>Penggunaan Rak Server</p>
                                <!-- DataTables -->
                                <div align="right">
                                    <button type="button" name="create_record" id="create_record" class="btn btn-success"> <i class="bi bi-plus-square"></i> Add</button>
                                </div>
                                <div class="section-body">
                                    <!-- card-body -->
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                        <br />
                                            <table class="table table-striped table-bordered zero-configuration printerpengguna_datatable"> 
                                                <thead>
                                                    <tr>
                                                        <th>Kode Rak</th>
                                                        <th>Type Rak</th>
                                                        <th>Brand Server</th>
                                                        <th>Model Server</th>
                                                        <th>SN Server</th>
                                                        <th>Penggunaan U</th>
                                                        <th width="180px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- card-body -->
                                    <!-- Modal -->
                                    <!-- input and Update -->
                                    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <form method="post" id="sample_form" enctype="multipart/form-data" class="form-horizontal">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ModalLabel">Tambah Printer</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span id="form_result"></span>
                                                        <div class="form-group">
                                                            <label>Server Device: </label>
                                                            <select class="form-control" id="server_id" name="server_id" aria-label="Floating label select example">
                                                                <option>--Pilih Server--</option>
                                                                @foreach(App\Models\ServerDevice::all() as $server)
                                                                <option value="{{ $server->id}}" id="server_id">{{ $server->sn_server }} - {{ $server->model_server}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Rak Server: </label>
                                                            <select class="form-control" id="rak_id" name="rak_id" aria-label="Floating label select example">
                                                                <option>--Pilih Rak Server--</option>
                                                                @foreach(App\Models\RakServer::all() as $rak)
                                                                    @if ($rak->ukuran_u_rak=='0')
                                                                    @else
                                                                    <option value="{{ $rak->id}}" id="rak_id">{{ $rak->model_rak }} - {{ $rak->kode_rak }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Penggunaan U: </label>
                                                            <input type="text" name="penggunaan_u" id="penggunaan_u" class="form-control" />
                                                        </div>
                                                        <input type="hidden" name="action" id="action" value="Add" />
                                                        <input type="hidden" name="hidden_id" id="hidden_id" />
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <input type="submit" name="action_button" id="action_button" value="Add" class="btn btn-info" />
                                                    </div>
                                                </form>  
                                                </div>
                                            </div>
                                        </div>
                        
                                        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="post" id="sample_form" class="form-horizontal">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="ModalLabel">Confirmation</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                                                        </div>
                                                    </form>  
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                <!-- End DataTabels -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
         <!-- detail -->


        <!-- Modal -->
        <div class="modal fade" id="fModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <span id="detail_result"></span>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Printer Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Brand Server:</strong><span id="brand-server"></span></p>
                <p><strong>Model Server:</strong><span id="model-server"></span></p>
                <p><strong>Kode Rak:</strong> <span id="kode-rak"></span></p>
                <p><strong>Type Rak:</strong> <span id="type-rak"></span></p>
                <p><strong>Pennggunaan U:</strong> <span id="penggunaan-u"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var table = $('.printerpengguna_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('rak-server-pengguna.index') }}",
        columns: [
            {data: 'kode_rak', name: 'kode_rak'},
            {data: 'type_rak', name: 'type_rak'},
            {data: 'brand_server', name: 'brand_server'},
            {data: 'model_server', name: 'model_server'},
            {data: 'sn_server', name: 'sn_server'},
            {data: 'penggunaan_u', name: 'penggunaan_u'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
 
    $('#create_record').click(function(){
        $('#sample_form').get(0).reset();
        $('.modal-title').text('Add New Record');
        $('#action_button').val('Add');
        $('#action').val('Add');
        $('#form_result').html('');
        $('#formModal').modal('show');
    });
 
    $('#sample_form').on('submit', function(event){
        event.preventDefault();
        var formData = new FormData($(this)[0]); 
        var action_url = '';
 
        if($('#action').val() == 'Add')
        {
            action_url = "{{ route('rak-server-pengguna.store') }}";
        }
 
        if($('#action').val() == 'Edit')
        {
            action_url = "{{ route('rak-server-pengguna.update') }}";
        }
 
        $.ajax({
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: action_url,
            data:$(this).serialize(),
            dataType: 'json',
            processData: false,  // Important!
            contentType: false,
            cache: false,
            data: formData,
            success: function(data) {
                console.log('success: '+data);
                var html = '';
                if(data.errors)
                {
                    html = '<div class="alert alert-danger">';
                    for(var count = 0; count < data.errors.length; count++)
                    {
                        html += '<p>' + data.errors[count] + '</p>';
                    }
                    html += '</div>';
                }
                if(data.success)
                {
                    html = '<div class="alert alert-success">' + data.success + '</div>';
                    $('#sample_form')[0].reset();
                    $('#printerpengguna_datatable').DataTable().ajax.reload();
                    window.location.reload();
                }
                $('#form_result').html(html);
            },
            error: function(data) {
                var errors = data.responseJSON;
                console.log(errors);
            }
        });
    });

    $(document).on('click', '.edit', function(event){
        event.preventDefault(); 
        var id = $(this).attr('id'); alert(id);
        $('#form_result').html('');

        $.ajax({
            url :"/rak-server-pengguna/edit/"+id+"/",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            processData: false,  
            contentType: false,
            cache: false,
            success:function(data)
            {
                console.log('success: '+data);
                $('#server_id').val(data.result.server_id);
                $('#rak_id').val(data.result.rak_id);
                $('#penggunaan_u').val(data.result.penggunaan_u);
                $('#hidden_id').val(id);
                $('.modal-title').text('Edit Record');
                $('#action_button').val('Update');
                $('#action').val('Edit'); 
                $('.editpass').hide(); 
                $('#formModal').modal('show');
            },
            error: function(data) {
                var errors = data.responseJSON;
                console.log(errors);
                setTimeout(function(){
                $('#confirmModal').modal('hide');
                alert('Data Tidak Berhasil Diupdate');
                }, 2000);
                window.location.reload();
            }
        })
    });

    var id;
 
    $(document).on('click', '.delete', function(){
        id = $(this).attr('id');
        $('#confirmModal').modal('show');
    });
 
    $('#ok_button').click(function(){
        $.ajax({
            url:"rak-server-pengguna/destroy/"+id,
            beforeSend:function(){
                $('#ok_button').text('Deleting...');
            },
            success:function(data)
            {
                setTimeout(function(){
                $('#confirmModal').modal('hide');
                $('#printerpengguna_datatable').DataTable().ajax.reload();
                alert('Data Deleted');
                }, 2000);
                window.location.reload();
            }
        })
    });
    
    // detail
    $(document).on('click', '.detailButton', function(event){
        event.preventDefault(); 
        var id = $(this).attr('id'); alert(id);
        $('#detail_result').html('');

        $.ajax({
            url :"/rak-server-pengguna/detail/"+id+"/",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            processData: false,  
            contentType: false,
            cache: false,
            success:function(data)
            {
                
                $('#brand-server').text(data.brand_server);
                $('#model-server').text(data.model_server);
                $('#sn-server').text(data.sn_server);
                $('#brand-rak').text(data.brand_rak);
                $('#kode-rak').text(data.kode_rak);
                $('#type-rak').text(data.type_rak);
                $('#penggunaan-u').text(data.penggunaan_u);
                $('#hidden_id').val(id);
                $('.modal-title').text('Detail');
                $('#fModal').modal('show');

                console.log(
                    'Brand Server : '+data.brand_server,
                    'Brand Rak:'+ data.brand_rak,
                     $('#user-id')
                    );
                
            },
        })
    });

});
</script>
@endsection