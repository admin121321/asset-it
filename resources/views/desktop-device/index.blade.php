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
                                <p>Desktop Device</p>
                                <a href="{{ route('desktop-device.pdf') }}" class="btn btn-primary mb-4">Export PDF</a>
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
                                                        <th>Brand Device</th>
                                                        <th>Model Device</th>
                                                        <th>Type Device</th>
                                                        <th>SN Device</th>
                                                        <th>Tahun Anggaran</th>
                                                        <th>Stok</th>
                                                        <th>Stok Tersisa</th>
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
                                                        <h5 class="modal-title" id="ModalLabel">Tambah Network Lokasi</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span id="form_result"></span>
                                                        <div class="form-group">
                                                            <label>Brand Desktop: </label>
                                                            <input type="text" name="brand_desktop" id="brand_desktop" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Model Desktop: </label>
                                                            <input type="text" name="model_desktop" id="model_desktop" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>SN Desktop: </label>
                                                            <input type="text" name="sn_desktop" id="sn_desktop" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Type Desktop: </label>
                                                            <select name="type_desktop" id="type_desktop" class="form-control" required>
                                                                <option>---Pilih Type Desktop---</option>
                                                                <option value="PC">PC</option>
                                                                <option value="LAPTOP">LAPTOP</option>
                                                                <option value="KOMPUTER">KOMPUTER</option>
                                                            </select>             
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Garansi Desktop: </label>
                                                            <input type="text" name="garansi_desktop" id="garansi_desktop" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tahun Anggaran Desktop: </label>
                                                            <input type="Date" name="tahun_anggaran" id="tahun_anggaran" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Harga Desktop: </label>
                                                            <input type="number" name="harga_desktop" id="harga_desktop" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Processor: </label>
                                                            <input type="text" name="processor_desktop" id="processor_desktop" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>core: </label>
                                                            <input type="text" name="core_desktop" id="core_desktop" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>RAM: </label>
                                                            <input type="text" name="ram_desktop" id="ram_desktop" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Hardisk: </label>
                                                            <input type="text" name="hardisk_desktop" id="hardisk_desktop" class="form-control" />
                                                        </div>
                                                        <div class="form-group" hidden>
                                                            <label>Stok: </label>
                                                            <select class="form-control" id="stok" name="stok" aria-label="Floating label select example">
                                                                <option value="1">1</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Deskrpsi: </label>
                                                            <textarea type="text" name="deskripsi_desktop" id="deskripsi_desktop" class="form-control" ></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Foto Printer: </label>
                                                            <input type="file" name="foto_desktop" id="foto_desktop" class="form-control form-control-sm" accept="images-desktop/*" onchange="readURL(this);" />
                                                            <input type="hidden" name="hidden_image" id="hidden_image">
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
         <!-- detail -->


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
                <!-- <p><strong>ID Netwok:</strong><span id="network-id"></span></p> -->
                <p><strong>Brand:</strong><span id="brand-desktop"></span></p>
                <p><strong>Model:</strong><span id="model-desktop"></span></p>
                <p><strong>SN:</strong><span id="sn-desktop"></span></p>
                <p><strong>Type:</strong><span id="type-desktop"></span></p>
                <p><strong>Harga:</strong><span id="harga-desktop"></span></p>
                <p><strong>Garansi:</strong><span id="garansi-desktop"></span></p>
                <p><strong>RAM:</strong><span id="ram-desktop"></span></p>
                <p><strong>COre:</strong><span id="core-desktop"></span></p>
                <p><strong>Processor:</strong><span id="processor-desktop"></span></p>
                <p><strong>Hardisk:</strong><span id="hardisk-desktop"></span></p>
                <p><strong>Stok:</strong><span id="stok-desktop"></span></p>
                <p><strong>Tahun Anggaran:</strong><span id="tahun-desktop"></span></p>
                <p><strong>Deskripsi:</strong><span id="deskripsi-desktop"></span></p>
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
    var table = $('.printerpengguna_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('desktop-device.index') }}",
        columns: [
            {data: 'brand_desktop', name: 'brand_desktop'},
            {data: 'model_desktop', name: 'model_desktop'},
            {data: 'type_desktop', name: 'type_desktop'},
            {data: 'sn_desktop', name: 'sn_desktop'},
            {data: 'tahun_anggaran', name: 'tahun_anggaran'},
            {data: 'stok', name: 'stok'},
            {data: 'sisa_stok', name: 'sisa_stok'},
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
            action_url = "{{ route('desktop-device.store') }}";
        }
 
        if($('#action').val() == 'Edit')
        {
            action_url = "{{ route('desktop-device.update') }}";
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
            url :"/desktop-device/edit/"+id+"/",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            processData: false,  
            contentType: false,
            cache: false,
            success:function(data)
            {
                console.log('success: '+data);
                // tinyMCE.activeEditor.setContent(data.result.deskripsi);
                $('#sn_desktop').val(data.result.sn_desktop);
                $('#brand_desktop').val(data.result.brand_desktop);
                $('#model_desktop').val(data.result.model_desktop);
                $('#type_desktop').val(data.result.type_desktop).change();
                $('#garansi_desktop').val(data.result.garansi_desktop);
                $('#tahun_anggaran').val(data.result.tahun_anggaran);
                $('#harga_desktop').val(data.result.harga_desktop);
                $('#deskripsi_desktop').val(data.result.deskripsi_desktop);
                $('#ram_desktop').val(data.result.ram_desktop);
                $('#hardisk_desktop').val(data.result.hardisk_desktop);
                $('#processor_desktop').val(data.result.processor_desktop);
                $('#core_desktop').val(data.result.core_desktop);
                $('#stok').val(data.result.stok);
                $('#tampilgambar').html(
                `<img src="/images-desktop/${data.result.foto_desktop}" width="100" class="img-fluid img-thumbnail">`);
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
            url:"desktop-device/destroy/"+id,
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
            url :"/desktop-device/detail/"+id+"/",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            processData: false,  
            contentType: false,
            cache: false,
            success:function(data)
            {
                
                // $('#network-id').text(data.network_id);
                $('#sn-desktop').text(data.sn_desktop);
                $('#brand-desktop').text(data.brand_desktop);
                $('#model-desktop').text(data.model_desktop);
                $('#type-desktop').text(data.type_desktop);
                $('#garansi-desktop').text(data.garansi_desktop);
                $('#tahun-desktop').text(data.tahun_anggaran);
                $('#harga-desktop').text(data.harga_desktop);
                $('#stok-desktop').text(data.stok);
                $('#deskripsi-desktop').text(data.deskripsi_desktop);
                $('#ram-desktop').text(data.ram_desktop);
                $('#hardisk-desktop').text(data.hardisk_desktop);
                $('#processor-desktop').text(data.processor_desktop);
                $('#core-desktop').text(data.core_desktop);
                $('#tampil-gambar').html(
                `<img src="/images-desktop/${data.foto_desktop}" width="100" class="img-fluid img-thumbnail">`);
                $('#qty').text(data.qty);
                $('#hidden_id').val(id);
                $('.modal-title').text('Detail');
                $('#fModal').modal('show');

                console.log(
                    'ID Network: '+data.sn_desktop,
                     $('#sn-desktop')
                    );
                
            },
        })
    });

});
</script>
@endsection