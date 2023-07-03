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
                                <p>USERS</p>
                                <a href="{{ route('users.pdf') }}" class="btn btn-primary mb-4">Export PDF</a>
                                <!-- DataTables -->
                                <div align="right">
                                    <button type="button" name="create_record" id="create_record" class="btn btn-success"> <i class="bi bi-plus-square"></i> Add</button>
                                </div>
                                <div class="section-body">
                                    <!-- card-body -->
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                        <br />
                                            <table class="table table-striped table-bordered zero-configuration printerdevice_datatable"> 
                                                <thead>
                                                    <tr>
                                                        <th>ID Card</th>
                                                        <th>Nama Karyawan</th>
                                                        <th>Divisi</th>
                                                        <th>Level Login</th>
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
                                                        <h5 class="modal-title" id="ModalLabel">Tambah Printer</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span id="form_result"></span>
                                                        <div class="form-group">
                                                            <label>Nama Karyawan: </label>
                                                            <input type="text" name="name" id="name" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>ID Card: </label>
                                                            <input type="text" name="card_id" id="card_id" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Foto</label>
                                                            <input type="file" name="foto" id="foto" class="form-control" accept="images-foto/*" onchange="readURL(this);"/>
                                                            <input type="hidden" name="hidden_image" id="hidden_image">
                                                        </div>
                                                        <div class="form-floating mb-3" name="tampilgambar" id="tampilgambar">
                                                            <img name="tampilgambar" id="tampilgambar">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nama Divisi: </label>
                                                            <select class="form-control" id="divisi_id" name="divisi_id" aria-label="Floating label select example">
                                                                @foreach(App\Models\UserDivisi::all() as $divisi)
                                                                    <option value="{{ $divisi->id}}" id="divisi_id">{{ $divisi->nama_divisi }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email<a style="color:red;">*</a> : </label>
                                                            <input type="email" name="email" id="email" class="form-control" required />
                                                        </div>
                                                        <div class="form-group editpass">
                                                            <label>Password<a style="color:red;">*</a> : </label>
                                                            <input type="password" name="password" id="password" class="form-control"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Level Login<a style="color:red;">*</a> : </label>
                                                            <select class="form-control" id="level_login" name="level_login" required>
                                                                <option value="0">USERS</option>
                                                                <option value="1">ADMIN</option>
                                                            </select>
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
        <!-- Modal Detail user-->
        <div class="modal fade" id="fModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <span id="detail_result"></span>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Data Akses -->
                    <div class="card-header">
                        <h6> Data Profile </h6>
                    </div>
                    <div class="card">
                        <p><strong>Nama      :</strong><span id="name-user"></span></p>
                        <p><strong>ID Card   :</strong> <span id="card-id-user"></span></p>
                        <p><strong>Divisi    :</strong> <span id="divisi-id-user"></span></p>
                        <p><strong>Foto      :</strong> <span id="tampil-gambar"></span></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
        <!-- Modal Edit Password-->
        <div class="modal fade" id="fxModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content bg-light rounded h-100 p-4">
                <form method="post" id="password_form" enctype="multipart/form-data" class="form-horizontal">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Update Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                        </div>
                        <span id="password_result"></span>
                        <div class="modal-body">
                            <!-- Data Akses -->
                            <div class="card-header">
                                <h6> Data Akses </h6>
                            </div>
                            <div class="form-group">
                                <label>Email<a style="color:red;">*</a> : </label>
                                <input type="email" name="email" id="email-edit" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>Password<a style="color:red;">*</a> : </label>
                                <input type="password" name="password" id="password-edit" class="form-control"/>
                            </div>
                        <input type="hidden" name="hidden_id_pass" id="hidden_id_pass" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" name="action_button_pass" id="submit" value="Submit" class="btn btn-info action_button_pas" />
                    </div>
                </form>  
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var table = $('.printerdevice_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.index') }}",
        columns: [
            {data: 'card_id',    name: 'card_id'},
            {data: 'name',    name: 'name'},
            {data: 'nama_divisi',    name: 'nama_divisi'},
            {data: 'level_login',    name: 'level_login'},
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
            action_url = "{{ route('users.store') }}";
        }
 
        if($('#action').val() == 'Edit')
        {
            action_url = "{{ route('users.update') }}";
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
                    $('#printerdevice_datatable').DataTable().ajax.reload();
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
            url :"/users/edit/"+id+"/",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            processData: false,  
            contentType: false,
            cache: false,
            success:function(data)
            {
                console.log('success: '+data);
                // tinyMCE.activeEditor.setContent(data.result.deskripsi);
                $('#card_id').val(data.result.card_id);
                $('#name').val(data.result.name);
                $('#email').val(data.result.email);
                $('#password').val(data.result.password);
                $('#divisi_id').val(data.result.divisi_id).change();
                $('#tampilgambar').html(
                `<img src="/images-foto/${data.result.foto}" width="100" class="img-fluid img-thumbnail">`);
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
            url:"users/destroy/"+id,
            beforeSend:function(){
                $('#ok_button').text('Deleting...');
            },
            success:function(data)
            {
                setTimeout(function(){
                $('#confirmModal').modal('hide');
                $('#printerdevice_datatable').DataTable().ajax.reload();
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
            url :"/users/detail/"+id+"/",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            processData: false,  
            contentType: false,
            cache: false,
            success:function(data)
            {
                
                $('#card-id-user').val(data.card_id);
                $('#name-user').val(data.name);
                $('#email-user').val(data.email);
                $('#divisi_id-user').val(data.nama_divisi).change();
                $('#tampil-gambar').html(
                `<img src="/images-foto/${data.foto}" width="100" class="img-fluid img-thumbnail">`);
                $('.modal-title').text('Detail');
                $('#fModal').modal('show');
                
            },
        })
    });

    // Password
    $(document).on('click', '.passwordButton', function(event){
        event.preventDefault();
        // var formData = new FormData($(this)[0]); 
        // var SITEURL = '{{ URL::to('') }}';
        var id = $(this).attr('id'); alert(id);
        $('#password_result').html('');

        $.ajax({
            url :"/users/edit_pass/"+id+"/",
            enctype: 'multipart/form-data',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            // Important!
            processData: false,  
            contentType: false,
            cache: false,
            // data: formData,

            success:function(data)
            {
                // console.log('success: '+data);
                $('#email-edit').val(data.result.email);
                $('#password-edit').val(data.result.password);
                $('#hidden_id_pass').val(id);
                $('.modal-title').text('Ubah Data Anggota');
                $('.action_button_pass').val('Update'); 
                $('#fxModal').modal('show');
                
            // console.log(
            //         'email: '+data.result.email
            // );
            },
            error: function(data) {
                var errors = data.responseJSON;
                console.log(errors);
            }
        })
    });
    
    $('#password_form').on('submit', function(event){
        event.preventDefault()
        var formData = new FormData($(this)[0]);
        var email_lir = $("#email-edit").val();
        var password_lir = $("#password-edit").val();
        var id = $("#hidden_id_pass").val();
        // var id = $(this).attr('id'); alert(id);
        var action_urli = "{{ route('users.update_pass') }}";
        // var action_urli ="users/update_pass/"+id+"/";     
        $.ajax({
            type: 'POST',
            enctype: 'multipart/form-data',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: action_urli,
            processData: false,  // Important!
            contentType: false,
            cache: false,
            // data:$(this).serialize(),
            data: formData,
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
                    $('#posting_table').DataTable().ajax.reload();
                    window.location.reload();
                }
                $('#password_result').html(html);
            },
            error: function(data) {
                var errors = data.responseJSON;
                console.log(errors);
            }
        });
    });
    var id;
});
</script>
@endsection