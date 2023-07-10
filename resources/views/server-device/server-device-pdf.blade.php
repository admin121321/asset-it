<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="main-content">
    <div class="section-header">
        <br />
        <h3 style="text-align: center;">Laporan List Server</h3>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                    @foreach(App\Models\Logo::all() as $logos)
                    <p>Nama Perusahaan :  &nbsp; {{ $logos->nama_perusahaan}}</p>
                    @endforeach
                    <!-- card-body -->
                        <div class="col-12 table-responsive">
                        <br />
                            @if ($data->isEmpty())
                                <p>Tidak Ada Data Server</p>
                            @else
                            <table class="table table-striped table-bordered zero-configuration"> 
                                    <thead>
                                        <tr>
                                            <th>Serial Number</th>
                                            <th>Brand </th>
                                            <th>Model </th>
                                            <th>Type </th>
                                            <th>Harga </th>
                                            <th>Masa Garansi</th>
                                            <th>Masa Support</th>
                                            <th>Tahun Anggaran</th>
                                            <th>Stok</th>
                                            <th>Processor</th>
                                            <th>Core CPU</th>
                                            <th>RAM</th>
                                            <th>Hardisk</th>
                                            <th>OS</th>
                                            <th>Hostname</th>
                                            <th>IP Address</th>
                                            <th>IP Management</th>
                                            <th>Port Akses</th>
                                            <th>Nama Aplikasi</th>
                                            <th>Nama Web Server</th>
                                            <th>PHP</th>
                                            <th>DB</th>
                                            <th>Deskripsi</th>
                                            <th>Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $server)
                                        <tr>
                                            <td><p>{{ $server->sn_server }}</p></td>
                                            <td><p>{{ $server->brand_server }}</p></td>
                                            <td><p>{{ $server->model_server }}</p></td>
                                            <td><p>{{ $server->type_server }}</p></td>
                                            <td><p>{{ $server->harga_server }}</p></td>
                                            <td><p>{{ $server->garansi_server }}</p></td>
                                            <td><p>{{ $server->support_server }}</p></td>
                                            <td><p>{{ $server->tahun_anggaran }}</p></td>
                                            <td><p>{{ $server->stok }}</p></td>
                                            <td><p>{{ $server->processor_server }}</p></td>
                                            <td><p>{{ $server->core_server }}</p></td>
                                            <td><p>{{ $server->ram_server }}</p></td>
                                            <td><p>{{ $server->hardisk_server }}</p></td>
                                            <td><p>{{ $server->os_server }}</p></td>
                                            <td><p>{{ $server->hostname_server }}</p></td>
                                            <td><p>{{ $server->ip_address_server }}</p></td>
                                            <td><p>{{ $server->ip_management_server }}</p></td>
                                            <td><p>{{ $server->port_akses_server }}</p></td>
                                            <td><p>{{ $server->application_server }}</p></td>
                                            <td><p>{{ $server->web_server }}</p></td>
                                            <td><p>{{ $server->php_server }}</p></td>
                                            <td><p>{{ $server->db_server }}</p></td>
                                            <td><p>{{ $server->deskripsi_server }}</p></td>
                                            <td> <img src="{{ public_path('/images-server/'.$server->foto_server ) }}" style="width: 100px; height: 100px"></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                            </table>
                            @endif
                        </div>
                    <!-- card-body -->
            </div>
        </div>
    </div>
</div>
</body>
</html>