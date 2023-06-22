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
                                <p>Lisensi Software</p>
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
                                                        <th>Brand Software</th>
                                                        <th>Model Software</th>
                                                        <th>Tahun Anggaran</th>
                                                        <th>Type Lisensi</th>
                                                        <th>Stok</th>
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
                                                        <!-- <div class="form-group">
                                                            <label>ID: </label>
                                                            <input type="text" name="id" id="id" class="form-control" />
                                                        </div> -->
                                                        <div class="form-group">
                                                            <label>Serial Number: </label>
                                                            <input type="text" name="sn_lisensi" id="sn_lisensi" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Brand Software: </label>
                                                            <input type="text" name="brand_lisensi" id="brand_lisensi" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Model Software: </label>
                                                            <input type="text" name="model_lisensi" id="model_lisensi" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Type Software: </label>
                                                            <select name="type_lisensi" class="form-control" required>
                                                                <option>---Pilih Type Software---</option>
                                                                <option value="OS Desktop">OS Desktop</option>
                                                                <option value="OS Server">OS Server</option>
                                                                <option value="Aplikasi">Aplikasi</option>
                                                            </select>             
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tahun Anggaran: </label>
                                                            <input type="Date" name="tahun_anggaran" id="tahun_anggaran" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Masa Aktif: </label>
                                                            <input type="Date" name="masa_aktif" id="masa_aktif" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Harga Lisensi : </label>
                                                            <input type="number" name="harga_lisensi" id="harga_lisensi" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Keygen : </label>
                                                            <input type="text" name="key_lisensi" id="key_lisensi" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>32 bit / 64 Bit: </label>
                                                            <select name="bit_os" class="form-control" required>
                                                                <option>---Pilih Type BIT---</option>
                                                                <option value="32 bit">32 bit</option>
                                                                <option value="64 bit">64 bit</option>
                                                            </select> 
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Stok (Jumlah Device yang bisa digunakan): </label>
                                                            <input type="number" name="stok" id="stok" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Foto Lisensi: </label>
                                                            <input type="file" name="foto_lisensi" id="foto_lisensi" class="form-control form-control-sm" accept="images-printer/*" onchange="readURL(this);" />
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
          <!-- Modal Detail -->
        <div class="modal fade" id="fModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <span id="detail_result"></span>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Lisensi Software</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- <p><strong>ID Netwok:</strong><span id="network-id"></span></p> -->
                    <p><strong>Brand:</strong><span id="brand-lisensi"></span></p>
                    <p><strong>Model:</strong><span id="model-lisensi"></span></p>
                    <p><strong>SN:</strong><span id="sn-lisensi"></span></p>
                    <p><strong>Type:</strong><span id="type-lisensi"></span></p>
                    <p><strong>Harga:</strong><span id="harga-lisensi"></span></p>
                    <p><strong>Masa Aktif:</strong><span id="masa-aktif"></span></p>
                    <p><strong>Key Lisence:</strong><span id="key-lisensi"></span></p>
                    <p><strong>Bit OS:</strong><span id="bit-os"></span></p>
                    <p><strong>Stok (Jumlah Device yang bisa digunakan):</strong><span id="stok-lisensi"></span></p>
                    <p><strong>Sisa Stok (Sisa Device yang bisa gunakan):</strong><span id="sisa-stok"></span></p>
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
        <!--**********************************
            Content body end
        ***********************************-->
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var table = $('.printerdevice_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('lisensi-software.index') }}",
        columns: [
            {data: 'sn_lisensi', name: 'sn_lisensi'},
            {data: 'brand_lisensi', name: 'brand_lisensi'},
            {data: 'model_lisensi', name: 'model_lisensi'},
            {data: 'tahun_anggaran', name: 'tahun_anggaran'},
            {data: 'type_lisensi', name: 'type_lisensi'},
            {data: 'stok', name: 'stok'},
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
            action_url = "{{ route('lisensi-software.store') }}";
        }
 
        if($('#action').val() == 'Edit')
        {
            action_url = "{{ route('lisensi-software.update') }}";
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
            url :"/lisensi-software/edit/"+id+"/",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            processData: false,  
            contentType: false,
            cache: false,
            success:function(data)
            {
                console.log('success: '+data);
                // tinyMCE.activeEditor.setContent(data.result.deskripsi);
                $('#sn_lisensi').val(data.result.sn_lisensi);
                $('#brand_lisensi').val(data.result.brand_lisensi);
                $('#model_lisensi').val(data.result.model_lisensi);
                $('#type_lisensi').val(data.result.type_lisensi);
                $('#tahun_anggaran').val(data.result.tahun_anggaran);
                $('#masa_aktif').val(data.result.masa_aktif);
                $('#harga_lisensi').val(data.result.harga_lisensi);
                $('#key_lisensi').val(data.result.key_lisensi);
                $('#bit_os').val(data.result.bit_os);
                $('#stok').val(data.result.stok);
                $('#tampilgambar').html(
                `<img src="/images-lisensi/${data.result.foto_lisensi}" width="100" class="img-fluid img-thumbnail">`);
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
            url:"lisensi-software/destroy/"+id,
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
            url :"/lisensi-software/detail/"+id+"/",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            processData: false,  
            contentType: false,
            cache: false,
            success:function(data)
            {
                
                // $('#network-id').text(data.network_id);
                $('#sn-lisensi').text(data.sn_lisensi);
                $('#brand-lisensi').text(data.brand_lisensi);
                $('#model-lisensi').text(data.model_lisensi);
                $('#type-lisensi').text(data.type_lisensi);
                $('#tahun-anggaran').text(data.tahun_anggaran);
                $('#masa-aktif').text(data.masa_aktif);
                $('#harga-lisensi').text(data.harga_lisensi);
                $('#key-lisensi').text(data.key_lisensi);
                $('#bit-os').text(data.bit_os);
                $('#stok-lisensi').text(data.stok);
                $('#sisa-stok').text(data.sisa_stok);
                $('#tampil-gambar').html(
                `<img src="/images-lisensi/${data.foto_lisensi}" width="100" class="img-fluid img-thumbnail">`);
                $('#hidden_id').val(id);
                $('.modal-title').text('Detail');
                $('#fModal').modal('show');

                console.log(
                    'SN Lisensi: '+data.sn_lisensi,
                     $('#sn-desktop')
                    );
                
            },
        })
    });
});
</script>
@endsection
