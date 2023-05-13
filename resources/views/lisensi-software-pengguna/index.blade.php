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
                                <p>Printer Pengguna</p>
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
                                                        <th>Brand Printer</th>
                                                        <th>Model Printer</th>
                                                        <th>Pengguna</th>
                                                        <th>Qty</th>
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
                                                            <label>ID Pengguna: </label>
                                                            <select class="form-control" id="user_id" name="user_id" aria-label="Floating label select example">
                                                                <option>--Pilih Pengguna--</option>
                                                                @foreach(App\Models\User::all() as $user)
                                                                <option value="{{ $user->id}}" id="user_id">{{ $user->card_id }} - {{ $user->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Printer: </label>
                                                            <select class="form-control" id="printer_id" name="printer_id" aria-label="Floating label select example">
                                                                <option>--Pilih Printer--</option>
                                                                @foreach(App\Models\PrinterDevice::all() as $printer)
                                                                    @if ($printer->stok=='0')
                                                                    @else
                                                                    <option value="{{ $printer->id}}" id="printer_id">{{ $printer->model_printer }} - {{ $printer->serial_number }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group" hidden>
                                                            <label>Qty: </label>
                                                            <input type="text" name="qty" id="qty" value="1" class="form-control" />
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
                <p><strong>ID:</strong><span id="user-id"></span></p>
                <p><strong>Name:</strong> <span id="printer-id"></span></p>
                <p><strong>Qty:</strong> <span id="qty"></span></p>
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
        ajax: "{{ route('lisensi-software-pengguna.index') }}",
        columns: [
            {data: 'brand_desktop', name: 'brand_dektop'},
            {data: 'model_lisensi', name: 'model_lisensi'},
            {data: 'qty', name: 'qty'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
 
    $('#create_record').click(function(){
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
            action_url = "{{ route('printer-pengguna.store') }}";
        }
 
        if($('#action').val() == 'Edit')
        {
            action_url = "{{ route('printer-pengguna.update') }}";
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
            url :"/printer-pengguna/edit/"+id+"/",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            processData: false,  
            contentType: false,
            cache: false,
            success:function(data)
            {
                console.log('success: '+data);
                // tinyMCE.activeEditor.setContent(data.result.deskripsi);
                $('#user_id').val(data.result.user_id);
                // $('#printer_id').val(data.result.printer_id);
                $('#qty').val(data.result.qty);
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
            url:"printer-pengguna/destroy/"+id,
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
            url :"/printer-pengguna/detail/"+id+"/",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            processData: false,  
            contentType: false,
            cache: false,
            success:function(data)
            {
                
                $('#user-id').text(data.user_id);
                $('#printer-id').text(data.printer_id);
                $('#qty').text(data.qty);
                $('#hidden_id').val(id);
                $('.modal-title').text('Detail');
                $('#fModal').modal('show');

                console.log(
                    'id user: '+data.user_id,
                    'id printer:'+ data.printer_id,
                     $('#user-id')
                    );
                
            },
        })
    });

});
</script>
@endsection