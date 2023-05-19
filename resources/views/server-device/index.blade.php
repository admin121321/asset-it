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
                                <p>Server Device</p>
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
                                                        <th>SN Server</th>
                                                        <th>Brand Server</th>
                                                        <th>Model Server</th>
                                                        <th>Type Server</th>
                                                        <th>IP Address</th>
                                                        <th>IP Management</th>
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
                                    <div class="modal fade bd-example-modal-lg" id="formModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <form method="post" id="sample_form" enctype="multipart/form-data" class="form-horizontal">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ModalLabel">Tambah Network Lokasi</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span id="form_result"></span>
                                                        <h5><b>Data</b></h5>
                                                        <div class="form-group">
                                                            <label>Brand Server: </label>
                                                            <input type="text" name="brand_server" id="brand_server" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Model Server: </label>
                                                            <input type="text" name="model_server" id="model_server" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>SN Server: </label>
                                                            <input type="text" name="sn_server" id="sn_server" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Type Server: </label>
                                                            <select id="type_server" name="type_server" class="form-control">
                                                                <option value="FISIK">FISIK</option>
                                                                <option value="STORAGE">STORAGE</option>
                                                                <option value="VM">Virtual Mechine</option>
                                                            </select>             
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Garansi Server: </label>
                                                            <input type="date" name="garansi_server" id="garansi_server" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Support Server: </label>
                                                            <input type="date" name="support_server" id="support_server" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tahun Anggaran Server: </label>
                                                            <input type="date" name="tahun_anggaran" id="tahun_anggaran" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Harga Server: </label>
                                                            Rp.<input type="number" name="harga_server" id="harga_server" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Foto Server: </label>
                                                            <input type="file" name="foto_server" id="foto_server" class="form-control form-control-sm" accept="images-desktop/*" onchange="readURL(this);" />
                                                            <input type="hidden" name="hidden_image" id="hidden_image">
                                                        </div>
                                                        <div class="form-floating mb-3" name="tampilgambar" id="tampilgambar">
                                                            <img name="tampilgambar" id="tampilgambar">
                                                        </div>
                                                        <div class="form-group" hidden>
                                                            <label>Stok: </label>
                                                            <input type="number" name="stok" id="stok" value="1" class="form-control" />
                                                        </div>
                                                        <h5><b>Spesifikasi</b></h5>
                                                        <div class="form-group">
                                                            <label>Processor : </label>
                                                            <input type="text" name="processor_server" id="processor_server" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Core: </label>
                                                            <input type="text" name="core_server" id="core_server" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>RAM: </label>
                                                            <input type="text" name="ram_server" id="ram_server" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Hardisk: </label>
                                                            <input type="text" name="hardisk_server" id="hardisk_server" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>IP Address: </label>
                                                            <input type="text" name="ip_address_server" id="ip_address_server" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>IP Management: </label>
                                                            <input type="text" name="ip_management_server" id="ip_management_server" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Subdomain: </label>
                                                            <input type="text" name="subdomain_server" id="subdomain_server" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Port Akses: </label>
                                                            <input type="text" name="port_akses_server" id="port_akses_server" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Deskrpsi: </label>
                                                            <textarea type="text" name="deskripsi_server" id="deskripsi_server" class="form-control" ></textarea>
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
                <label><h3>Data</h3></label>
                    <p><strong>Brand:</strong><span id="brand-server"></span></p>
                    <p><strong>Model:</strong><span id="model-server"></span></p>
                    <p><strong>SN:</strong><span id="sn-server"></span></p>
                    <p><strong>Type:</strong><span id="type-server"></span></p>
                    <p><strong>Harga:</strong><span id="harga-server"></span></p>
                    <p><strong>Garansi:</strong><span id="garansi-server"></span></p>
                    <p><strong>Stok:</strong><span id="stok-server"></span></p>
                    <p><strong>Tahun Anggaran:</strong><span id="tahun-server"></span></p>
                    <div class="form-floating mb-3" name="tampil-gambar" id="tampil-gambar">
                        <img name="tampil-gambar" id="tampilgambar">
                    </div>
                <label><h3>Spesifikasi</h3></label>
                    <p><strong>Processor:</strong><span id="processor-server"></span></p>
                    <p><strong>Core:</strong><span id="core-server"></span></p>
                    <p><strong>RAM:</strong><span id="ram-server"></span></p>
                    <p><strong>Hardisk:</strong><span id="hardisk-server"></span></p>
                    <p><strong>Port Akses:</strong><span id="port-akses-server"></span></p>
                    <p><strong>IP Address:</strong><span id="ip-address-server"></span></p>
                    <p><strong>IP Management:</strong><span id="ip-management-server"></span></p>
                    <p><strong>Deskripsi:</strong><span id="deskripsi-server-a"></span></p>
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
        ajax: "{{ route('server-device.index') }}",
        columns: [
            {data: 'sn_server', name: 'sn_server'},
            {data: 'brand_server', name: 'brand_server'},
            {data: 'model_server', name: 'model_server'},
            {data: 'type_server', name: 'type_server'},
            {data: 'ip_address_server', name: 'ip_address_server'},
            {data: 'ip_management_server', name: 'ip_management_server'},
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
            action_url = "{{ route('server-device.store') }}";
        }
 
        if($('#action').val() == 'Edit')
        {
            action_url = "{{ route('server-device.update') }}";
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
            url :"/server-device/edit/"+id+"/",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            processData: false,  
            contentType: false,
            cache: false,
            success:function(data)
            {
                console.log('success: '+data);
                // tinyMCE.activeEditor.setContent(data.result.deskripsi);
                $('#sn_server').val(data.result.sn_server);
                $('#brand_server').val(data.result.brand_server);
                $('#model_server').val(data.result.model_server);
                // $('#type_server').val(data.result.type_server);
                $("#type_server").val(data.result.type_server).change();
                $('#garansi_server').val(data.result.garansi_server);
                $('#support_server').val(data.result.support_server);
                $('#tahun_anggaran').val(data.result.tahun_anggaran);
                $('#harga_server').val(data.result.harga_server);
                $('#stok').val(data.result.stok);
                $('#tampilgambar').html(
                `<img src="/images-server/${data.result.foto_server}" width="100" class="img-fluid img-thumbnail">`);
                $('#ram_server').val(data.result.ram_server);
                $('#hardisk_server').val(data.result.hardisk_server);
                $('#processor_server').val(data.result.processor_server);
                $('#core_server').val(data.result.core_server);
                $('#subdomain_server').val(data.result.subdomain_server);
                $('#port_akses_server').val(data.result.port_akses_server);
                $('#ip_address_server').val(data.result.ip_address_server);
                $('#ip_management_server').val(data.result.ip_management_server);
                $('#deskripsi_server').val(data.result.deskripsi_server);
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
            url:"server-device/destroy/"+id,
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
            url :"/server-device/detail/"+id+"/",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            processData: false,  
            contentType: false,
            cache: false,
            success:function(data)
            {
                
                // $('#network-id').text(data.network_id);
                $('#sn-server').text(data.sn_server);
                $('#brand-server').text(data.brand_server);
                $('#model-server').text(data.model_server);
                $('#type-server').text(data.type_server);
                $('#garansi-server').text(data.garansi_server);
                $('#support-server').text(data.support_server);
                $('#tahun-server').text(data.tahun_anggaran);
                $('#harga-server').text(data.harga_server);
                $('#stok-server').text(data.stok);
                $('#tampil-gambar').html(
                `<img src="/images-server/${data.foto_server}" width="100" class="img-fluid img-thumbnail">`);
                $('#ram-server').text(data.ram_server);
                $('#hardisk-server').text(data.hardisk_server);
                $('#processor-server').text(data.processor_server);
                $('#core-server').text(data.core_server);
                $('#subdomain-server').text(data.subdomain_server);
                $('#port-akses-server').text(data.port_akses_server);
                $('#ip-address-server').text(data.ip_address_server);
                $('#ip-management-server').text(data.ip_management_server);
                $('#deskripsi-server-a').text(data.deskripsi_server);
                $('#hidden_id').val(id);
                $('.modal-title').text('Detail');
                $('#fModal').modal('show');

                console.log(
                    'SN Server: '+data.sn_server,
                    'RAM Server: '+data.ram_server,
                    'Deskripsi Server: '+data.deskripsi_server,
                     $('#sn-desktop')
                    );
                
            },
        })
    });

});
</script>
@endsection