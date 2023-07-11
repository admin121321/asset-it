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
                                <p>Rak Server</p>
                                <a href="{{ route('rak-server.pdf') }}" class="btn btn-primary mb-4">Export PDF</a>
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
                                                        <th>Serial Number</th>
                                                        <th>Kode Rak</th>
                                                        <th>Brand Rak</th>
                                                        <th>Type Rak</th>
                                                        <th>Tahun Anggaran</th>
                                                        <th>Ukuran U</th>
                                                        <th>Jumlah U Belum Terpakai</th>
                                                        <th width="180px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- card-body -->
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">            
                                                <div class="d-inline-block">
                                                    <h3 class="text-black">{{ DB::table('rak_server')->count(); }}</h3>
                                                    <p class="text-black mb-0">Total</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                            <label>Brand Rak: </label>
                                                            <input type="text" name="brand_rak" id="brand_rak" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Type Rak: </label>
                                                            <input type="text" name="type_rak" id="type_rak" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Serial Number Rak: </label>
                                                            <input type="text" name="sn_rak" id="sn_rak" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Kode Rak: </label>
                                                            <input type="text" name="kode_rak" id="kode_rak" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Dimensi Rak: </label>
                                                            <input type="text" name="dimensi_rak" id="dimensi_rak" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Ukuran Rak: </label>
                                                            <input type="text" name="ukuran_u_rak" id="ukuran_u_rak" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Harga Rak: </label>
                                                            <input type="text" name="harga_rak" id="harga_rak" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tahun Anggaran: </label>
                                                            <input type="Date" name="tahun_anggaran" id="tahun_anggaran" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Foto Rak: </label>
                                                            <input type="file" name="foto_rak" id="foto_rak" class="form-control form-control-sm" accept="images-printer/*" onchange="readURL(this);" />
                                                            <input type="hidden" name="hidden_image" id="hidden_image">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Deskripsi Rak: </label>
                                                            <input type="text" name="deskripsi" id="deskripsi" class="form-control" />
                                                        </div>
                                                        <div class="form-floating mb-3" name="tampilgambar" id="tampilgambar">
                                                            <img name="tampilgambar" id="tampilgambar">
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
         <!-- Modal -->
        <div class="modal fade" id="fModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <span id="detail_result"></span>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Desktop</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Brand Rak:</strong><span id="brand-rak"></span></p>
                    <p><strong>Type Rak:</strong><span id="type-rak"></span></p>
                    <p><strong>Serial Number Rak:</strong><span id="sn-rak"></span></p>
                    <p><strong>Kode Rak:</strong><span id="kode-rak"></span></p>
                    <p><strong>Dimensi Rak:</strong><span id="dimensi-rak"></span></p>
                    <p><strong>Ukuran Rak:</strong><span id="ukuran-u-rak"></span></p>
                    <p><strong>harga Rak:</strong><span id="harga-rak"></span></p>
                    <p><strong>Tahun Anggaran:</strong><span id="tahun-anggaran"></span></p>
                    <p><strong>Deskripsi:</strong><span id="deskripsi-rak"></span></p>
                    <div class="form-floating mb-3" name="tampil-gambar" id="tampil-gambar">
                        <img name="tampil-gambar" id="tampilgambar">
                    </div>
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
    var table = $('.printerdevice_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('rak-server.index') }}",
        columns: [
            {data: 'sn_rak', name: 'sn_rak'},
            {data: 'kode_rak', name: 'kode_rak'},
            {data: 'brand_rak', name: 'brand_rak'},
            {data: 'type_rak', name: 'type_rak'},
            {data: 'tahun_anggaran', name: 'tahun_anggaran'},
            {data: 'ukuran_u_rak', name: 'ukuran_u_rak'},
            {data: 'sisa_u', name: 'sisa_u'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
 
    $('#create_record').click(function(){
        $('#sample_form').get(0).reset();
        $('#tampilgambar').html('');
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
            action_url = "{{ route('rak-server.store') }}";
        }
 
        if($('#action').val() == 'Edit')
        {
            action_url = "{{ route('rak-server.update') }}";
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
            url :"/rak-server/edit/"+id+"/",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            processData: false,  
            contentType: false,
            cache: false,
            success:function(data)
            {
                console.log('success: '+data);
                // tinyMCE.activeEditor.setContent(data.result.deskripsi);
                $('#brand_rak').val(data.result.brand_rak);
                $('#type_rak').val(data.result.type_rak);
                $('#kode_rak').val(data.result.kode_rak);
                $('#sn_rak').val(data.result.sn_rak);
                $('#dimensi_rak').val(data.result.dimensi_rak);
                $('#ukuran_u_rak').val(data.result.ukuran_u_rak);
                $('#harga_rak').val(data.result.harga_rak);
                $('#tahun_anggaran').val(data.result.tahun_anggaran);
                $('#deskripsi').val(data.result.deskripsi);
                $('#tampilgambar').html(
                `<img src="/images-rak/${data.result.foto_rak}" width="100" class="img-fluid img-thumbnail">`);
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
            url:"rak-server/destroy/"+id,
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
            url :"/rak-server/detail/"+id+"/",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            processData: false,  
            contentType: false,
            cache: false,
            success:function(data)
            {
                
                // $('#network-id').text(data.network_id);
                $('#brand-rak').text(data.brand_rak);
                $('#type-rak').text(data.type_rak);
                $('#kode-rak').text(data.kode_rak);
                $('#sn-rak').text(data.sn_rak);
                $('#dimensi-rak').text(data.dimensi_rak);
                $('#ukuran-u-rak').text(data.ukuran_u_rak);
                $('#harga-rak').text(data.harga_rak);
                $('#tahun-anggaran').text(data.tahun_anggaran);
                $('#deskripsi-rak').text(data.deskripsi);
                $('#tampil-gambar').html(
                `<img src="/images-rak/${data.foto_rak}" width="100" class="img-fluid img-thumbnail">`);
                $('#hidden_id').val(id);
                $('.modal-title').text('Detail');
                $('#fModal').modal('show');

                console.log(
                    'BRand Rak: '+data.brand_rak,
                     $('#sn-desktop')
                    );
                
            },
        })
    });
});
</script>
@endsection