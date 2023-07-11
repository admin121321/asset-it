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
                                <p>Network Device</p>
                                <a href="{{ route('network-device.pdf') }}" class="btn btn-primary mb-4">Export PDF</a>
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
                                                        <th>Brand Network</th>
                                                        <th>Model Network</th>
                                                        <th>Tahun Anggaran</th>
                                                        <th>Type Network</th>
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
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-inline-block">
                                                    <h3 class="text-black">{{ DB::table('network_device')->where('sisa_stok','0')->count(); }}</h3>
                                                    <p class="text-black mb-0">Terpakai</p>
                                                </div>
                                                &nbsp;
                                                &nbsp;
                                                &nbsp;
                                                <div class="d-inline-block">
                                                    <h3 class="text-black">{{ DB::table('network_device')->where('sisa_stok','1')->count(); }}</h3>
                                                    <p class="text-black mb-0">Belum Terpakai</p>
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
                                                        <!-- <div class="form-group">
                                                            <label>ID: </label>
                                                            <input type="text" name="id" id="id" class="form-control" />
                                                        </div> -->
                                                        <div class="form-group">
                                                            <label>Serial Number: </label>
                                                            <input type="text" name="sn_network" id="sn_network" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Brand Network: </label>
                                                            <input type="text" name="brand_network" id="brand_network" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Model Network: </label>
                                                            <input type="text" name="model_network" id="model_network" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Type Network: </label>
                                                            <select name="type_network" class="form-control" required>
                                                                <option>---Pilih Type Network---</option>
                                                                <option value="Switch">Switch</option>
                                                                <option value="Modem">Modem</option>
                                                                <option value="Router Managed">Router Managed</option>
                                                                <option value="Router Unmanaged">Router Unmanaged</option>
                                                            </select>             
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Jumlah Port : </label>
                                                            <input type="text" name="port_network" id="port_network" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tahun Anggaran: </label>
                                                            <input type="Date" name="tahun_anggaran" id="tahun_anggaran" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Harga Lisensi : </label>
                                                            <input type="number" name="harga_network" id="harga_network" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Garansi : </label>
                                                            <input type="number" name="garansi_network" id="garansi_network" class="form-control" />
                                                        </div>
                                                        <div class="form-group" hidden>
                                                            <label>Stok: </label>
                                                            <select class="form-control" id="stok" name="stok" aria-label="Floating label select example">
                                                                <option value="1">1</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Foto Lisensi: </label>
                                                            <input type="file" name="foto_network" id="foto_network" class="form-control form-control-sm" accept="images-network/*" onchange="readURL(this);" />
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
                                                        <h4 align="center" style="margin:0;">Apakah Anda Yakin Untuk Menghapus ini?</h4>
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
    var table = $('.printerdevice_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('network-device.index') }}",
        columns: [
            {data: 'sn_network', name: 'sn_network'},
            {data: 'brand_network', name: 'brand_network'},
            {data: 'model_network', name: 'model_network'},
            {data: 'tahun_anggaran', name: 'tahun_anggaran'},
            {data: 'type_network', name: 'type_network'},
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
            action_url = "{{ route('network-device.store') }}";
        }
 
        if($('#action').val() == 'Edit')
        {
            action_url = "{{ route('network-device.update') }}";
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
            url :"/network-device/edit/"+id+"/",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            processData: false,  
            contentType: false,
            cache: false,
            success:function(data)
            {
                console.log('success: '+data);
                // tinyMCE.activeEditor.setContent(data.result.deskripsi);
                $('#sn_network').val(data.result.sn_network);
                $('#brand_network').val(data.result.brand_network);
                $('#model_network').val(data.result.model_network);
                $('#type_network').val(data.result.type_network);
                $('#tahun_anggaran').val(data.result.tahun_anggaran);
                $('#harga_network').val(data.result.harga_network);
                $('#port_network').val(data.result.port_network);
                $('#garansi_network').val(data.result.garansi_network);
                $('#stok').val(data.result.stok);
                $('#tampilgambar').html(
                `<img src="/images-network/${data.result.foto_network}" width="100" class="img-fluid img-thumbnail">`);
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
            url:"network-device/destroy/"+id,
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
});
</script>
@endsection
