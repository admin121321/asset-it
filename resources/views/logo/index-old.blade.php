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
                                <p>Logo</p>
                                <!-- DataTables -->
                                <div align="right">
                                    <button type="button" name="create_record" id="create_record" class="btn btn-success"> <i class="bi bi-plus-square"></i> Add</button>
                                </div>
                                <div class="section-body">
                                    <!-- card-body -->
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                        <br />
                                            <table class="table table-striped table-bordered zero-configuration logo_datatable"> 
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Logo</th>
                                                        <th width="180px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- card-body -->
                                    <!-- Modal -->
                                    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <form method="post" id="sample_form" enctype="multipart/form-data" class="form-horizontal">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ModalLabel">Tambah Logo</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span id="form_result"></span>
                                                        <div class="form-group">
                                                            <label>Logo: </label>
                                                            <input type="file" name="gambar_logo" id="gambar_logo" class="form-control form-control-sm" accept="images-logo/*" onchange="readURL(this);" />
                                                            <input type="hidden" name="hidden_image" id="hidden_image">
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
        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('.logo_datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('logo.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'gambar_logo', name: 'gambar_logo', "render": function (data, type, row, meta) {
                        return '<img src="/images-logo/' + data + '" alt="' + data + '"height="100px" width="100px"/>';
                        } },
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
                var action_url = '';
        
                if($('#action').val() == 'Add')
                {
                    action_url = "{{ route('logo.store') }}";
                }
        
                if($('#action').val() == 'Edit')
                {
                    action_url = "{{ route('logo.update') }}";
                }
        
                $.ajax({
                    type: 'post',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: action_url,
                    data:$(this).serialize(),
                    dataType: 'json',
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
                            $('#logo_table').DataTable().ajax.reload();
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
                    url :"/logo/edit/"+id+"/",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType:"json",
                    success:function(data)
                    {
                        console.log('success: '+data);
                        // $('#gambar_logo').val(data.result.gambar_logo);
                        $('#tampilgambar').html(
                        `<img src="/images-logo/${data.result.gambar_logo}" width="100" class="img-fluid img-thumbnail">`);
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
                    url:"logo/destroy/"+id,
                    beforeSend:function(){
                        $('#ok_button').text('Deleting...');
                    },
                    success:function(data)
                    {
                        setTimeout(function(){
                        $('#confirmModal').modal('hide');
                        $('#logo_table').DataTable().ajax.reload();
                        alert('Data Deleted');
                        }, 2000);
                    }
                })
            });
        });
    </script>
@endsection
